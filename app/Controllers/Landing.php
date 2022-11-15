<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use Config\Services;

class Landing extends BaseController
{
    public function index()
    {
        //echo "<h1>Coming Soon </h1>";
        try
        {
            $session = $this->session;
            $products = Services::getHomeRecentProducts();
            $data['products'] = $products;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('homeSuccess','homeError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('homeError',[$g->getMessage()]);
        }
        $this->loadLandingViews('index',$data); 
    }
    public function register()
    {
        try
        {
            $session = $this->session;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('registerSuccess','registerError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('registerError',[$g->getMessage()]);
        }
        $this->loadLandingViews('auth/register',$data);   
    }
    public function login()
    {
        try
        {
            $session = $this->session;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('loginSuccess','loginError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('loginError',[$g->getMessage()]);
        }
        $this->loadLandingViews('auth/login',$data);   
    }
    public function logout()
    {
       try
        {
            $session = $this->session;
            unset($_SESSION['userToken']);
            unset($_SESSION['maaraUserIsLoggedIn']);
            unset($_SESSION['email']);
            $session->destroy();
            return redirect()->to($this->BaseURL);
        }    
        catch (\Exception $e)
        {
            return redirect()->to($this->BaseURL);
        }
    }
    public function registerUser()
    {
        try{
            $session = $this->session;
            $UserModel = $this->UserModel;
            $rules = [
                "firstName" => "required",
                "lastName" => "required",
                "designation" => "required",
                "dob" => "required",
    			"email" => "required|valid_email|max_length[128]|trim",
    			"password" => "required|min_length[8]|max_length[32]",
    			"cofirmPassword" => "required|matches[password]",
    		];
    		$input = $this->getRequestInput($this->request);
            if (!$this->validateRequest($input, $rules)) {
                $error = $this->validator->getErrors();
                //$data['validation'] = $this->validator;
                
                $session->setFlashdata('registerError',$error);
                return redirect()->to($this->BaseURL1.'register');
                //$this->loadLandingViews('auth/register',$data); 
            } else {
                $email = $this->request->getVar("email");
                $dataEmail = $UserModel->getWhere(['email' => $email,'isWeb' => 1])->getRowArray();
                if($dataEmail){
                    $session->setFlashdata('registerError',['Your email is already registered']);
                    return redirect()->to($this->BaseURL1.'register'); 
                }
                else{
                    $payload = $this->getRequestInput($this->request);
                    $payload['password'] = password_hash($this->request->getVar("password"),PASSWORD_DEFAULT);
                    $payload['status'] = 1;
                    $payload['isLoggedIN'] = 0;
                    $payload['isWeb'] = 1;
                    $payload['isProfile'] = 1;
                    $payload['createdDate'] = date('Y-m-d H:i:s');
                    if($UserModel->insert($payload)) 
                    {
                        $session->setFlashdata('loginSuccess',['You have register successfully please login.']);
                        return redirect()->to($this->BaseURL1.'login');
                    }else{
                        $session->setFlashdata('registerError',['Something went wrong']);
                        return redirect()->to($this->BaseURL1.'register');
                    }
                }
            }
        }
        catch(Exception $e){
            $session->setFlashdata('registerError',['Something went wrong']);
            return redirect()->to($this->BaseURL1.'register');
        }
    }    
    public function loginUser()
    {
         try {
            $session = $this->session;
            $UserModel = $this->UserModel;
            $rules = [
				"email" => "required",
				"password" => "required"
			];
			$payload = $this->getRequestInput($this->request);
           if (!$this->validateRequest($payload, $rules)) {
                $error = $this->validator->getErrors();
                $session->setFlashdata('loginError',$error);
                return redirect()->to($this->BaseURL1.'login');
            }
            else{
                $password = $this->request->getVar("password");
                $email = $this->request->getVar("email");
                $userData = $UserModel->getWhere(['email' => $email,'isWeb' => 1])->getRowArray();
                if($userData){
                    $passCheck = password_verify($password, $userData['password']); 
                    if($passCheck){
                        if($userData['isSuspended'] == 0){
                            $session->setFlashdata('loginError',['Your account has been suspended']);
                            return redirect()->to($this->BaseURL1.'login');
                        }
                        else{
                            $token = $this->encodeToken($userData['id'],0);
                            $sessiondata = [
                                'userToken'  => $token,
                                'email'  => $email,
                                'maaraUserIsLoggedIn' => 1,
                            ];
                            $session->set($sessiondata);
                            $this->saveInCartDB($userData['id']);
                            $session->setFlashdata('loginSuccess',['You have successfully logged in']);
                            return redirect()->to($this->BaseURL1);
                        }
                    }
                    else{
                        $session->setFlashdata('loginError',['Login Failed! Password Is Invalid.']);
                        return redirect()->to($this->BaseURL1.'login');
                    }
                }
                else{
                    $session->setFlashdata('loginError',['Login Failed! Email Is Invalid.']);
                    return redirect()->to($this->BaseURL1.'login');
                }
            }
        } catch (Exception $e) {
            $session->setFlashdata('loginError',['Something went wrong']);
            return redirect()->to($this->BaseURL1.'login');
        }
    }
    public function shop()
    {
        try
        {
            $session = $this->session;
            $DeviceTypesModel = $this->DeviceTypesModel;
            $devicesTypes = $DeviceTypesModel->getWhere(["status" => 1])->getResultArray();
            foreach($devicesTypes as $devicesType)
            {
                $products = Services::getRelatedProducts(0,$devicesType['id']);
                $devicesType['products'] = $products;
                $results[] = $devicesType;
            }
            $data['devicesTypes'] = $results;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('shopSuccess','shopError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('homeError',[$g->getMessage()]);
        }
        $this->loadLandingViews('shop',$data);   
    }
    public function services()
    {
        try
        {
            $session = $this->session;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('servicesSuccess','servicesError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('homeError',[$g->getMessage()]);
        }
        $this->loadLandingViews('services',$data);   
    }
    public function help()
    {
        try
        {
            $session = $this->session;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('helpSuccess','helpError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('homeError',[$g->getMessage()]);
        }
        $this->loadLandingViews('help',$data);   
    }
    public function team()
    {
        try
        {
            $session = $this->session;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('teamSuccess','teamError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('teamError',[$g->getMessage()]);
        }
        $this->loadLandingViews('team',$data);   
    }
    public function productDetail($id)
    {
        try
        {
            $session = $this->session;
            $productID = base64_decode($id);
            $ProductsModel = $this->ProductsModel;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $product = Services::getProductDetail1($productID);
            $images = Services::getProductImages($productID);
            $relatedProducts = Services::getRelatedProducts($product['id'],$product['deviceTypeID']);
            $data['product'] = $product;
            $data['productImages'] = $images;
            $data['relatedProducts'] = $relatedProducts;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('productSuccess','productError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('productError',[$g->getMessage()]);
        }
        $this->loadLandingViews('productDetail',$data);
    }
        public function cartList()
    {
        try
        {
            $session = $this->session;
           // $session->destroy();
            $data['items'] = $_SESSION['cartItems'] ? $_SESSION['cartItems'] : [];
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('cartSuccess','cartError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('cartError',[$g->getMessage()]);
        }
        $this->loadLandingViews('cart',$data);    
    }
    public function generateTokenofPayment($amount)
    {
        $MerchandID = $this->MerchandID;
        $ApiKey = $this->ApiKey;
        $headers = array (
                 "X-SYCA-MERCHANDID:$MerchandID", 
                 "X-SYCA-APIKEY:$ApiKey", 
                 'X-SYCA-REQUEST-DATA-FORMAT: JSON',
                 'X-SYCA-RESPONSE-DATAFORMAT: JSON',
                );
        $paramsend = array (
            "montant" =>$amount, 
            "curr" =>$this->currency
        );
        $url = $this->paymentURL;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION ,CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data_json = json_encode($paramsend);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $response = json_decode(curl_exec($ch),TRUE);
        curl_close($ch);
        
        if($response['code'] == 0)
        {
            $token = $response['token'];
        }
        else {
            $token = $response['token'];
        }
        return $token;
    }
    public function checkout()
    {
        try
        {
            $session = $this->session;
            $OrdersModel = $this->OrdersModel;
            $location = $this->ipInfo($ip = NULL, $purpose = "location", $deep_detect = TRUE);
            $countries = $this->CountryModel->findAll();
            $states = $this->StateModel->getWhere(['countryCode' => $location['country_code']])->getResultArray();
            $data['items'] = $_SESSION['cartItems'] ? $_SESSION['cartItems'] : [];
            $data['countries'] = $countries;
            $data['states'] = $states;
            $data['countryCode'] = $location['country_code'];
            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
            $order = $OrdersModel->getWhere(['userStatus' => 0,'userID' => $userID])->getRowArray();
            if($order)
            {
                $orderID = $order['orderID'];
                //$data['carts'] = Services::cartListLanding($orderID);//$_SESSION['cartItems'] ? $_SESSION['cartItems'] : [];
                $data['order'] = Services::getorderDetailLanding($orderID);   
            }    
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('checkoutSuccess','checkoutError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('checkoutError',[$g->getMessage()]);
        }
        $this->loadLandingViews('checkout',$data);    
    }
    public function payment()
    {
        try
        {
            $session = $this->session;
            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
            $OrdersModel = $this->OrdersModel; 
            $order = $OrdersModel->getWhere(['userStatus' => 0,'userID' => $userID])->getRowArray();
            if($order)
            {
                $orderID = $order['orderID'];
                $data['carts'] = Services::cartListLanding($orderID);//$_SESSION['cartItems'] ? $_SESSION['cartItems'] : [];
                $data['order'] = Services::getorderDetailLanding($orderID);   
            }
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('paymentSuccess','paymentError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('checkoutError',[$g->getMessage()]);
        }
        $this->loadLandingViews('payment',$data);    
    }
    public function changeProductColorImage()
    {
        try
        {
            $session = $this->session;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $productID = $this->decodeBase64Data($this->request->getVar('productID'));
            $colorID =$this->decodeBase64Data($this->request->getVar('colorID'));
            $colorImage = $ProductColorImagesModel->getwhere(['productID' => $productID,'colorID' => $colorID])->getRowArray();
            if($colorImage['image'] != ""){ ?>
                <img src="<?php echo $this->productImagePath.$colorImage['image']; ?>" class="img-fluid"> 
            <?php } else { ?>
                <img src="<?php echo $this->images; ?>pvc_card.png" class="img-fluid"> 
        <?php
            }
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    public function getStatesByCountry()
    {
        try
        {
            $country = $this->request->getVar('country');
            $states = $this->StateModel->getWhere(['countryCode' => $country])->getResultArray();
            if($states){
                echo '<option value="">State</option>';
            foreach($states as $state) { ?>
                <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
            <?php }
            }
            else
            {
                echo 0;    
            }
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    public function addToCart()
    {
        try
        {
            $session = $this->session;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $productQty = 1;
            $productID = $this->decodeBase64Data($this->request->getVar('productID'));
            $colorID = $this->request->getVar('colorID') ? $this->decodeBase64Data($this->request->getVar('colorID')) : 0;
            $fetchProduct = Services::getProductDetail($productID);
            $colorImage = Services::getProductImagesColor($productID,$colorID);//$ProductColorImagesModel->getwhere(['productID' => $productID,'colorID' => $colorID])->getRowArray();
            $subTotal = number_format($productQty * $fetchProduct['price'],2);
            
            $cartArray = [
                'productID' => $productID,
                'qty' => $productQty,
                'name' =>$fetchProduct['name'],
                'price' => $fetchProduct['price'],
                'subTotal' => $subTotal,
                'image' => $colorImage['image'],
                'colorID' => $colorID,
                'colorName' => $colorImage['colorName'],
                'orderID' => 0,
                'itemID' => 0,
                'isCustom' => 0
            ];
            $colorProduct = ["productID" => $productID,"colorID" => $colorID];
            if(isset($_SESSION['cartItems']) && !empty($_SESSION['cartItems']))
            {
                //echo "test1";
                $productIDs = [];
                foreach($_SESSION['cartItems'] as $cartKey => $cartItem)
                {
                    $productIDs[] = $cartItem['productID'];
                    $colorIDs[] = ["productID" => $cartItem['productID'],"colorID" => $cartItem['colorID']];
                    if(($cartItem['productID'] == $productID) && ($colorID == $cartItem['colorID']) && $cartItem['isCustom'] == 0)
                    {
                        $qty = $_SESSION['cartItems'][$cartKey]['qty'] ? $_SESSION['cartItems'][$cartKey]['qty'] + $productQty : $productQty;
                        $price = $_SESSION['cartItems'][$cartKey]['price'];
                        $_SESSION['cartItems'][$cartKey]['qty'] = $qty;
                        $_SESSION['cartItems'][$cartKey]['subTotal'] = $qty * $price;
                        $payload['price'] = $price;
                        $payload['qty'] = $qty;
                        if($_SESSION['maaraUserIsLoggedIn'] == 1)
                        {
                            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                            $this->updateOrderItems($userID,$cartItem['orderID'],$cartItem['itemID'],$payload);
                        }
                        break;
                    }
                    
                }
    
                if(!in_array($productID,$productIDs) && $cartArray['isCustom'] == 0)
                {
                    //echo "test2";
                    $_SESSION['cartItems'][]= $cartArray;
                    $key =  count($_SESSION['cartItems'])-1;
                    if($_SESSION['maaraUserIsLoggedIn'] == 1)
                    {
                        $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                        $item = $this->saveToCart($userID,NULL,NULL,1,$_SESSION['cartItems'][$key]);
                        $_SESSION['cartItems'][$key]['orderID'] = $item['orderID'];
                        $_SESSION['cartItems'][$key]['itemID'] = $item['itemID'];
                    }
                    $successMsg = true;
                }
                if((in_array($productID,$productIDs)) && (!in_array($colorProduct,$colorIDs)) && $cartArray['isCustom'] == 0)
                {
                    //echo "test3";
                    $_SESSION['cartItems'][]= $cartArray;
                    $key =  count($_SESSION['cartItems'])-1;
                    if($_SESSION['maaraUserIsLoggedIn'] == 1)
                    {
                        $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                        $item = $this->saveToCart($userID,NULL,NULL,1,$_SESSION['cartItems'][$key]);
                        $_SESSION['cartItems'][$key]['orderID'] = $item['orderID'];
                        $_SESSION['cartItems'][$key]['itemID'] = $item['itemID'];
                    }
                    $successMsg = true;
                }
                
            }
            else
            {
               // echo "test4";
                $_SESSION['cartItems'][]= $cartArray;
                if($_SESSION['maaraUserIsLoggedIn'] == 1)
                {
                    $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                    $item = $this->saveToCart($userID,NULL,NULL,1,$_SESSION['cartItems'][0]);
                    $_SESSION['cartItems'][0]['orderID'] = $item['orderID'];
                    $_SESSION['cartItems'][0]['itemID'] = $item['itemID'];
                }
                $successMsg = true;
            }
            $cartCount = array_sum(array_values(array_column($_SESSION['cartItems'], 'qty')));
            $subTotal = array_sum(array_values(array_column($_SESSION['cartItems'], 'subTotal')));
            $_SESSION['cartCount'] = $cartCount;
            $_SESSION['subTotal'] = $subTotal;
            foreach($_SESSION['cartItems'] as $product)
            {
                if($product['image'] != ""){
                    $image = $this->productImagePath.$product['image'];
                }
                else{
                    $image = $this->images."pvc_card";
                }
                
                $items[] = 
                '<li class="list-group-item d-flex justify-content-between lh-condensed" id="headerItemID'.base64_encode($product['id'].$salt).'">
                    <div class="d-flex">
                       <div class="product-thumbnail">
                          <div class="product-thumbnail__wrapper">
                                <img src="'.$this->productImagePath.$product['image'].'">
                          </div>
                       </div>
                       <div class="d-flex flex-column ms-3">
                          <h6 class="my-0">'.$product['name'].'</h6>
                          <small class="text-muted">'.$product['colorName'].'</small>
                          <small class="text-muted">Qty: '.$product['qty'].'</small>
                       </div>
                    </div>
                    <span class="text-muted">'.$this->currencySign.$product['price'].'</span>
                 </li>';
             }
             echo json_encode(array(
                "items" => $items,
                "subTotal"=> $this->currencySign.$subTotal,
                "cartCount" => $cartCount,
            ));
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    public function changeCartQty()
    {
        try
        {
            $session = $this->session;
            $productQty = 1;
            $qty = $this->request->getVar('qty');
            $productID = $this->decodeBase64Data($this->request->getVar('productID'));
            $colorID = $this->request->getVar('colorID') ? $this->decodeBase64Data($this->request->getVar('colorID')) : 0;
            foreach($_SESSION['cartItems'] as $cartKey => $cartItem){
                if(($cartItem['productID'] == $productID) && $cartItem['isCustom'] == 0)//if($productID == $cartItem['productID'])
                {
                    if($colorID == $cartItem['colorID'])
                    {
                        if($qty == '0') {
            			  unset($_SESSION["cartItems"][$cartKey]);
            			  if($_SESSION['maaraUserIsLoggedIn'] == 1)
                            {
                                $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                                $this->deleteItem($userID,$cartItem['orderID'],$cartItem['itemID']);
                            }
            		  } else {
            		      
            			$_SESSION['cartItems'][$cartKey]['qty'] = $qty;
                        $price = $_SESSION['cartItems'][$cartKey]['price'];
                        $_SESSION['cartItems'][$cartKey]['subTotal'] = $qty * $price;
                        $_SESSION['itemSubTotal'] = $qty * $price;
                        $payload['price'] = $price;
                        $payload['qty'] = $qty;
                        if($_SESSION['maaraUserIsLoggedIn'] == 1)
                        {
                            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                            $this->updateOrderItems($userID,$cartItem['orderID'],$cartItem['itemID'],$payload);
                        }
            		  }
                    }
                    else{
                        
                    }
                }
                else if(($cartItem['productID'] == $productID) && $cartItem['isCustom'] == 1)
                {
                    //echo "test";
                    if($qty == '0') 
                    {
        			    unset($_SESSION["cartItems"][$cartKey]);
        			    if($_SESSION['maaraUserIsLoggedIn'] == 1)
                        {
                            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                            $this->deleteItem($userID,$cartItem['orderID'],$cartItem['itemID']);
                        }
            		} 
            		else 
            		{      
            			$_SESSION['cartItems'][$cartKey]['qty'] = $qty;
                        $price = $_SESSION['cartItems'][$cartKey]['price'];
                        $_SESSION['cartItems'][$cartKey]['subTotal'] = $qty * $price;
                        $_SESSION['itemSubTotal'] = $qty * $price;
                        $payload['price'] = $price;
                        $payload['qty'] = $qty;
                        if($_SESSION['maaraUserIsLoggedIn'] == 1)
                        {
                            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                            $this->updateOrderItems($userID,$cartItem['orderID'],$cartItem['itemID'],$payload);
                        }
            		}
                }
            }
            $cartCount = array_sum(array_values(array_column($_SESSION['cartItems'], 'qty')));
            $subTotal = array_sum(array_values(array_column($_SESSION['cartItems'], 'subTotal')));
            $_SESSION['cartCount'] = $cartCount;
            $_SESSION['subTotal'] = $subTotal;
            echo json_encode(array(
                "subTotal"=> $this->currencySign.$subTotal,
                "cartCount" => $cartCount,
                "itemSubTotal" => $this->currencySign.$_SESSION['itemSubTotal'],
            ));
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    public function saveInCartDB($userID)
    {
        $session = $this->session;
      //  session_set_cookie_params(['samesite' => 'None', 'secure' => true]);
        $OrdersModel = $this->OrdersModel; 
        $OrderItemsModel = $this->OrderItemsModel;
        if(isset($_SESSION['cartItems']) && !empty($_SESSION['cartItems']))
        {
            foreach($_SESSION['cartItems'] as $cartKey => $cartItem)
            {
                $productIDs = [];
                $item = $OrderItemsModel->getWhere(['productID' => $cartItem['productID'],'colorID' => $cartItem['colorID'],'orderID' => $cartItem['orderID']])->getRowArray();
                if($item){
                    $qty = $_SESSION['cartItems'][$cartKey]['qty'] + $item['itemQty'];
                    $payload['price'] = $cartItem['price'];
                    $payload['qty'] = $qty;
                    $this->updateOrderItems($userData['id'],$order['orderID'],$item['itemID'],$payload);
                } 
                else{
                    /*echo '<pre>';
                        print_r($_SESSION['cartItems'][$cartKey]);
                    echo '</pre>';*/
                    $item = $this->saveToCart($userID,NULL,NULL,1,$_SESSION['cartItems'][$cartKey]);
                }
            }
        }
        else
        {
        }
        $order = $OrdersModel->getWhere(['userID' => $userID,"userStatus" => 0])->getRowArray();
        $items = $OrderItemsModel->getWhere(['orderID' => $order['orderID']])->getResultArray();
        foreach($items as $item)
        {
            $fetchProduct = Services::getProductDetail($item['productID']);
            $colorImage = Services::getProductImagesColor($item['productID'],$item['colorID']);
            $cartArray[] = [
                'productID' => $item['productID'],
                'qty' => $item['itemQty'],
                'name' => $fetchProduct['name'],
                'price' => $fetchProduct['price'],
                'subTotal' => $item['itemQtyPrice'],
                'image' => $item['isCustom'] == 1 ? $item['image'] : $colorImage['image'],
                'colorID' => $item['colorID'],
                'colorName' => $colorImage['colorName'],
                'orderID' => $order['orderID'],
                'itemID' => $item['itemID'],
                'isCustom' => $item['isCustom'],
            ];
        }
        $_SESSION['cartItems'] = $cartArray;
    }
    public function addAddress($userID,$orderID)
    {
        try
        {
            /*$UserAddressModel = $this->UserAddressModel;
            $session = $this->session;
            $rules = [
				"firstName" => "required",
				"lastName" => "required",
				"email" => "required",
				"phoneNumber" => "required",
				"countryCode" => "required",
				"city" => "required",
				"address" => "required",
			];
			$payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) 
            {
                $error = $this->validator->getErrors();
                $session->setFlashdata('checkoutError',$error);
            }
            else
            {*/
                $insert = $UserAddressModel->insert($payload);
                //echo $UserAddressModel->getLastQuery();
                return $insertID = $UserAddressModel->insertID();
            //}
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    public function saveOrderItems($orderID)
    {
        $OrderItemsModel = $this->OrderItemsModel;
        foreach($_SESSION['cartItems'] as $item)
        {
            $payload['orderID'] = $orderID;
            $payload['productID'] = $item['productID'];
            $payload['colorID'] = $item['colorID'];
            $payload['itemPrice'] = $item['price'];
            $payload['itemQty'] = $item['qty'];
            $payload['itemQtyPrice'] = $item['price'] * $item['qty'];
            $payload['isCustom'] = $item['isCustom'];
            $payload['image'] = $item['image'];
            $payload['status'] = 0;
            $OrderItemsModel->insert($payload);
            $items[] = $OrderItemsModel->insertID();
        }
        $data = ["itemID" => $items[0]];
        return $data; 
    }
    public function saveOrderItemsSingle($orderID,$item)
    {
        $OrderItemsModel = $this->OrderItemsModel;
        $payload['orderID'] = $orderID;
        $payload['productID'] = $item['productID'];
        $payload['colorID'] = $item['colorID'];
        $payload['itemPrice'] = $item['price'];
        $payload['itemQty'] = $item['qty'];
        $payload['itemQtyPrice'] = $item['price'] * $item['qty'];
        $payload['isCustom'] = $item['isCustom'];
        $payload['image'] = $item['image'];
        $payload['status'] = 0;
        $OrderItemsModel->insert($payload);
        $item = $OrderItemsModel->insertID();
        $data = ["itemID" => $item];
        return $data; 
    }
    public function updateOrderItems($userID,$orderID,$itemID,$payload1)
    {
        $subTotal = array_sum(array_values(array_column($_SESSION['cartItems'], 'subTotal')));
        $OrderItemsModel = $this->OrderItemsModel;
        $OrdersModel = $this->OrdersModel;
        $qtyPrice = $payload1['price'] * $payload1['qty'];
        $order = $OrdersModel->getWhere(["orderID" => $orderID,"userID" => $userID])->getRowArray();
        $payload1['subTotal'] = $subTotal;//($order['subTotal'] - $payload1['price']) + $qtyPrice;
        $payload1['grandTotal'] = $subTotal;//($order['subTotal'] - $payload1['price']) + $qtyPrice;
        $order = $OrdersModel->where(["userID" => $userID,"orderID" => $orderID])->set($payload1)->update();
        $payload['itemPrice'] = $payload1['price'];
        $payload['itemQty'] = $payload1['qty'];
        $payload['itemQtyPrice'] = $qtyPrice;
        $OrderItemsModel->where(["orderID" => $orderID,"itemID"=> $itemID])->set($payload)->update();
    }
    public function deleteItem($userID,$orderID,$itemID)
    {
        $subTotal = array_sum(array_values(array_column($_SESSION['cartItems'], 'subTotal')));
        $OrderItemsModel = $this->OrderItemsModel;
        $OrdersModel = $this->OrdersModel;
        $OrderItemsModel->where(["orderID" => $orderID,"itemID"=> $itemID])->delete();
        if($OrderItemsModel){
            $order = $OrderItemsModel->getWhere(["orderID" => $orderID])->getNumRows();
            if($order == 0)
            {
                $OrdersModel->where(["orderID" => $orderID])->delete();   
            }
            else {
                $payload1['subTotal'] = $subTotal;
                $payload1['grandTotal'] = $subTotal;
                $order = $OrdersModel->where(["userID" => $userID,"orderID" => $orderID])->set($payload1)->update();   
            }   
        }
    }
    public function saveToCart($userID,$shippingAddressID,$cardID,$type,$item)
    {
        try {
            $session = $this->session;
            $OrdersModel = $this->OrdersModel;
            $payload = $this->getRequestInput($this->request);
            $subTotal = array_sum(array_values(array_column($_SESSION['cartItems'], 'subTotal')));
            $order = $OrdersModel->getWhere(["userID" => $userID,"userStatus" => 0])->getRowArray();
            if($order)
            {
               // $payload1['shippingAddressID'] = $shippingAddressID;
                $payload1['cardID'] = 27;
                $payload1['subTotal'] = $subTotal;
                $payload1['grandTotal'] = $subTotal;
                $orderID = $order['orderID'];
                $insertOrder = $OrdersModel->where(['orderID' => $order['orderID']])->set($payload1)->update();
            }
            else
            {
                $orderNumber = "#O".mt_rand(100000,999999);
              //  $payload1['shippingAddressID'] = $shippingAddressID;
                $payload1['cardID'] = $cardID;
                $payload1['orderNumber'] = $orderNumber;
                $payload1['subTotal'] = $subTotal;
                $payload1['grandTotal'] = $subTotal;
                $payload1['userStatus'] = 0;
                $payload1['status'] = 0;
                $payload1['userID'] = $userID;
                $insertOrder = $OrdersModel->insert($payload1);
                $orderID = $OrdersModel->insertID();
            }
            if($insertOrder){
                if($type == 1)
                {
                    $items = $this->saveOrderItemsSingle($orderID,$item);
                }
                else{
                    $items = $this->saveOrderItems($orderID);   
                }
                $response = ["orderID" => $orderID,"itemID" => $items['itemID']];
                $session->setFlashdata('checkoutSuccess',['Your order has been successfully placed.']);
            }
            else{
                $session->setFlashdata('checkoutError',['There is something wrong to place order']);
            }
        } catch (Exception $e) {
            $session->setFlashdata('checkoutError',['Something went wrong']);
            return redirect()->to($this->BaseURL1.'checkout');
        }
        return $response;
    }
     public function addCard($userID)
     {
       try
       {
            //$stripe = $this->stripeCredenatils();
            $payload = $this->getRequestInput($this->request);
            /*$tokenRes = $this->Stripe->generatedCardToken($payload["cardNumber"],$payload["expDate"],$payload["cvv"],$payload["cardHolderName"]);
            if($tokenRes['success'] == 1)
            {*/
                $UserCardModel = $this->UserCardsModel;
                $payload['userID'] =  $userID;
                $cardNumber = $this->encrypter($payload["cardNumber"]);
                $payload['cardNumber'] = $cardNumber;
                $payload['status'] = 1;
                unset($payload['cvv']);
                //$update = $payload['status'] == 1 ? $UserCardModel->where(['userID' => $userID])->set(["status" => 0])->update() : "";
                $insert = $UserCardModel->insert($payload);
                $cardID = $UserCardModel->insertID();
                if($insert){
                    $response = [
                        'cardID' => $cardID,
                        'success' => 1,
                    ];
                }
                else{
                    $response = [
                        'success' => 0,
                    ];
                }
            /*}
            else{
                $response = ["success" => 0,"message" => $tokenRes['message']];
            }*/
        }   
        catch (\Exception $e)
        {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $response;
    }
    public function paynow()
    {
        try {
            $session = $this->session;
            $payload = $this->getRequestInput($this->request);
            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
            $OrdersModel = $this->OrdersModel;
            $UserAddressModel = $this->UserAddressModel;
            $rules = [
    			"email" => "required|valid_email",
    			"firstName" => "required",
    			"lastName" => "required",
    			"countryCode" => "required",
    			"phoneNumber" => "required",
    			"address" => "required",
    			"zipcode" => "required",
    			"city" => "required"
    		];
    	    $payload = $this->getRequestInput($this->request);
            if (!$this->validateRequest($payload, $rules)) {
                $error = $this->validator->getErrors();
                $session->setFlashdata('checkoutError',$error);
                return redirect()->to($this->BaseURL1.'checkout'); 
            } else {
            //$card = $this->addCard($userID);
            
            /*if($card['success'] == 1)
            {*/
                
                    //$order = $this->saveToCart($userID,$shippingAddressID,$card['cardID'],0,'');
                    $order = $this->saveToCart($userID,NULL,NULL,0,'');
                    if($order['orderID'])
                    {
                        $payload['userID'] = $userID;
                        $payload['orderID'] = $order['orderID'];
                        if($payload['addID'])
                        {
                            $shippingAddressID = $UserAddressModel->where(['id' => $payload['addID'],"orderID" => $order['orderID']])->set($payload)->update();
                            $insertID = $payload['addID'];
                        }
                        else{
                            $shippingAddressID = $UserAddressModel->insert($payload);    
                            $insertID = $UserAddressModel->insertID();
                        }
                        
                        //$shippingAddressID = $this->addAddress($userID,$order['orderID']);
                        if($shippingAddressID)
                        {
                            
                            $OrdersModel->where(['orderID' =>  $order['orderID']])->set(["shippingAddressID" => $insertID])->update();
                            $_SESSION['successCheckout'] = 1;
                            return redirect()->to($this->BaseURL1.'payment');
                        }
                        else
                        {
                            $session->setFlashdata('checkoutError',['You have an error in shipping address']);
                           // return redirect()->to($this->BaseURL1.'checkout');
                        }    
                       // $OrdersModel->where(['orderID' => $order['orderID']])->set(["userStatus" => 1])->update();
                        //$token = $this->generateTokenofPayment($_POST['amount']);
                        //$data['token'] = $token;
                        
                       // unset($_SESSION['cartItems']);
                        //unset($_SESSION['cartCount']);
                        //unset($_SESSION['subTotal']);
                        //echo $token;
                    }
                    else
                    {
                        $session->setFlashdata('checkoutError',['There is something wrong to place order']);
                        return redirect()->to($this->BaseURL1.'checkout');    
                    }   
            }
           /* else{
                $session->setFlashdata('checkoutError',['Something went wrong']);
                return redirect()->to($this->BaseURL1.'checkout');
            }*/
        } catch (Exception $e) {
            $session->setFlashdata('checkoutError',[$e->getMessage()]);
            return redirect()->to($this->BaseURL1.'checkout');
        }
    }
    public function getPages()
    {
        try
        {
            $uri = service('uri'); 
            $type = $uri->getSegment(1);
            $lang =  $_GET['lang'] == 'fr' ? 1 : 0;
            $PageModel = $this->PageModel;
            $page = $PageModel->getWhere(['type' => $type,"status" => $lang])->getRowArray();
            $data['page'] = $page;
            $this->loadLandingViews($type,$data);   
        }
        catch(Exception $e)
        {
            
        }
    }
    public function customCard()
    {
        try
        {
            $session = $this->session;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('customCardsuccess','customCardError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('customCardError',[$g->getMessage()]);
        }
        $this->loadLandingViews('customCard',$data); 
    }
     public function orders()
    {
        try
        {
            $session = $this->session;
            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
            $OrdersModel = $this->OrdersModel;
            $orders = $OrdersModel->getWhere(["userID" => $userID])->getResultArray();
            $data['orders'] = $orders;
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('orderSuccess','orderError');
        }
        catch(Exception $e)
        {
            $session->setFlashdata('orderError',[$g->getMessage()]);
        }
        $this->loadLandingViews('orders',$data);   
    }
    public function orderDetail($id)
    {
        try
        {
            $session = $this->session;
            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
            $OrdersModel = $this->OrdersModel;
            $orderID = base64_decode($id);
            $data['messageBoard'] = $this->SessionMessageForSuccessAndError('orderSuccess','orderError');
            $order = Services::getorderDetail($orderID);
            $items = Services::cartList($orderID);
            if($order['orderStatus'] == 0){
                $statusMessage = 'In Process';
            }
            else if($order['orderStatus'] == 1){
                $statusMessage = 'Confirmed';
            }
            else if($order['orderStatus'] == 2){
                $statusMessage = 'Payment Failed';
            }
            else{
                $statusMessage = 'Pending';
            }
            $data = [];
            $order['items'] = $items;
            $data['statusMessage'] = $statusMessage;
            $data['order'] = $order;
            $data['items'] = $items;
        }
        catch(Exception $e)
        {
            $session->setFlashdata('orderError',[$g->getMessage()]);
        }
        $this->loadLandingViews('orderDetail',$data);   
    }
    public function orderSuccess()
    {
        try
        {
            $session = $this->session;
            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
            $OrdersModel = $this->OrdersModel;
            $orderID = base64_decode($_GET['id']);
            if($userID)
            {
                $order = $OrdersModel->getWhere(["userID" => $userID,"orderID" => $orderID])->getRowArray();
                if($order)
                {
                    
                    $order['userStatus'] == 0 ? $OrdersModel->where(["orderID" => $orderID])->set(["status" => 1,"userStatus" => 1])->update() : "";
                    $data['order'] = $order;
                    unset($_SESSION['cartItems']);
                    unset($_SESSION['cartCount']);
                    unset($_SESSION['subTotal']);
                    $data['messageBoard'] = $this->SessionMessageForSuccessAndError('orderSuccess','orderError');   
                }   
                else{
                    $data['status'] = 4;
                }  
                $this->loadLandingViews('successPayment',$data);
            }
            else{
                return redirect()->to($this->BaseURL1.'login');
            }
        }
        catch(Exception $e)
        {
            $session->setFlashdata('orderError',[$g->getMessage()]);
            $this->loadLandingViews('successPayment',$data);
        }   
    }
    public function orderCancel()
    {
        try
        {
            $session = $this->session;
            $userID = $this->decodeTokenByParam($_SESSION['userToken']);
            $OrdersModel = $this->OrdersModel;
            $orderID = base64_decode($_GET['id']);
            if($userID)
            {
                $order = $OrdersModel->getWhere(["userID" => $userID,"orderID" => $orderID])->getRowArray();
                if($order)
                {
                    $order['userStatus'] == 0 ? $OrdersModel->where(["orderID" => $orderID])->set(["status" => 2,"userStatus" => 2])->update() : "";
                    $data['order'] = $order;
                    unset($_SESSION['cartItems']);
                    unset($_SESSION['cartCount']);
                    unset($_SESSION['subTotal']);
                    $data['messageBoard'] = $this->SessionMessageForSuccessAndError('orderSuccess','orderError');   
                }   
                else{
                    $data['status'] = 4;
                }
                $this->loadLandingViews('cancelPayment',$data);
            }
            else{
                return redirect()->to($this->BaseURL1.'login');
            }
        }
        catch(Exception $e)
        {
            $session->setFlashdata('orderError',[$g->getMessage()]);
            $this->loadLandingViews('cancelPayment',$data);
        }
    }
    public function customCardAjax()
    {
        $date = date('dmY');
        $PID = $_POST['PID'];
        define('UPLOAD_DIR', './public/uploads/customCards/');
        $img = $_POST['file'];
        $img = str_replace('data:image/png;base64,', '', $img);
    	$img = str_replace(' ', '+', $img);
    	$data = base64_decode($img);
    	$imageName = $PID.'-'.uniqid().$date . '.png';
    	$file = UPLOAD_DIR . $imageName;
    	$success = file_put_contents($file, $data);
    	if($success)
    	{
    	    $session = $this->session;
            $ProductColorImagesModel = $this->ProductColorImagesModel;
            $productQty = 1;
            $productID = $this->decodeBase64Data($this->request->getVar('PID'));
            $colorID = $this->request->getVar('colorID') ? $this->decodeBase64Data($this->request->getVar('colorID')) : 02;
            $fetchProduct = Services::getProductDetail($productID);
            $colorImage = Services::getProductImagesColor($productID,$colorID);//$ProductColorImagesModel->getwhere(['productID' => $productID,'colorID' => $colorID])->getRowArray();
            $subTotal = number_format($productQty * $fetchProduct['price'],2);
            
            $cartArray = [
                'productID' => $productID,
                'qty' => $productQty,
                'name' =>$fetchProduct['name'],
                'price' => $fetchProduct['price'],
                'subTotal' => $subTotal,
                'image' => $imageName,
                'colorID' => $colorID,
                'colorName' => $colorImage['colorName'],
                'orderID' => 0,
                'itemID' => 0,
                'isCustom' => 1
            ];
            $colorProduct = ["productID" => $productID,"colorID" => $colorID];
                $_SESSION['cartItems'][]= $cartArray;
                if($_SESSION['maaraUserIsLoggedIn'] == 1)
                {
                    $userID = $this->decodeTokenByParam($_SESSION['userToken']);
                    $item = $this->saveToCart($userID,NULL,NULL,1,$_SESSION['cartItems'][0]);
                    $_SESSION['cartItems'][0]['orderID'] = $item['orderID'];
                    $_SESSION['cartItems'][0]['itemID'] = $item['itemID'];
                }
                $successMsg = true;
            $cartCount = array_sum(array_values(array_column($_SESSION['cartItems'], 'qty')));
            $subTotal = array_sum(array_values(array_column($_SESSION['cartItems'], 'subTotal')));
            $_SESSION['cartCount'] = $cartCount;
            $_SESSION['subTotal'] = $subTotal;
    	    echo 1;
    	}
    	else{
    	    echo 0;
    	}
    	//print $success ? $file : 'Unable to save the file.';
    }
    public function pay()
    {
        
        $url = "https://secure.sycapay.net/login";
        $paramsend = [
        "montant" => "10",
        "currency" => "XOF"
        ];
          $headers = array (
                 "X-SYCA-MERCHANDID:C_626BCDCF101EE", 
                 "X-SYCA-APIKEY:pk_syca_e692ddb9dbc219e760d3c058542f965beb18c70e", 
                 'X-SYCA-REQUEST-DATA-FORMAT: JSON',
                 'X-SYCA-RESPONSE-DATAFORMAT: JSON',
                );
        $paramsend = array (
            "montant" =>10, 
            "curr" =>'XOF'
        );
        $url = "https://secure.sycapay.net/login";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION ,CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data_json = json_encode($paramsend);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        $response = json_decode(curl_exec($ch),TRUE);
        curl_close($ch);
        
        if($response['code'] == 0)
        {
            $token = $response['token'];
        }
        else {
            $token = $response['token'];
        }
        
      $json = [
            "marchandid" => "C_626BCDCF101EE",
            "token" =>  $response['token'],
            "telephone" => "0505000001",
            "name" => "test",
            "pname" => "test",
            "urlnotif" => "",
            "montant" => "10",
            "currency" => "XOF",
            "numcommande" => "#123453345345fhg67",
           // "otp" => "#144*8*2#",
            ];
        ?>
        <form method="post" id="checkoutForm" action="https://secure.sycapay.net/checkresponsive">
        <input type="hidden" name="token" value="<?php echo $response['token'];?>">
        <input type="hidden" name="amount" value="10">
        <input type="hidden" name="currency" value="XOF">
        <input type="hidden" name=" name" value="Doe">
        <input type="hidden" name=" pname" value="Jonh">
        <input type="hidden" name=" emailpayeur" value="jonh.doe@incognito.com">
        <input type="hidden" name="urls" value="yourSuccessUrl">
        <input type="hidden" name="urlc" value="https://www.maaracard.com/landing/orderCancel?id=6534659">
        <input type="hidden" name="commande" value="COMTEST">
        <input type="hidden" name="merchandid" value="C_626BCDCF101EE">
        <input type="hidden" name="typpaie" id="typpaie" value="payement">
        <input type="hidden" name="nameplugin" value=" plugin">
        <input type="submit" value="valider">
    </form>
        <?php
       /*echo '<form method="post" action="https://secure.sycapay.net/checkresponsive">
            <input type="hidden" name="token"
            value="'.$response['token'].'">
            <input type="hidden" name="amount" value="10">
            <input type="hidden" name="currency" value="XOF">
            <input type="hidden" name=" numpayeur" value="XXXXXXXX">
            <input type="hidden" name=" name" value="Doe">
            <input type="hidden" name=" pname" value="Jonh">
            <input type="hidden" name=" emailpayeur" value="jonh.doe@incognito.com">
            <input type="hidden" name="urls" value="votreUrldeSuccess">
            <input type="hidden" name="urlc" value="https://www.maaracard.com/landing/pay">
            <input type="hidden" name=" commande" value="COMTEST">
            <input type="hidden" name="merchandid" value=" C94859958859">
            <input type="hidden" name="typpaie" value=" payement">
            <input type="hidden" name="nameplugin" value=" plugin">
            <input type="submit" value="valider" >
            </form>';*/
    }    
}


/*session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["action"])) {
switch($_POST["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_POST["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 
			'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_POST["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;		
}
}*/
?>
