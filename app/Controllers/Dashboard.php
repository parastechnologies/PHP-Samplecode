<?php

namespace App\Controllers;
include('./vendor/autoload.php');

use App\Controllers\BaseController;

use Config\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

//$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//$spreadsheet = $reader->load("05featuredemo.xlsx");

            
class Dashboard extends BaseController
{
    public function index()
    {
        try {
            $UserModel = $this->UserModel;
            $BusinessAccountModel = $this->BusinessAccountModel;
            $ActiveDevicesModel = $this->ActiveDevicesModel;
            $totalUser = $UserModel->select('isSuspended')->getWhere(['isWeb' => 0])->getResultArray();
            $isSuspended = 1;
            $Suspended = 0;
            $totalActiveUser = array_count_values(array_column($totalUser, 'isSuspended'))[$isSuspended];
            $totalDeactiveUser = array_count_values(array_column($totalUser, 'isSuspended'))[$Suspended];
            $totalAndoidUser = $UserModel->select('isSuspended')->getWhere(['deviceType' => 'android'])->getResultArray();
            $totalActiveUserInAndoid = array_count_values(array_column($totalAndoidUser,'isSuspended'))[$isSuspended];
            $totalIOSUser = $UserModel->select('isSuspended')->getWhere(['deviceType' => 'ios'])->getResultArray();
            $totalActiveUserInIOS = array_count_values(array_column($totalIOSUser,'isSuspended'))[$isSuspended];
            $totalBusinessAccounts = $BusinessAccountModel->findAll();
            $activeDevices = $ActiveDevicesModel->select('count(*) as total')->getWhere(['status' => 1])->getRowArray();
            $data = [
                "totalUsers" => count($totalUser) ? count($totalUser) : 0, 
                "totalActiveUser" => $totalActiveUser ? $totalActiveUser : 0,
                "totalDeactiveUser" => $totalDeactiveUser ? $totalDeactiveUser : 0,
                "andoidDownload" => $totalAndoidUser ? count($totalAndoidUser) : 0, 
                "activeOnandoid" => $totalActiveUserInAndoid ? $totalActiveUserInAndoid : 0,
                "iosDownload" => $totalIOSUser ? count($totalIOSUser) : 0, 
                "activeOnios" => $totalActiveUserInIOS ? $totalActiveUserInIOS : 0,
                "totalBusinessAccounts" => $totalBusinessAccounts ? count($totalBusinessAccounts) : 0,
                "activeDevices" => $activeDevices ? $activeDevices['total'] : 0,
            ];
        } catch (Exception $e) {
             $data = [
                    'success' => 0,
                    'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('dashboard',$data);
    }
    public function userManagement()
    {
        try {
            $UserModel = $this->UserModel;
            $users = Services::getUsersInAdmin();//$UserModel->orderBy('id', 'desc')->getWhere(['isWeb' => '0'])->getResultArray();
            $data = ['users' => $users];
        } catch (Exception $e) {
             $data = [
                    'success' => 0,
                    'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('userManagement',$data);    
    }
    public function userDetail($userID)
    {
        try 
        {
            $id = base64_decode($userID);
            $UserModel = $this->UserModel;
            $PrivateAccountModel = $this->PrivateAccountModel;
            $BusinessAccountModel = $this->BusinessAccountModel;
            $user = $UserModel->getWhere(["id" => $id])->getRowArray();
            $privates = $PrivateAccountModel->getWhere(["userID" => $id])->getResultArray();
            $businesses = $BusinessAccountModel->getWhere(["userID" => $id])->getResultArray();
            $data['user'] = $user;
            $data['privates'] = $privates;
            $data['businesses'] = $businesses;
        } 
        catch (Exception $e) {
             $data = [
                    'success' => 0,
                    'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('userDetail',$data);    
    }
    public function userStatusChange()
    {
        try{
            $AdminModel = $this->AdminModel;
            $id = $this->request->getVar("id");
            $UserModel = $this->UserModel;
            $user = $UserModel->getWhere(["id" => $id])->getRowarray();
            $status = $user['isSuspended'];
            $update = $UserModel->where(['id' => $id])->set(["isSuspended" => $status == 1 ? 0 : 1])->update(); 
            if($update){
                echo $status == 1 ? 0 : 1; 
            }
            else{
                echo false;
            }
        }
        catch(Exception $e){
            echo false;
        }
    }
    public function devicesManagement()
    {
        try {
            $DevicesModel = $this->DevicesModel;
            $DeviceTypesModel = $this->DeviceTypesModel;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('deviceSuccess','deviceError');
            //$devices = $DevicesModel->orderBy('id', 'desc')->findAll();
            $devices = Services::getDevices();
            //print_r($test);
            $types = $DeviceTypesModel->findAll();
            $data = ['devices' => $devices,'types' => $types];
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('deviceManagment',$data);     
    }
    public function devicesTypesManagement()
    {
        try {
            $DeviceTypesModel = $this->DeviceTypesModel;
            $types =  Services::getDevicesTypes();
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('deviceTypeSuccess','deviceTypeError');
            $data['types'] = $types;
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('deviceTypesManagement',$data);     
    }
    public function socialManagement()
    {
        try {
            $socialLinksModel = $this->SocialLinksModel;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('socialSuccess','socialError');
            $social = $socialLinksModel->getWhere(['status' => 1])->getResultArray();
            $types = ['facebook','instagram','twitter','gmail','yahoo'];
            $data = ['socials' => $social,'types' => $types];
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('socialManagement',$data);     
    }
    public function addSocial()
    {
        try {
            $session = $this->session;
            $SocialLinksModel = $this->SocialLinksModel;
            $rules = [
                "type" => "required|is_unique[tbl_socialLinks.type]",
			//	"icon" => "required",
				"link" => "required",
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
               // echo $error['icon'];
                echo $error['type'];
                echo $error['link'];
            }
            else
            {
                $file = $this->uploadImages('icon','socialLinks');
                if($file['success'] == 1)
                {
                    $payload['status'] = 1;
                    $payload['icon'] = $file['fileName'];
                    $payload['createdDate'] = date('Y-m-d H:i:s');
                    $query = $SocialLinksModel->insert($payload);
                    if($query)
                    {
                        echo 1;
                    }
                    else{
                        echo 'Something went wrong';
                    }   
                }
                else {
                    echo $file['message'];
                }  
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function updateSocial()
    {
        try {
            $session = $this->session;
            $SocialLinksModel = $this->SocialLinksModel;
            $rules = [
				"link" => "required",
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                echo $error['link'];
            }
            else
            {
                if($_POST['icon'])
                {
                    $file = $this->uploadImages('icon','socialLinks');
                    if($file['success'] == 1)
                    {
                        $payload['icon'] = $file['fileName'];
                        $query = $SocialLinksModel->update($payload['id'],$payload);
                        if($query)
                        {
                            echo 1;
                        }
                        else{
                            echo 'Something went wrong';
                        }   
                    }
                    else {
                        echo $file['message'];
                    }
                }
                else{
                    $query = $SocialLinksModel->update($payload['id'],$payload);
                        if($query)
                        {
                            echo 1;
                        }
                        else{
                            echo 'Something went wrong';
                        }                        
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteSocial($id)
    {
        try {
            $session = $this->session;
            $SocialLinksModel = $this->SocialLinksModel;
            $query = $SocialLinksModel->delete($id);
            if($query)
            {
                $session->setFlashdata('socialSuccess',['Social link has deleted successfully']);
                return redirect()->to($this->adminBaseURL.'social/delete/'.$id); 
            }
            else{
                $session->setFlashdata('socialError',['something went wrong']);
                return redirect()->to($this->adminBaseURL.'social/delete/'.$id); 
            }
        } catch (Exception $e) {
            $session->setFlashdata('socialError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'social/delete/'.$id); 
        }
    }
    public function productsManagement()
    {
        try {
            $ProductsModel = $this->ProductsModel;
            $products = Services::getProducts();
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('productSuccess','productError');
            $data['products'] = $products;
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('productManagement',$data);     
    }
    public function addDevice()
    {
        try {
            $session = $this->session;
            $DevicesModel = $this->DevicesModel;
            $rules = [
				"deviceName" => "required",
				"deviceNumber" => "required|is_unique[tbl_devices.deviceNumber]",
				"deviceType" => "required",
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                echo $error['deviceName'];
                echo $error['deviceNumber'];
                echo $error['deviceType'];
            }
            else
            {
                $payload['status'] = 1;
                $payload['createdDate'] = date('Y-m-d H:i:s');
                $query = $DevicesModel->insert($payload);
                if($query)
                {
                    echo 1;
                }
                else{
                    echo 'Something went wrong';
                }  
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeStatusDevice($deviceID)
    {
        try {
            $session = $this->session;
            $DevicesModel = $this->DevicesModel;
            $id = base64_decode($deviceID);
            $device = $DevicesModel->getWhere(["id" => $id])->getRowarray();
            $status = $device['status'];
            $update = $DevicesModel->where(['id' => $id])->set(["status" => $status == 1 ? 0 : 1])->update(); 
            if($update){
                $statusMessage = $device['status'] == 1 ? 'Deactivate' : 'Activate';
                $session->setFlashdata('deviceSuccess',["Device $statusMessage successfully"]);
                return redirect()->to($this->adminBaseURL.'devices'); 
            }
            else{
                $session->setFlashdata('deviceError',['something went wrong']);
                return redirect()->to($this->adminBaseURL.'devices'); 
            } 
        } catch (Exception $e) {
            $session->setFlashdata('deviceError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'devices'); 
        }
    }
    /*start product section */
    public function addProduct()
    {
        try {
            $ColorsModel = $this->ColorsModel;
            $DeviceTypesModel = $this->DeviceTypesModel;
            $colors = $ColorsModel->findAll();
            $deviceTypes = $DeviceTypesModel->findAll();
            $data['colors'] = $colors;
            $data['deviceTypes'] = $deviceTypes;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('productSuccess','productError');
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('addProduct',$data);     
    }
    public function insertProduct()
    {
        try {
            $session = $this->session;
            $ProductsModel = $this->ProductsModel;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $rules = [
				"name" => "required",
				"price" => "required|numeric",
				"description" => "required",
				"compatibility" => "required",
				"shipping" => "required",
				"deviceTypeID" => "required"
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                $session->setFlashdata('productError',$error);
                return redirect()->to($this->adminBaseURL.'product/add'); 
            }
            else{
                $uploadStatusCode = $this->addMultipleImages();
                $uploadStatus = $uploadStatusCode['uploadStatus']; 
                $images = $uploadStatusCode['images'];
                if($uploadStatus == 0) {
                    $session->setFlashdata('productError',['Sorry, there was an error uploading your file.']);
                    return redirect()->to($this->adminBaseURL.'product/add'); 
                }
                else if($uploadStatus == 2)
                {
                    $session->setFlashdata('productError',['Image size should be 172.0 kB']);
                    return redirect()->to($this->adminBaseURL.'product/add'); 
                }
                else if($uploadStatus == 3)
                {
                    $session->setFlashdata('productError',['Sorry, only JPG, JPEG, & PNG files are allowed to upload.']);
                    return redirect()->to($this->adminBaseURL.'product/add'); 
                }
                else if($uploadStatus == 4)
                {
                    $payload['status'] = 1;
                    $payload['createdDate'] = date('Y-m-d H:i:s');
                    $query = $ProductsModel->insert($payload);
                    $productID = $ProductsModel->insertID();
                    if($query)
                    {
                        if($images){ 
                            foreach($images as $img){
                                $payloadImage = [
                                    "productID" => $productID,
                                    "colorID" => NULL,
                                    "image" => $img,
                                    "status" => 1,
                                    "createdDate" => date('Y-m-d H:i:s'),
                                ];
                                $ProductColorImagesModel->insert($payloadImage);
                            }
                        }
                        $this->addColorImages($productID);    
                        $session->setFlashdata('productSuccess',['Product added successfully']);
                        return redirect()->to($this->adminBaseURL.'products'); 
                    }
                else{
                    $session->setFlashdata('productError',['something went wrong']);
                    return redirect()->to($this->adminBaseURL.'product/add'); 
                }  
            }
            }
        } catch (Exception $e) {
            $session->setFlashdata('productError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'product/add'); 
        }
    }
    public function deleteProduct($productID)
    {
        try {
            $session = $this->session;
            $ProductsModel = $this->ProductsModel;
            $id = base64_decode($productID);
            $product = $ProductsModel->getWhere(["id" => $id])->getRowarray();
            $status = $product['status'];
            $update = $ProductsModel->where(['id' => $id])->set(["status" => $status == 1 ? 0 : 1])->update(); 
            if($update){
                $statusMessage = $product['status'] == 1 ? 'Deactivate' : 'Activate';
                $session->setFlashdata('productSuccess',["Product $statusMessage successfully"]);
                return redirect()->to($this->adminBaseURL.'products'); 
            }
            else{
                $session->setFlashdata('productError',['something went wrong']);
                return redirect()->to($this->adminBaseURL.'products'); 
            } 
        } catch (Exception $e) {
            $session->setFlashdata('productError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'products'); 
        }
    }
    public function addMultipleImages()
    {
        $uploadStatus = 1; 
        $fName = 'icon';
        $filesArr = $_FILES[$fName]; 
        $fileNames = array_filter($filesArr['name']); 
        $uploadedFile = ''; 
        $folderName = 'products';
        $allowTypes = array('jpg', 'png', 'jpeg','gif');
        $maxsize = '171986';
        if(!empty($fileNames)){  
            foreach($filesArr['name'] as $key=>$val){  
                $fileName = basename($filesArr['name'][$key]);  
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);  
                if(in_array($fileType, $allowTypes)){
                    if(($filesArr['name']['size'][$key] <= $maxsize) || ($filesArr['name']['size'][$key] != 0)) {
                    $file = $this->multipleUploadImages($fName,$folderName,$key);
                    if($file['success']  == 1){
                        $images[]  = $file['fileName'];
                        $uploadStatus = 4; 
                    }
                    else{
                        $uploadStatus = 0; 
                    }
                    }else{
                        $uploadStatus = 2; 
                    }
                }else{  
                    $uploadStatus = 3; 
                }
            }  
        }
        else{
             $uploadStatus = 4; 
        }
        return ["uploadStatus" => $uploadStatus,"images" => $images];
    }
    public function addColorImages($productID)
    {
        $session = $this->session;
        $files = $_FILES;
        $ProductColorImagesModel = $this->ProductColorImagesModel;
        foreach($files as $key1 => $val)
        {
            $keys = explode("_",$key1);
            $colorID = $keys[1];
            $folderName = 'products';
            if($keys[0] == 'inputVal'){
              if($_FILES[$key1]['name'] != ""){
                $file = $this->uploadImages($key1,$folderName);
                if($file['success'] == 1){
                    $image = $file['fileName'];
                    $colorPayload = 
                    [
                        "productID" => $productID,
                        "colorID" => $colorID,
                        "image" => $image,
                        "status" => 1,
                        "createdDate" => date('Y-m-d H:i:s'),
                    ];
                    $query = $ProductColorImagesModel->insert($colorPayload);
                    if($query){
                        $session->setFlashdata('productSuccess',['Product added successfully']);
                    }
                    else{
                        $this->session->setFlashdata('productError', ['Something went wrong']);
                    }
                }
                else{
                    $this->session->setFlashdata('productError',['Sorry, there was an error uploading your file.']);
                }
              }
            }
        }
    }
    public function updateProductData($productID)
    {
        try {
            $session = $this->session;
            $id = base64_decode($productID);
            $ProductsModel = $this->ProductsModel;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $rules = [
				"name" => "required",
				"price" => "required|numeric",
				"description" => "required",
				"compatibility" => "required",
				"shipping" => "required",
				"deviceTypeID" => "required"
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                $session->setFlashdata('productError',$error);
                return redirect()->to($this->adminBaseURL.'product/update/'.$productID);
            }
            else{
                $uploadStatusCode = $this->addMultipleImages();
                $uploadStatus = $uploadStatusCode['uploadStatus']; 
                $images = $uploadStatusCode['images'];
                if($uploadStatus == 0) {
                    $session->setFlashdata('productError',['Sorry, there was an error uploading your file.']);
                    return redirect()->to($this->adminBaseURL.'product/update/'.$productID);
                }
                else if($uploadStatus == 2)
                {
                    $session->setFlashdata('productError',['Image size should be 172.0 kB']);
                    return redirect()->to($this->adminBaseURL.'product/update/'.$productID); 
                }
                else if($uploadStatus == 3)
                {
                    $session->setFlashdata('productError',['Sorry, only JPG, JPEG, & PNG files are allowed to upload.']);
                    return redirect()->to($this->adminBaseURL.'product/update/'.$productID); 
                }
                else if($uploadStatus == 4)
                {
                    $payload['status'] = 1;
                    $payload['createdDate'] = date('Y-m-d H:i:s');
                    $query = $ProductsModel->update($id,$payload);
                    echo $ProductsModel->getLastQuery();
                    if($query)
                    {
                        if($images){ 
                            foreach($images as $img){
                                $payloadImage = [
                                    "productID" => $id,
                                    "colorID" => NULL,
                                    "image" => $img,
                                    "status" => 1,
                                    "createdDate" => date('Y-m-d H:i:s'),
                                ];
                                $ProductColorImagesModel->insert($payloadImage);
                                
                            }
                        }
                        $this->addColorImages($id);    
                        $session->setFlashdata('productSuccess',['Product updated successfully']);
                        return redirect()->to($this->adminBaseURL.'product/update/'.$productID); 
                    }
                else{
                    $session->setFlashdata('productError',['something went wrong']);
                    return redirect()->to($this->adminBaseURL.'product/update/'.$productID); 
                }  
            }
            }
        } catch (Exception $e) {
            $session->setFlashdata('productError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'product/update/'.$productID);
        }
    }
    //product detail
    public function productsDetail($productID)
    {
        try {
            $ProductsModel = $this->ProductsModel;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $id = base64_decode($productID);
            $product = Services::getProductDetail($id);
            $images = Services::getProductImages($id);
            $data['product'] = $product;
            $data['images'] = $images;
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('productDetail',$data);     
    }
    public function updateProduct($productID)
    {
        try {
            $ProductsModel = $this->ProductsModel;
            $ColorsModel = $this->ColorsModel;
            $DeviceTypesModel = $this->DeviceTypesModel;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $id = base64_decode($productID);
            $product = Services::getProductDetail($id);
            $images = Services::getProductImages($id);
            $colors = $ColorsModel->findAll();
            $deviceTypes = $DeviceTypesModel->findAll();
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('productSuccess','productError');
            $data['colors'] = $colors;
            $data['deviceTypes'] = $deviceTypes;
            $data['product'] = $product;
            $data['images'] = $images;
            $arrrayVales = array_values(array_column($images,'colorID'));
            $footerInfo['selectColors'] =  $arrrayVales;
            $data['selectColors'] =  $arrrayVales;
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('productUpdate',$headerInfo = [], $data, $footerInfo);     
    }
     public function deleteProductImage($imageID)
    {
        try {
            $uri = service('uri');
            $productID = $uri->getSegment(6); 
            $session = $this->session;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $id = base64_decode($imageID);
            $query = $ProductColorImagesModel->delete($id);
            if($query)
            {
                $session->setFlashdata('productSuccess',['Product image has deleted successfully']);
                return redirect()->to($this->adminBaseURL.'product/update/'.$productID); 
            }
            else{
                $session->setFlashdata('productError',['something went wrong']);
                return redirect()->to($this->adminBaseURL.'product/update/'.$productID); 
            }
        } catch (Exception $e) {
            $session->setFlashdata('productError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'product/update/'.$productID); 
        }
    }
    /* stop product section*/
    
    /*Start device type section */
    
    public function addDeviceType()
    {
        try {
            $session = $this->session;
            $DeviceTypesModel = $this->DeviceTypesModel;
            $rules = [
				"typeName" => "required|is_unique[tbl_deviceTypes.typeName]",
				'icon' => 'uploaded[icon]|max_size[icon,1024]|ext_in[icon,png,jpg,gif]',
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                echo $error['typeName'];
                echo $error['icon'];
            }
            else
            {
                $image = 'icon';
                $folderName = 'deviceTypes';
                $fileSuccess = $this->uploadImages($image,$folderName);
                if($fileSuccess['success'] == 0)
                {
                    echo $fileSuccess['message'];
                }
                else {
                    $payload['icon'] = $fileSuccess['fileName'];
                    $payload['status'] = 1;
                    $payload['createdDate'] = date('Y-m-d H:i:s');
                    $insert  = $DeviceTypesModel->insert($payload);
                    if($insert){
                        echo 1;
                    }
                    else{
                        echo "Something went wrong";
                    }
               }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function deleteDeviceType($deviceID)
    {
        try {
            $session = $this->session;
            $DeviceTypesModel = $this->DeviceTypesModel;
            $id = base64_decode($deviceID);
            $query = $DeviceTypesModel->delete($id);
            if($query)
            {
                $session->setFlashdata('deviceTypeSuccess',['Device type deleted successfully']);
                return redirect()->to($this->adminBaseURL.'devices/types'); 
            }
            else{
                $session->setFlashdata('deviceTypeError',['something went wrong']);
                return redirect()->to($this->adminBaseURL.'devices/types'); 
            }  
        } catch (Exception $e) {
            $session->setFlashdata('deviceTypeError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'devices/types'); 
        }
    }
    /*Stop device type */
    
    /*Start color section*/
    public function colorManagement()
    {
        try {
            $ColorsModel = $this->ColorsModel;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('colorSuccess','colorError');
            $colors = $ColorsModel->orderBy('id', 'desc')->findAll();
            $data = ['colors' => $colors];
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('colorManagement',$data);     
    }
    public function addColor()
    {
        try {
            $session = $this->session;
            $ColorsModel = $this->ColorsModel;
            $rules = [
				"colorName" => "required|is_unique[tbl_colors.colorName]",
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                echo $error['colorName']; 
            }
            else
            {
                $payload['status'] = 1;
                $payload['createdDate'] = date('Y-m-d H:i:s');
                $query = $ColorsModel->insert($payload);
                if($query)
                {
                    echo 1;
                }
                else{
                    echo 'something went wrong'; 
                }  
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteColor($colorID)
    {
        try {
            $session = $this->session;
            $ColorsModel = $this->ColorsModel;
            $id = base64_decode($colorID);
            $query = $ColorsModel->delete($id);
            if($query)
            {
                $session->setFlashdata('colorSuccess',['Color deleted successfully']);
                return redirect()->to($this->adminBaseURL.'colors'); 
            }
            else{
                $session->setFlashdata('colorError',['something went wrong']);
                return redirect()->to($this->adminBaseURL.'colors'); 
            }  
        } catch (Exception $e) {
            $session->setFlashdata('colorError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'colors'); 
        }
    }
    /*Stop color section*/
    /*Start Order Management*/
    public function createOrder()
    {
        try{
            /*$ColorsModel = $this->ColorsModel;
            $DeviceTypesModel = $this->DeviceTypesModel;
            $colors = $ColorsModel->findAll();
            $deviceTypes = $DeviceTypesModel->findAll();
            $data['colors'] = $colors;
            $data['deviceTypes'] = $deviceTypes;*/
            $products = Services::getProducts();
            $data['products'] = $products;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('orderSuccess','orderError');
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('createOrder',$data);     
    }
    public function orderManagement()
    {
        try {
            $OrdersModel = $this->OrdersModel;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('orderSuccess','orderError');
            $orders = Services::getOrdersProcessInAdmin();
            $pastOrders = Services::getOrdersPastInAdmin();
            $data = ['orders' => $orders,'pastOrders' => $pastOrders];
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('orderManagement',$data);     
    }
    public function orderDetail($id)
    {
        try 
        {
            $OrdersModel = $this->OrdersModel;
            $orderID = base64_decode($id);
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('orderSuccess','orderError');
            $order = Services::getorderDetail($orderID);
            $items = Services::cartList($orderID);
            if($order['orderStatus'] == 0){
                $statusMessage = 'In Process';
            }
            /*else if($order['orderStatus'] == 4){
                $statusMessage = 'Rejected';
            }*/
            else if($order['orderStatus'] == 1){
                $statusMessage = 'Pick Up';
            }
            else if($order['orderStatus'] == 2){
                $statusMessage = 'Delivered';
            }
            
            
           /* else if($order['orderStatus'] == 3){
                $statusMessage = 'Delivered';
            }
            else if($order['orderStatus'] == 5){
                $statusMessage = 'Refunded';
            }*/
            else{
                $statusMessage = 'Pending';
            }
            $data['statusMessage'] = $statusMessage;
            $data['order'] = $order;
            $data['items'] = $items;
        } catch (Exception $e) 
        {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('order',$data);     
    }
    public function changeOrderStatus()
    {
        try {
            $session = $this->session;
            $OrderModel = $this->OrdersModel;
            $orderID = base64_decode($_POST['id']);
            $status = $_POST['status'];
            $orderDetail = $OrderModel->getWhere(['orderID' => $orderID])->getRowArray();
            $payload = ['status' => $status,"deliveredDate" => date('Y-m-d H:i:s') ];
            $update = $OrderModel->where(['orderID' =>  $orderID])->set($payload)->update();
            if($update)
            {
                echo 1;
                $session->setFlashdata('orderSuccess',['Status changed successfully']);
            }
            else
            {
                echo 0;  
                $session->setFlashdata('orderError',['Something went wrong']);
            }
        } catch (Exception $e) {
            echo 0;
            $session->setFlashdata('orderError',[$e->getMessage()]);
        }
    }
    /*Stop Order Management*/
    public function usersCSVImport()
    {
        try{
            $UserModel = $this->UserModel;
            $session = $this->session; 
            $rules = [
				"file" => "uploaded[file]|max_size[file,26930]|ext_in[file,xls,xlsx,csv]",
			];
			$input = $this->getRequestInput($this->request);
            if (!$this->validateRequest($input, $rules)) {
                $error = $this->validator->getErrors();
                echo $error['file'];
            }
            else{
                if($file = $this->request->getFile('file')) {
                    if ($file->isValid() && ! $file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('./uploads/usersCSV', $newName);
                        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("./uploads/usersCSV/".$newName);
                        $sheet = $spreadsheet->getActiveSheet();
                        $data = $sheet->toArray(null,true,true,true);
                        $i = 1;
                        if($data)
                        {
                            foreach($data as $val)
                            {
                                if($i != 1)
                                {
                                    $ifExist = $UserModel->getWhere(['email' => $val['C'],"isWeb" => 0])->getNumRows();
                                    if($ifExist == 0){
                                        $payload['firstName'] = $val['A'];
                                        $payload['lastName'] = $val['B'];
                                        $payload['email'] = $val['C'];
                                        $payload['password'] = password_hash($val['D'],PASSWORD_DEFAULT);
                                        $payload['designation'] = $val['E'];
                                        $payload['description'] = $val['F'];
                                        $payload['status'] = 1;
                                        $payload['isLoggedIN'] = 0;
                                        $payload['isWeb'] = 0;
                                        $payload['isProfile'] = 1;
                                        $payload['createdDate'] = date('Y-m-d H:i:s');
                                        $UserModel->insert($payload);
                                        $userID = $UserModel->insertID();
                                        $QRCode = $this->createProfileURL($userID,'public');
                                        $UserModel->update($userID, ["QRCode" => $QRCode['qrCode'],"profileLink"=>$QRCode['url']]);
                                    }
                                }
                                $i++;
                            }
                            echo "1";
                        }
                        else {
                            echo 'Something wrong in upload csv file';
                        }
                    }
                    else {
                        echo 'Something wrong in upload csv file';
                    }
                }
                else {
                        echo 'Something wrong in upload csv file';
                    }
            }
        }
        catch(Exception $e)
        {
            echo $g->getMessage();
        }
    }
    public function getColorsByProduct()
    {
        $ProductColorImagesModel = $this->ProductColorImagesModel;
        $productID = $_POST['productID'];
        $colors = Services::getProductByColors($productID);
        if($colors){
        foreach($colors as $color){
    ?>
            <option value="<?php echo $color['colorID']; ?>"><?php echo $color['colorName']; ?></option>    
    <?php  }  } else { echo '<option value="">No Color</option>'; }
    }
    public function addAddress($payload)
    {
        $UserAddressModel = $this->UserAddressModel;
        /*$payload1['companyName'] =$payload['companyName'];
        $payload1['companyName'] =$payload['email'];
        $payload1['phoneNumber'] =$payload['phoneNumber'];*/
        $insert = $UserAddressModel->insert($payload);
        return $UserAddressModel->insertID();
    }
    public function addOrder()
    {
        try{
            $session = $this->session;
            $rules = [
    			"companyName" => "required",
    			"email" => "required",
    			"phoneNumber" => "required",
    			"address" => "required",
    			"grandTotal" => "required",
    		];
    		$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                $session->setFlashdata('orderError',$error);
                return redirect()->to($this->adminBaseURL.'orders/create');
            }
            else{
                $payload = $this->getRequestInput($this->request);
                $products = $payload['products'];
                $ProductsModel = $this->ProductsModel;
                $OrderItemsModel = $this->OrderItemsModel;
                $OrdersModel = $this->OrdersModel;
                $address = $this->addAddress($payload);
                $orderNumber = "#OAO".mt_rand(100000,999999);
                $payload['shippingAddressID'] = $address;
                $payload['orderNumber'] = $orderNumber;
                $payload['userStatus'] = 1;
                $insertOrder = $OrdersModel->insert($payload);
                $orderID = $OrdersModel->insertID();
                if($orderID)
                {
                    foreach($products as $key => $product)
                    {
                        $productVal = $ProductsModel->getWhere(['id' => $product])->getRowArray(); 
                        $colorID = $payload['colorVal_'.$product];
                        $qty = $payload['qtyVal_'.$product];
                        $orderItems['orderID'] = $orderID;    
                        $orderItems['productID'] = $product;
                        $orderItems['colorID'] = $colorID;
                        $orderItems['itemPrice'] = $productVal['price'];
                        $orderItems['itemQty'] = $qty;
                        $orderItems['itemQtyPrice'] = $qty * $productVal['price'];
                        $orderItems['status'] = 1;
                        $OrderItemsModel->insert($orderItems);
                    }  
                    $session->setFlashdata('orderSuccess',['Order Created successfully']);
                    return redirect()->to($this->adminBaseURL.'orders');
                }
                else{
                    $session->setFlashdata('orderError',['Something went wrong']);
                    return redirect()->to($this->adminBaseURL.'orders/create');
                }
            }
        }
        catch(Exception $e)
        {
            $session->setFlashdata('orderError',['Something went wrong']);
            return redirect()->to($this->adminBaseURL.'orders/create');
        }
    }
    public function pages()
    {
        try {
            $PageModel = $this->PageModel;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('pageSuccess','pageError');
            $pages = $PageModel->getWhere(["status" => 0])->getResultArray();
            $data = ['pages' => $pages];
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('pages',$data);     
    }
    public function updatePage($pageID)
    {
        try {
            $id = base64_decode($pageID);
            $PageModel = $this->PageModel;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('pageSuccess','pageError');
            $page = $PageModel->getWhere(["id" => $id])->getRowArray();
            $data['page'] = $page;
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('updatePage',$data);     
    }
    public function updatePageDetail()
    {
        try{
            $PageModel = $this->PageModel;
            $session = $this->session;
            $rules = [
    			"title" => "required",
    			"content" => "required",
    		];
    		$payload = $this->getRequestInput($this->request);
    		$id = base64_encode($payload['pageID']);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                $session->setFlashdata('pageError',$error);
                return redirect()->to($this->adminBaseURL.'pages/'.$id);
            }
            else{
                $insertOrder = $PageModel->update($payload['pageID'],$payload);
                if($insertOrder)
                {
                    $session->setFlashdata('pageSuccess',['Content changed successfully']);
                    return redirect()->to($this->adminBaseURL.'pages/'.$id);
                }
                else{
                    $session->setFlashdata('pageError',['Something went wrong']);
                    return redirect()->to($this->adminBaseURL.'pages/'.$id);
                }
            }
        }
        catch(Exception $e)
        {
            $session->setFlashdata('pageError',['Something went wrong']);
            return redirect()->to($this->adminBaseURL.'pages/'.$id);
        }
    }
    public function revenueManagement()
    {
        try {
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('revenueSuccess','revenueError');
            $revenues = Services::getSubscriptionInAdmin();
            $data = ['revenues' => $revenues];
        } catch (Exception $e) {
            $data = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        $this->loadViews('revenueManagment',$data);     
    }
}