<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Controllers\BaseController;
use Config\Services;


class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function pages()
    {
        try {
            $userID = $this->decodeToken();
            $PageModel = $this->PageModel;
            $type = $this->request->getVar('page');
            $data = $PageModel->getWhere(["type" => $type])->getRowArray();
            if($data)
            {
                $response = [
                    'data' => $data,
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                ];
            }
            else{
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];
            }
        } catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
    /*Start account apis for private */
    public function privateAccountAdd()
    {
        try{
            $userID = $this->decodeToken();
            $PrivateAccountModel = $this->PrivateAccountModel;
            $payload= $this->getRequestInput($this->request);
            $payload['userID'] = $userID;
            $payload['status'] = 1;
            $image = 'privateUserProfile';
            $folderName = 'privateAccounts';
            $FileName = $_FILES[$image]['name'];
            if($FileName !=  "")
            {
                $file = $this->uploadImages($image,$folderName);
                if($file['success'] == 1){
                    $payload['privateUserProfile'] = $file['fileName'];
                    $insert = $PrivateAccountModel->insert($payload);
                    if($insert){ 
                        $PID = $PrivateAccountModel->insertID(); 
                        $QRCode = $this->createProfileURL($PID,'private');
                        $PrivateAccountModel->update($PID, ["qrCode" => $QRCode['qrCode'],"profileLink"=>$QRCode['url']]);
                        $data = $this->commonForPrivateDetail($userID,$PID,1);
                        $response = [
                            'success' => 1,
                            'message' => $this->language_messages($userID,'profileCreated'),
                           'data' => $data['data']
                        ];
                    }else{
                        $response = [
                            'success' => 0,
                            'message' =>  $this->language_messages($userID,'wrong'),
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'uploadError'),
                    ];
                }
            }
            else{
                $insert = $PrivateAccountModel->insert($payload);
                if($insert){ 
                    $PID = $PrivateAccountModel->insertID(); 
                    $QRCode = $this->createProfileURL($PID,'private');
                    $PrivateAccountModel->update($PID, ["qrCode" => $QRCode['qrCode'],"profileLink"=>$QRCode['url']]);
                    $data = $this->commonForPrivateDetail($userID,$PID,1);
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'profileCreated'),
                         'data' => $data['data']
                    ];
                }else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'wrong'),
                    ];
                }
            }
        }    
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
       public function privateAccountUpdate()
    {
        try{
            $userID = $this->decodeToken();
            $PrivateAccountModel = $this->PrivateAccountModel;
            $payload = $this->getRequestInput($this->request);
            $payload['userID'] = $userID;
            $image = 'privateUserProfile';
            $folderName = 'privateAccounts';
            $FileName = $_FILES[$image]['name'];
            if($FileName !=  "")
            {
                $file = $this->uploadImages($image,$folderName);
                if($file['success'] == 1){
                    $payload['privateUserProfile'] = $file['fileName'];
                    $update = $PrivateAccountModel->where(["userID" => $userID,"PID" => $payload['PID']])->set($payload)->update();
                    $data = $this->commonForPrivateDetail($userID,$payload['PID'],1);
                    if($update){ 
                        $response = [
                            'success' => 1,
                            'message' => $this->language_messages($userID,'profileUpdated'),
                            'data' => $data['data']
                        ];
                    }else{
                        $response = [
                            'success' => 0,
                            'message' => $this->language_messages($userID,'wrong'),
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'uploadError'),
                    ];
                }
            }
            else{
                $update = $PrivateAccountModel->where(["userID" => $userID,"PID" => $payload['PID']])->set($payload)->update();
                $data = $this->commonForPrivateDetail($userID,$payload['PID'],1);
                if($update){ 
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'profileUpdated'),
                        'data' => $data['data']
                    ];
                }else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'wrong'),
                    ];
                }
            }
        }    
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function privateAccountView($PID)
    {
        try{
            $userID = $this->decodeToken();
            $response = $this->commonForPrivateDetail($userID,$PID,1);
        }
        catch (\Exception $e)
        {
            $response = [
                    'success' => 0,
                    'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function commonForPrivateDetail($userID,$PID,$type)
    {
        $PrivateAccountModel = $this->PrivateAccountModel;
        $where = $type == 1 ? ["userID" => $userID,'PID' => $PID] : ['PID' => $PID]; 
        $privateDetail = $PrivateAccountModel->getWhere($where)->getRowArray();
        if($privateDetail) 
        {
            $platformData = Services::userPlatformList($privateDetail['userID'],$PID,'private');
            $theme = Services::getUserTheme($PID,'private');
            $privateDetail['colorID'] = $theme['id'] ? $theme['id'] : '4';
            $privateDetail['color'] = $theme['color'] ? $theme['color'] : '#FFFFFF';
            $privateDetail['iconType'] = $theme['iconType'] ? $theme['iconType'] : 'Rectangular';
            $privateDetail['userType'] = 'private';
            $privateDetail['platforms'] = $platformData;
            $privateDetail['userStatus'] = $privateDetail['status'];
            $response = [
                'data' => $privateDetail,
                'success' => 1,
                'message' => $this->language_messages($userID,'dataFound'),
            ];
        }else{
            $response = [
                'success' => 1,
                'message' => $this->language_messages($userID,'dataNotFound'),
            ];
        }
        return  $response;
    }
    public function privateAccountList()
    {
        try{
            $userID = $this->decodeToken();
            $PrivateAccountModel = $this->PrivateAccountModel;
            //$userData = $PrivateAccountModel->orderBY('PID','desc')->getWhere(['userID' => $userID,'status' => 1])->getResultArray();
            $userData = $PrivateAccountModel->orderBY('PID','desc')->getWhere(['userID' => $userID])->getResultArray();
            if($userData) 
            {
                foreach($userData as $val){
                    $platformData = Services::userPlatformList($userID,$val['PID'],'private');
                    $theme = Services::getUserTheme($val['PID'],'private');
                    $val['color'] = $theme['color'];
                    $val['iconType'] = $theme['iconType'];
                    $val['platforms'] = $platformData;
                    $valData[] = $val;
                }
               $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                    'data' => $valData
                ];
            }else{
                $response = [
                    'data' => [],
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];
            }
        }
        catch (\Exception $e)
        {
            $response = [
                    'success' => 0,
                    'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    
    /*Stop account apis for private */
    /*start account apis for business */
    public function businessAccountAdd()
    {
        try{
            $userID = $this->decodeToken();
            $BusinessAccountModel = $this->BusinessAccountModel;
            $payload= $this->getRequestInput($this->request);
            $payload['userID'] = $userID;
            $payload['status'] = 1;
            $image = 'businessProfile';
            $folderName = 'businessAccounts';
            $FileName = $_FILES[$image]['name'];
            if($FileName !=  "")
            {
                $file = $this->uploadImages($image,$folderName);
                if($file['success'] == 1){
                    $payload['businessProfile'] = $file['fileName'];
                    $insert = $BusinessAccountModel->insert($payload);
                    if($insert){ 
                        $BID = $BusinessAccountModel->insertID();
                        $QRCode = $this->createProfileURL($BID,'business');
                        $BusinessAccountModel->update($BID, ["qrCode" => $QRCode['qrCode'],"profileLink"=>$QRCode['url']]);
                        $data = $this->commonForBusinessDetail($userID,$BID,1);
                        $response = [
                            'success' => 1,
                            'message' => $this->language_messages($userID,'createdBP'),
                            'data' => $data['data']
                        ];
                    }else{
                        $response = [
                            'success' => 0,
                            'message' => $this->language_messages($userID,'wrong'),
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'uploadError'),
                    ];
                }
            }
            else{
                $insert = $BusinessAccountModel->insert($payload);
                if($insert){ 
                    $BID = $BusinessAccountModel->insertID(); 
                    $QRCode = $this->createProfileURL($BID,'business');
                    $BusinessAccountModel->update($BID, ["qrCode" => $QRCode['qrCode'],"profileLink"=>$QRCode['url']]);
                    $data = $this->commonForBusinessDetail($userID,$BID,1);
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'createdBP'),
                        'data' => $data['data']
                    ];
                }else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'wrong'),
                    ];
                }
            }
        }    
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function businessAccountUpdate()
    {
        try{
            $userID = $this->decodeToken();
            $BusinessAccountModel = $this->BusinessAccountModel;
            $payload = $this->getRequestInput($this->request);
            $payload['userID'] = $userID;
            $image = 'businessProfile';
            $folderName = 'businessAccounts';
            $FileName = $_FILES[$image]['name'];
            if($FileName !=  "")
            {
                $file = $this->uploadImages($image,$folderName);
                if($file['success'] == 1){
                    $payload['businessProfile'] = $file['fileName'];
                    $update = $BusinessAccountModel->where(["userID" => $userID,"BID" => $payload['BID']])->set($payload)->update();
                    if($update){ 
                        $data = $this->commonForBusinessDetail($userID,$payload['BID'],1);
                        $response = [
                            'success' => 1,
                            'message' => $this->language_messages($userID,'updatedBP'),
                            'data' => $data['data']
                        ];
                    }else{
                        $response = [
                            'success' => 0,
                            'message' => $this->language_messages($userID,'wrong'),
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'uploadError'),
                    ];
                }
            }
            else{
                $update = $BusinessAccountModel->where(["userID" => $userID,"BID" => $payload['BID']])->set($payload)->update();
                if($update){ 
                    $data = $this->commonForBusinessDetail($userID,$payload['BID'],1);
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'updateBP'),
                        'data' => $data['data']
                    ];
                }else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'wrong'),
                    ];
                }
            }
        }    
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function businessAccountView($BID)
    {
        try{
            $userID = $this->decodeToken();
            $response =  $this->commonForBusinessDetail($userID,$BID,1);
        }
        catch (\Exception $e)
        {
            $response = [
                    'success' => 0,
                    'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function commonForBusinessDetail($userID,$BID,$type)
    {
        $BusinessAccountModel = $this->BusinessAccountModel;
        $where = $type == 1 ? ["userID" => $userID,'BID' => $BID] : ['BID' => $BID]; 
        $businessDetail = $BusinessAccountModel->getWhere($where)->getRowArray();
        if($businessDetail) 
        {
            $limit = 3;
            $offset = 0;
            $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
            $staffDetail = $BusinessStaffAccountModel->orderBY('SID','desc')->getWhere(['userID' => $businessDetail['userID'],'BID' => $BID,'isDelete' => 0],$limit,$offset)->getResultArray();
            $platformData = Services::userPlatformList($businessDetail['userID'],$BID,'business');
            $theme = Services::getUserTheme($BID,'business');
            $businessDetail['userStatus'] = $businessDetail['status'];
            $businessDetail['colorID'] = $theme['id'] ? $theme['id'] : '4';
            $businessDetail['color'] = $theme['color'] ? $theme['color'] : '#FFFFFF';
            $businessDetail['iconType'] = $theme['iconType'] ? $theme['iconType'] : 'Rectangular';
            $businessDetail['userType'] = 'business';
            $businessDetail['staff'] = $staffDetail;
            $businessDetail['platforms'] = $platformData;
            
            $response = [
                'data' => $businessDetail,
                'success' => 1,
                'message' => $this->language_messages($userID,'dataFound'),
            ];
        }else{
            $response = [
                'success' => 1,
                'message' => $this->language_messages($userID,'dataNotFound'),
            ];
        }
        return  $response;
    }
    public function commonForBusinessDetailWeb($userID,$BID,$type)
    {
        $BusinessAccountModel = $this->BusinessAccountModel;
        $where = $type == 1 ? ["userID" => $userID,'BID' => $BID] : ['BID' => $BID]; 
        $businessDetail = $BusinessAccountModel->getWhere($where)->getRowArray();
        if($businessDetail) 
        {
            //$limit = 3;
            //$offset = 0;
            $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
            $staffDetail = $BusinessStaffAccountModel->orderBY('SID','desc')->getWhere(['userID' => $businessDetail['userID'],'BID' => $BID,'isDelete' => 0])->getResultArray();
            $platformData = Services::userPlatformList($businessDetail['userID'],$BID,'business');
            $theme = Services::getUserTheme($BID,'business');
            $businessDetail['userStatus'] = $businessDetail['status'];
            $businessDetail['colorID'] = $theme['id'] ? $theme['id'] : '4';
            $businessDetail['color'] = $theme['color'] ? $theme['color'] : '#FFFFFF';
            $businessDetail['iconType'] = $theme['iconType'] ? $theme['iconType'] : 'Rectangular';
            $businessDetail['userType'] = 'business';
            $businessDetail['staff'] = $staffDetail;
            $businessDetail['platforms'] = $platformData;
            $response = [
                'data' => $businessDetail,
                'success' => 1,
                'message' => $this->language_messages($userID,'dataFound'),
            ];
        }else{
            $response = [
                'success' => 1,
                'message' => $this->language_messages($userID,'dataNotFound'),
            ];
        }
        return  $response;
    }
    public function businessAccountList()
    {
        try{
            $userID = $this->decodeToken();
            $BusinessAccountModel = $this->BusinessAccountModel;
            //$userData = $BusinessAccountModel->orderBY('BID','desc')->getWhere(['userID' => $userID,'status' => 1])->getResultArray();
            $userData = $BusinessAccountModel->orderBY('BID','desc')->getWhere(['userID' => $userID])->getResultArray();
            if($userData) 
            {
               foreach($userData as $val)
               {
                    $limit = 6;
                    $offset = 0;
                    $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
                    $staffDetail = $BusinessStaffAccountModel->orderBY('SID','desc')->getWhere(['userID' => $userID,'BID' => $val['BID'],'isDelete' => 0],$limit,$offset)->getResultArray();
                    $platformData = Services::userPlatformList($userID,$val['BID'],'business');
                    $theme = Services::getUserTheme($val['BID'],'business');
                    $val['color'] = $theme['color'];
                    $val['iconType'] = $theme['iconType'];
                    $val['staff'] = $staffDetail;
                    $val['platforms'] = $platformData;
                    $businessData[] = $val;
               }
               $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                    'data' => $businessData
                ];
            }else{
                $response = [
                    'data' => [],
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];
            }
        }
        catch (\Exception $e)
        {
            $response = [
                    'success' => 0,
                    'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    /*Stop account apis for business */
    /* Start business staff account */
    public function businessStaffAdd()
    {
        try{
            $userID = $this->decodeToken();
            $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
            $payload= $this->getRequestInput($this->request);
            $payload['userID'] = $userID;
            $payload['status'] = 1;
            $image = 'profileImage';
            $folderName = 'staff';
            $FileName = $_FILES[$image]['name'];
            if($FileName !=  "")
            {
                $file = $this->uploadImages($image,$folderName);
                if($file['success'] == 1){
                    $payload['profileImage'] = $file['fileName'];
                    $insert = $BusinessStaffAccountModel->insert($payload);
                    if($insert){ 
                        $SID = $BusinessStaffAccountModel->insertID(); 
                        $QRCode = $this->createProfileURL($SID,'staff');
                        $BusinessStaffAccountModel->update($SID, ["qrCode" => $QRCode['qrCode'],"profileLink"=>$QRCode['url']]);
                        $data = $this->commonForStaffDetail($userID,$SID,1);
                        unset($data['data']['businessName']);
                        unset($data['data']['businessDescription']);
                        unset($data['data']['businessProfile']);
                        unset($data['data']['platforms']);
                        $response = [
                            'success' => 1,
                            'message' => $this->language_messages($userID,'createdBPS'),
                            'data' => $data['data']
                        ];
                    }else{
                        $response = [
                            'success' => 0,
                            'message' => $this->language_messages($userID,'wrong'),
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'uploadError'),
                    ];
                }
            }
            else{
                $insert = $BusinessStaffAccountModel->insert($payload);
                if($insert){ 
                    $SID = $BusinessStaffAccountModel->insertID(); 
                    $QRCode = $this->createProfileURL($SID,'staff');
                    $BusinessStaffAccountModel->update($SID, ["qrCode" => $QRCode['qrCode'],"profileLink"=>$QRCode['url']]);
                    $data = $this->commonForStaffDetail($userID,$SID,1);
                    unset($data['data']['businessName']);
                    unset($data['data']['businessDescription']);
                    unset($data['data']['businessProfile']);
                    unset($data['data']['platforms']);
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'createdBPS'),
                        'data' => $data['data']
                    ];
                }else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'wrong'),
                    ];
                }
            }
        }    
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function businessStaffUpdate()
    {
        try{
            $userID = $this->decodeToken();
            $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
            $payload = $this->getRequestInput($this->request);
            $payload['userID'] = $userID;
            $image = 'profileImage';
            $folderName = 'staff';
            $FileName = $_FILES[$image]['name'];
            if($FileName !=  "")
            {
                $file = $this->uploadImages($image,$folderName);
                if($file['success'] == 1){
                    $payload['profileImage'] = $file['fileName'];
                    $update = $BusinessStaffAccountModel->where(["userID" => $userID,"SID" => $payload['SID']])->set($payload)->update();
                    if($update){
                        $data = $this->commonForStaffDetail($userID,$payload['SID'],1);
                        unset($data['data']['businessName']);
                        unset($data['data']['businessDescription']);
                        unset($data['data']['businessProfile']);
                        unset($data['data']['platforms']);
                        $response = [
                            'success' => 1,
                            'message' => $this->language_messages($userID,'updatedBPS'),
                            'data' => $data['data']
                        ];
                    }else{
                        $response = [
                            'success' => 0,
                            'message' => $this->language_messages($userID,'wrong'),
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => 'upload file error',
                    ];
                }
            }
            else{
                $update = $BusinessStaffAccountModel->where(["userID" => $userID,"SID" => $payload['SID']])->set($payload)->update();
                if($update){ 
                    $data = $this->commonForStaffDetail($userID,$payload['SID'],1);
                    unset($data['data']['businessName']);
                        unset($data['data']['businessDescription']);
                        unset($data['data']['businessProfile']);
                        unset($data['data']['platforms']);
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'updatedBPS'),
                        'data' => $data['data']
                    ];
                }else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'wrong'),
                    ];
                }
            }
        }    
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function businessStaffDelete($SID)
    {
        try{
            $userID = $this->decodeToken();
            $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
            $update = $BusinessStaffAccountModel->where(["userID" => $userID,"SID" => $SID])->set(['isDelete' => 1])->update();
            if($update){ 
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'deletedBPS'),
                ];
            }else{
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'wrong'),
                ];
            }
        }    
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function businessStaffView($SID)
    {
        try{
            $userID = $this->decodeToken();
            $response = $this->commonForStaffDetail($userID,$SID,1);
        }
        catch (\Exception $e)
        {
            $response = [
                    'success' => 0,
                    'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function commonForStaffDetail($userID,$SID,$type)
    {
        $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
        $where = $type == 1 ? ['userID' => $userID,'SID' => $SID] : ['SID' => $SID]; 
        $staffData = $BusinessStaffAccountModel->getWhere($where)->getRowArray();
        if($staffData) 
        {
            $staffData['userStatus'] = $staffData['status'];
            $BusinessAccountModel = $this->BusinessAccountModel;
            $businessData = $BusinessAccountModel->getWhere(['BID' => $staffData['BID']])->getRowArray();
            $staffData['businessName'] = $businessData['businessName']; 
            $staffData['businessDescription'] = $businessData['businessDescription']; 
            $staffData['businessProfile'] = $businessData['businessProfile']; 
            $staffData['userType'] = 'staff';
            $platformData = Services::userPlatformList($businessData['userID'],$staffData['BID'],'business');
            $staffData['platforms'] = $platformData;
            $theme = Services::getUserTheme($SID,'staff');
            $staffData['colorID'] = $theme['id'] ? $theme['id'] : '4';
            $staffData['color'] = $theme['color'] ? $theme['color'] : '#FFFFFF';
            $staffData['iconType'] = $theme['iconType'] ? $theme['iconType'] : 'Rectangular';
            $response = [
                'data' => $staffData,
                'success' => 1,
                'message' => $this->language_messages($userID,'dataFound'),
            ];
        }else{
            $response = [
                'success' => 1,
                'message' => $this->language_messages($userID,'dataNotFound'),
            ];
        }
        return  $response;
    }
    public function businessStaffList()
    {
        try{
            $userID = $this->decodeToken();
            //$limit = $this->request->getVar('limit');
             $limit = $this->request->getVar('limit') ? $this->request->getVar('limit') : 10;
            $offset = $this->pagination($limit);
            $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
            $BID = $this->request->getVar('BID');
            $userData = $BusinessStaffAccountModel->orderBY('SID','desc')->getWhere(['userID' => $userID,'BID' => $BID, 'isDelete' => 0],$limit, $offset)->getResultArray();
            if($userData) 
            {
               $count = $BusinessStaffAccountModel->select("COUNT(*) as total")->getWhere(['userID' => $userID,'BID' => $BID, 'isDelete' => 0])->getRowArray();
               $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                    'data' => $userData,
                    'total' => $count['total']
                ];
            }else{
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];
            }
        }
        catch (\Exception $e)
        {
            $response = [
                    'success' => 0,
                    'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function userDeviceTypesList()
    {
        try{
            $userID = $this->decodeToken();
            $DeviceTypesModel = $this->DeviceTypesModel;
            $deviceData = $DeviceTypesModel->orderBY('id','desc')->getWhere(['status' => 1])->getResultArray();
            if($deviceData) 
            {
               $response = [
                    'data' => $deviceData,
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                ];
            }else{
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];
            }
        }
        catch (\Exception $e)
        {
            $response = [
                    'success' => 0,
                    'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function deviceScan()
    {
        try{
            $userID = $this->decodeToken();
            $DevicesModel = $this->DevicesModel;
            $ActiveDevicesModel = $this->ActiveDevicesModel;
            $payload = $this->getRequestInput($this->request);
            $deviceData = $DevicesModel->getWhere(['deviceNumber' => $payload['deviceNumber']])->getRowArray();
            if($deviceData) 
            {
                if($deviceData['deviceType'] == $payload['deviceType']){
                    //if($deviceData['activeStatus'] == 0 || $deviceData['activeStatus'] != 0)
                    if($deviceData['activeStatus'] == 0)
                    {
                        $id = $deviceData['id'];
                        $deviceUpdateData = $DevicesModel->update($id,['activeStatus' => 1]);
                        $activePayload['userID'] = $userID;
                        $activePayload['profileID'] = $userID;
                        $activePayload['userType'] = 'public';
                        $activePayload['deviceID'] = $deviceData['id'];
                        $activePayload['deviceName'] = 'Maara'.$id;
                       // $activePayload['deviceType'] = $payload['deviceType'];
                        $activePayload['status'] = 1;
                        $deviceUpdateData ? $activeDevicesData = $ActiveDevicesModel->insert($activePayload) : "";   
                        $response = $deviceUpdateData ? 
                        [
                            'data' => $deviceData,
                            'success' => 1,
                            'message' => $this->language_messages($userID,'deviceActivate'),
                        ]
                         : 
                            [
                            'success' => 0,
                            'message' => $this->language_messages($userID,'wrong'),
                        ];
                    }
                    else {
                        $activeData = $ActiveDevicesModel->getWhere(["userID" => $userID,"deviceID" => $deviceData['id']])->getRowArray();
                        if($activeData['status'] == 3)
                        {
                            $payload1["profileID"] = $userID;
                            $payload1["userType"] = 'public';
                            $payload1["status"] = 1;
                            $ActiveDevicesModel->where(["userID" => $userID,"deviceID" => $deviceData['id']])->set($payload1)->update();
                            $response =
                            [
                                'data' =>  Services::getDevicesByID($payload['deviceNumber']),
                                'success' => 1,
                                'message' => $this->language_messages($userID,'deviceActivate'),
                            ];
                        }
                        else{
                            $response = [
                                'success' => 0,
                                'message' => $this->language_messages($userID,'deveiceInUse'),
                            ];   
                        }    
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'deviceTypeNotMatch'),
                    ];    
                }
                
            }else{
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'deviceNotAssoc'),
                ];
            }
        }
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    
    
 /*   public function deviceScan()
    {
        try{
            $userID = $this->decodeToken();
            $DevicesModel = $this->DevicesModel;
            $ActiveDevicesModel = $this->ActiveDevicesModel;
            $payload = $this->getRequestInput($this->request);
            $deviceType = $payload['deviceType'];
            $deviceData = $DevicesModel->getWhere(['deviceNumber' => $payload['deviceNumber']])->getRowArray();
            if($deviceData['activeStatus'] == 0 || $deviceData['activeStatus'] != 0)
            {
                $id = $deviceData['id'];
                $deviceUpdateData = $DevicesModel->where(['deviceNumber'])->update($id,['activeStatus' => 1]);
                $activePayload['userID'] = $userID;
                $activePayload['profileID'] = $userID;
                $activePayload['userType'] = 'public';
                $activePayload['deviceID'] = $deviceData['id'];
                $activePayload['deviceName'] = 'Maara'.$id;
               // $activePayload['deviceType'] = $payload['deviceType'];
                $activePayload['status'] = 1;
                $deviceUpdateData ? $activeDevicesData = $ActiveDevicesModel->insert($activePayload) : "";   
                $response = $deviceUpdateData ? 
                [
                    'data' => $deviceData,
                    'success' => 1,
                    'message' => "Device acivated successfully",
                ]
                 : 
                    [
                    'success' => 0,
                    'message' => "something went wrong",
                ];
            }
            else {
                $activeData = $ActiveDevicesModel->getWhere(["userID" => $userID,"deviceID" => $deviceData['id']])->getRowArray();
                if($activeData['status'] == 3)
                {
                    $payload1["profileID"] = $userID;
                    $payload1["userType"] = 'public';
                    $payload1["status"] = 1;
                    $ActiveDevicesModel->where(["userID" => $userID,"deviceID" => $deviceData['id']])->set($payload1)->update();
                    $response =
                    [
                        'data' => $deviceData,
                        'success' => 1,
                        'message' => "Device acivated successfully",
                    ];
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => 'This device is already in use',
                    ];   
                }    
            }
        }
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }*/
    public function userDeviceList()
    {
        try{
            $userID = $this->decodeToken();
            $devicesList = Services::userDevicesList($userID);
            if($devicesList) 
            {   
                $response = 
                [
                    'data' => $devicesList,             
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                ];
            }
            else{
                $response = [
                    'data' => [],
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];    
            }
        }
        catch (\Exception $e)
        {
            print_r($e);
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
    public function deviceAssignedToAccount()
    {
        try{
            $userID = $this->decodeToken();
            $ActiveDevicesModel = $this->ActiveDevicesModel;
            $payload = $this->getRequestInput($this->request);
            $deviceID =  $payload['deviceID'];
            $AID =  $payload['AID'];
            $payload['status'] = 1;
            unset($payload['deviceID']);
            unset($payload['AID']);
            $deviceUpdateData = $ActiveDevicesModel->where(["id" => $AID,"deviceID" => $deviceID])->set($payload)->update();
            $response = $deviceUpdateData ? 
            [
                'success' => 1,
                'message' => $this->language_messages($userID,'deviceAssgined'),
            ]
             : 
                [
                'success' => 0,
                'message' => $this->language_messages($userID,'wrong'),
            ];
        }
        catch (\Exception $e)
        {
            print_r($e);
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function renameDevice()
    {
        try{
            $userID = $this->decodeToken();
            $ActiveDevicesModel = $this->ActiveDevicesModel;
            $payload = $this->getRequestInput($this->request);
            $id = $payload['id'];
            unset($payload['id']);
            $ActiveDevicesUpdate =  $ActiveDevicesModel->where(['id' => $id,"userID" => $userID])->set(["deviceName" => $payload['deviceName']])->update();
            if($ActiveDevicesUpdate)
            {   
                $response = 
                [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'deviceNameChanged'),
                ];
            }
            else
            {
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'wrong'),
                ];    
            }
        }
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function unlinkOrRemoveDevice()
    {
        try{
            $userID = $this->decodeToken();
            $ActiveDevicesModel = $this->ActiveDevicesModel;
            $payload = $this->getRequestInput($this->request);
            $id = $payload['id'];
            unset($payload['id']);
            if($payload['type'] == 1 ){
                $ActiveDevicesUpdate =  $ActiveDevicesModel->where(['id' => $id,"userID" => $userID])->set(["status" => 2])->update();   
            }
            else{
                $ActiveDevicesUpdate =  $ActiveDevicesModel->where(['id' => $id,"userID" => $userID])->set(["status" => 3])->update();
            }
            if($ActiveDevicesUpdate)
            {   
                $response = 
                [
                    'success' => 1,
                    'message' => $payload['type'] == 1 ? $this->language_messages($userID,'deviceUnlink') : $this->language_messages($userID,'deviceRemove'),
                ];
            }
            else
            {
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'wrong'),
                ];    
            }
        }
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    /* Stop device */
    public function getPlatformByID($type)
    {
        $PlateformsModel = $this->PlateformsModel;
        $data2 = $PlateformsModel->select('*,image as rectImage')->getWhere(["type" => $type,"status" => 1])->getResultArray();
        return $data2;
    }
    public function plateforms()
    {
        try {
            $userID = $this->decodeToken();
            $PlateformsModel = $this->PlateformsModel;
            $data = $PlateformsModel->getWhere(["status" => 1])->getResultArray();
            $checks = array_values(array_column($data, 'type'));
            $dataArray = array("portfolio","contact","finance","social","business","other");
            foreach($dataArray as $val){
                if(in_array($val,$checks)){
                    $platformData1 = ['type' => $val,"platform" => $this->getPlatformByID($val)];
                }
                $platformData[]  = $platformData1; 
            }
            if($data)
            {
                $response = [
                    'data' => $platformData,
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                ];
            }
            else{
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];
            }
        } catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
    public function themes()
    {
        try {
            $userID = $this->decodeToken();
            $ThemesModel = $this->ThemesModel;
            $data = $ThemesModel->orderBy('id','desc')->getWhere(["status" => 1])->getResultArray();
            if($data)
            {
                $response = [
                    'data' => $data,
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                ];
            }
            else{
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];
            }
        } catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
    /*Start connection*/
    public function addConnection()
    {
        try {
            $userID = $this->decodeToken();
            $DevicesModel = $this->DevicesModel;
            $ConnectionsModel = $this->ConnectionsModel;
            $payload = $this->getRequestInput($this->request);
            /*$deviceData = $DevicesModel->getWhere(['deviceNumber' => $payload['deviceNumber']])->getRowArray();
            if($deviceData)
            {
                unset($payload['deviceNumber']);*/
                $payload['userID'] = $userID;
                $payload['deviceID'] = NULL;
                //$payload['deviceID'] = $deviceData['id'];
                $payload['createdDate'] = date('Y-m-d h:i:s');
                $isSameUser = Services::searchAccountID($userID);
                if(($isSameUser['id'] == $payload['profileID'] && $payload['userType'] == 'public') || 
                    ($payload['userType'] == 'business' && array_search($payload['profileID'],explode(",",$isSameUser['bid'])) !== false ) ||
                    ($payload['userType'] == 'private' && array_search($payload['profileID'],explode(",",$isSameUser['pid'])) !== false ) ||
                    ($payload['userType'] == 'staff' && array_search($payload['profileID'],explode(",",$isSameUser['sid'])) !== false )
                    ){
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'sameProfile'),
                    ];
                }
                else{
                //if($userID == $payload['profileID'])
                $ifExist = $ConnectionsModel->getWhere(["userID" => $userID,"profileID"=>$payload['profileID'],"userType"=>$payload['userType']])->getRowArray();
                if($ifExist){
                    $update = $ConnectionsModel->where(["userID" => $userID,"profileID"=>$payload['profileID'],"userType"=>$payload['userType']])->set($payload)->update();
                }
                else{
                    $update = $ConnectionsModel->insert($payload);
                    $payload1['userID'] = $userID;
                    $payload1['accountID'] = $payload['profileID'];
                    $payload1['userType'] = $payload['userType'];
                    $payload1['deviceID'] = 0;
                    $payload1['deviceNumber'] = NULL;
                    $payload1['count'] = 0;
                    $this->addAnalytics($payload1);
                    //echo $ConnectionsModel->getLastQuery();
                }
                if($update)
                {

                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'connectionList')
                    ];
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'wrong'),
                    ];
                }       
            /*}
            else
            {
                $response = [
                    'success' => 0,
                    'message' => 'Device does not exist',
                ];
            }*/
            }   
        } catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
    public function userConnectionList()
    {
        try{
            $userID = $this->decodeToken();
            $limit = 10;
            $offset = $this->pagination($limit);
            $devicesList = Services::userConnectionList($userID,$offset,$limit);
            if($devicesList) 
            {   
                $response = 
                [
                    'data' => $devicesList,             
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataFound'),
                ];
            }
            else{ 
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];    
            }
        }
        catch (\Exception $e)
        {
            print_r($e);
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
    public function connectionUserDetail()
    {
        try{
            $userID = $this->decodeToken();
            $payload = $this->getRequestInput($this->request);
            $key =   $payload['key'];
            $deviceNumber = $payload['deviceNumber'];
            
            if($key){
                $decode = $this->AESDecrpt($key);
                $profileID  = $decode['decode']['0'];
                $userType = $decode['decode']['1'];   
            }
            else if($deviceNumber)
            {
                $device = Services::getDeviceByTagID($deviceNumber);
                $profileID  = $device['profileID'];
                $userType = $device['userType'];
                if($device['status'] == 1)
                {
                    $payload1['userID'] = $userID;
                    $payload1['accountID'] = $profileID;
                    $payload1['userType'] = $userType;
                    $payload1['deviceID'] = $device['deviceID'];
                    $payload1['deviceNumber'] = $device['deviceNumber'];
                    $payload1['count'] = 1;
                    $this->addAnalytics($payload1);
                }
            }
            else{
                $profileID  =  $payload['profileID'];
                $userType = $payload['userType'];
            }
            $check = Services::getConnectedUserStatus($userID,$profileID,$userType,'public');
            $status = $check ? $check['status'] : "0";
            if($userType == 'business')
            {
                $response = $this->commonForBusinessDetailWeb($userID,$profileID,0);
                $response['data']['status'] = $status;
                $response['data']['profileID'] = (string) $profileID;
            }
            else if($userType == 'staff')
            {
                $response = $this->commonForStaffDetail($userID,$profileID,0);
                $response['data']['status'] = $status;
                $response['data']['profileID'] = (string) $profileID;
            }
            else if($userType == 'private')
            {
                $response = $this->commonForPrivateDetail($userID,$profileID,0);
                //print_r($response);
                $response['data']['status'] = $status;
                $response['data']['profileID'] = (string) $profileID;
            }
            else if($userType == 'public')
            {
                $UserModel = $this->UserModel; 
                $userDetail = $UserModel->select('firstName,lastName,email,userProfile,designation,description,status as userStatus')->getWhere(["id" => $profileID])->getRowArray();
                if($userDetail) 
                {
                    $userDetail['status'] = $status;
                    $userDetail['profileID'] = (string) $profileID;
                    $platformData = Services::userPlatformList($profileID,$profileID,'public');
                    $theme = Services::getUserTheme($userID,'public');
                    $userDetail['colorID'] = $theme['id'] ? $theme['id'] : '4';
                    $userDetail['color'] = $theme['color'] ? $theme['color'] : '#FFFFFF';
                    $userDetail['iconType'] = $theme['iconType'] ? $theme['iconType'] : 'Rectangular';
                    $userDetail['userType'] = 'public';
                    $userDetail['platforms'] = $platformData;
                    $response = [
                        'data' => $userDetail,
                        'success' => 1,
                        'message' => $this->language_messages($userID,'dataFound'),
                    ];
                }else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'dataNotFound'),
                    ];
                }
            }
            else{
                $response = 
                    [             
                        'success' => 1,
                        'message' => $this->language_messages($userID,'typeNotExist'),
                    ];   
            }
        }
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
    public function userPlatformOrder()
    {
        try{
            $userID = $this->decodeToken();
           $UserPlateformsModel = $this->UserPlateformsModel;
            $payload = $this->getRequestInput($this->request);
            $accountID = $payload['accountID'];
            $userType = $payload['userType'];
            $platformsIDs = $payload['order'] ? json_decode($payload['order']) : "";
          //  print_r($platformsIDs);
		    if (!empty($payload['order'])) 
		    {
		        $app_order = 1;
		        foreach ($platformsIDs as $id) {
		            if ($id > 0) {
		                $update = $UserPlateformsModel->where(['userID' => $userID,'accountID' => $accountID,'userType' => $userType,'id' => $id])->set(['order' => $app_order])->update();
		                $app_order++;
		            }
		        }
			}
        	$response = [
                'success' => 1,
                'message' => $this->language_messages($userID,'orderUpdate'),
            ];
        }
        catch(\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
    /*stop connection section*/
    public function tyt($rt)
    {
        $PlateformsModel = $this->PlateformsModel;
        $data = $PlateformsModel->getWhere(["type" => $rt,"status" => 1])->getResultArray();
        return $data;  
    }
    public function plateforms2()
    {
        try {
           // $userID = $this->decodeToken();
            $PlateformsModel = $this->PlateformsModel;
            $type = $this->request->getVar('page');
            $data = $PlateformsModel->getWhere(["status" => 1])->getResultArray();
            $checks = array_values(array_column($data, 'type'));
            $dataArray = array("portfolio","contact","finance","social","business","other");
            foreach($dataArray as $val){
                if(in_array($val,$checks)){
                    $platformData1 = ['type' => $val,"platform" => $this->tyt($val)];
                }
                $platformData[]  = $platformData1; 
            }
            if($data)
            {
                $response = [
                    'data' => $platformData,
                    'success' => 1,
                    'message' => 'Data Found',
                ];
            }
            else{
                $response = [
                    'success' => 0,
                    'message' => 'Data not found',
                ];
            }
        } catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);    
    }
   public function getUserProfileForWeb($key)
    {
        try{
            //print_r($this->AESDecrpt('+Qh48hqWDQKn0zxW1jbRgB/f0GbUdQ=='));
            if($key){
                $decode = $this->AESDecrpt($key);
                $profileID  = $decode['decode']['0'];
                $userType = $decode['decode']['1'];   
            }
            else{
                
            }
            
            if($userType == 'business')
            {
                $response = $this->commonForBusinessDetailWeb($userID,$profileID,0);   
                $response['data']['profileID'] = (string) $profileID;
                $response['data']['app'] = Services::userPlatformSingle($userID,$profileID,'business');
            }
            else if($userType == 'staff')
            {
                $response = $this->commonForStaffDetail($userID,$profileID,0); 
                $response['data']['profileID'] = (string) $profileID;
                $response['data']['app'] = Services::userPlatformSingle($userID,$profileID,'staff');
            }
            else if($userType == 'private')
            {
                $response = $this->commonForPrivateDetail($userID,$profileID,0);  
                $response['data']['profileID'] = (string) $profileID;
                $response['data']['app'] = Services::userPlatformSingle($userID,$profileID,'private');
            }
            else if($userType == 'public')
            {
                $UserModel = $this->UserModel; 
                $userDetail = $UserModel->select('id,firstName,lastName,email,userProfile,designation,description,status')->getWhere(["id" => $profileID])->getRowArray();
                if($userDetail) 
                {
                    $platformData = Services::userPlatformList($profileID,$profileID,'public');
                    $theme = Services::getUserTheme($profileID,'public');
                    $app = Services::userPlatformSingle($profileID,$profileID,'public');
                    $userDetail['userType'] = 'public';
                    $userDetail['profileID'] = (string) $profileID;
                    $userDetail['userID'] = $userDetail['id'];
                    $userDetail['colorID'] = $theme['id'] ? $theme['id'] : '4';
                    $userDetail['color'] = $theme['color'] ? $theme['color'] : '#FFFFFF';
                    $userDetail['iconType'] = $theme['iconType'] ? $theme['iconType'] : 'Rectangular';
                    $userDetail['platforms'] = $platformData;
                    $userDetail['app'] = $app;
                    $response  = [
                        'data' => $userDetail,
                        'success' => 1,
                        'message' => 'Data found'
                    ];
                }else{
                    $response = [
                        'success' => 1,
                        'message' => 'Data not found',
                    ];
                }
            }
            else{
                $response = 
                    [             
                        'success' => 1,
                        'message' => "Type does not exist",
                    ];   
            }
        }
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        $response['userID'] = $response['data']['userID'];
        $response['platformImages'] = $this->BaseURL.'/uploads/platform/';
        $response['staffImages'] = $this->BaseURL.'/uploads/staff/';
        $response['businessAccounts'] = $this->BaseURL.'/uploads/businessAccounts/';
        $response['privateAccounts'] = $this->BaseURL.'/uploads/privateAccounts/';
        $response['users'] = $this->BaseURL.'/uploads/users/';
        $response['userType'] = $userType;
        $response['device'] = $this->get_user_device();
        echo view('userProfile', $response);
    }
    public function getUserDetailByDeviceNumberOnWeb($deviceNumber)
    {
        if(!empty($deviceNumber))
        {
            $device = Services::getDeviceByTagID($deviceNumber);
            if(!empty($device))
            {
                if($device['status'] == 1)
                {
                    $encode = $this->createProfileURL($device['profileID'],$device['userType']);
                    return redirect()->to(base_url().'/profile/'.$encode['key']); 
                }
                else{
                    $data['success'] = 0;
                }
            }
            else
            {
                $data['success'] = 0;
            }
        }
        else{
            $data['success'] = 0;
        }
        echo view('userProfile_404', $data);
    }
    public function sendMailToConnectOnWeb()
    {
        try{
            $rules = [
				"name" => "required",
				"email" => "required|valid_email",
				"phone" => "required",
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                $response = $error['name'].'<br>'.$error['email'].'<br>'.$error['phone'];
                /*$response		    = array (
				    'success'	    => 0,
				    'msg'		    => $errors,
			    );*/
            }
            else{
                $UserModel = $this->UserModel;
                $userData = $UserModel->select('email')->getWhere(['id' => $payload['userID']])->getRowArray();
                $email = $userData['email'];
                $subject = "Connection user detail";
                $message .= "Hello, please check below user detail for connection <br><br>";
                $message .= 'Name: '. $payload['name'] . '<br><br>';
    	        $message .= 'Email: '. $payload['email'] . '<br><br>';
    	        $message .= 'Phone: '. $payload['phone'];
                $checkMail = $this->sendMail($email,$subject,$message,0);
                if($checkMail)
                {
                    echo 1;
                    /*$response		    = array (
				    'success'	    => 1,
				    'msg'		    => "Mail has been sent successfully",
			    );*/
                }
                else{
                    echo "There is something wrong in mail";
                   /* $response		    = array (
				    'success'	    => 0,
				    'msg'		    => "There is something wrong in mail",
			    );*/
                }
            }  
        }
        catch(\Exception $e)
        {
          $response = $e->getMessage();   
          /*$response		    = array (
				    'success'	    => 0,
				    'msg'		    => $e->getMessage(),
			    );*/
        }
        echo $response;     
    }
    
   
	public function addAnalytics($payload)
	{
	    $AnalyticsModel = $this->AnalyticsModel;
	    $isCheck = $AnalyticsModel->getWhere(['deviceNumber' => $payload['deviceNumber'],"userID" => $payload['userID'],"count" => 1])->getNumRows();
	    if($isCheck == 0){
	        $payload['status'] = 1;
	        $AnalyticsModel->insert($payload);   
	    }
	}
	
	 /*Start Subscription Panel*/
	public function subscription()
	{
	    try {
	        $data = file_get_contents("php://input");
            if ( ! empty ( $data ) ) {
                $res1 = json_decode( $data );
                if ( isset ( $res1->message->data ) ) {
                    $res2 = json_decode( base64_decode( $res1->message->data ) );
                    $cancel_types = array (12,13); // don't delete entry in case of 3
                    if ( isset ( $res2->subscriptionNotification ) ) {
                        $res = $res2->subscriptionNotification;
                        if ( in_array ( $res->notificationType, $cancel_types ) ) {
                            $purchaseToken = $res->purchaseToken;
                            $SubscriptionsModel = $this->SubscriptionsModel;
                            $row = $SubscriptionsModel->select('userID')->getWhere(['transactionID' => $purchaseToken])->getRowArray();
                            if ($row) {
                    			$userID    = $row['userID'];
                    			$UserModel = $this->UserModel;
                    			$UserModel->where(['id' => $userID])->set(['isLogout' => 1,'deviceToken' => NULL])->update();
        		                $SubscriptionsModel->where(['userID' => $userID])->delete();
                            }
                        }
                    }
                }
            }
	    }
	    catch(Exception $e)
	    {
	        $res2 = ["success" => 0, "message" => $e->getMessage()];  
	    }
	    return $this->respondCreated($res2);    
	}
	public	function addSubscription()
	{
		try{
		    $userID = $this->decodeToken();
		    $SubscriptionsModel = $this->SubscriptionsModel;
		    $SubscriptionsLogModel = $this->SubscriptionsLogModel;
            $payload = $this->getRequestInput($this->request);
            $payload['status'] = 1;
            $payload['userID'] = $userID;
         //   $payload['createdDate'] = date('Y-m-d h:i:s');
            $SubscriptionLog = $SubscriptionsLogModel->insert($payload);
            $isCheck = $SubscriptionsModel->getWhere(["userID" => $userID])->getNumRows();
            if($isCheck == 0)
            {
                $SubscriptionAdd = $SubscriptionsModel->insert($payload);                    
            }
            else{
                 $SubscriptionAdd = $SubscriptionsModel->where(['userID' => $userID])->set($payload)->update(); 
            }
            if($SubscriptionAdd){
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'subscriptionUpgrade'),
                ];
            }
            else{
                  $response = [
                'success' => 0,
                'message' => $this->language_messages($userID,'wrong'),
            ];
            }
		}
		catch(Exception $e){
		       $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
		}
		return $this->respondCreated($response);
	}
	public function subscriptionIOS() 
	{
	    try{
	        $data = file_get_contents("php://input");
            if ( ! empty ( $data ) ) {
                $event = json_decode( $data );
                $cancel_types = array ( 'CANCEL', 'DID_FAIL_TO_RENEW', 'REFUND', 'REVOKE' ); // DID_CHANGE_RENEWAL_STATUS Renewal case
                if ( in_array ( $event->notification_type, $cancel_types ) ) {
                    $purchaseToken = $event->original_transaction_id;
                    $SubscriptionsModel = $this->SubscriptionsModel;
                    $row = $SubscriptionsModel->select('userID')->getWhere(['transactionID' => $purchaseToken])->getRowArray();
                    if ($row) {
            			$userID    = $row['userID'];
            			$UserModel = $this->UserModel;
            			$UserModel->where(['id' => $userID])->set(['isLogout' => 1,'deviceToken' => NULL])->update();
		                $SubscriptionsModel->where(['userID' => $userID])->delete();
                    }
                }
            }
	    }
	    catch(Exception $e){
	        
	    }
	 }
		
/*		function delete_subscription ( $user_id ) {
		    if ( $user_id > 0 ) {
		        $this->CI->db->where ( 'user_id', $user_id );
				$this->CI->db->delete ( 'user_subscription' );
		    }
		}*/
	/*Stop Subscription Panel*/
	
}

