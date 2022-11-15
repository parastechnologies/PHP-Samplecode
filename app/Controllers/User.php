<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Firebase\JWT\JWT;

use CodeIgniter\Controller;
use Config\Services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use \SendGrid\Mail\Mail;

class User extends BaseController
{
    /*start authorization section*/
    public function register()
    {
        try{
            $UserModel = $this->UserModel;
            $rules = [
				"email" => "required",
				"password" => "required"
			];
			$input = $this->getRequestInput($this->request);
            if (!$this->validateRequest($input, $rules)) {
                $error = $this->validator->getErrors();
                $response = [
                    'success' => 0,
                    'message' => "Email/Password required",
                ];
            } else {
                $email = $this->request->getVar("email");
                $dataEmail = $UserModel->getWhere(['email' => $email,'isWeb' => 0])->getRowArray();
                if($dataEmail){
                    $token = $this->encodeToken($dataEmail['id'],$dataEmail['deviceId']);
                    $dataEmail['token'] = $token;
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($dataEmail['id'],'emailInUse'),
                        'data' => $dataEmail
                    ];
                }
                else{
                    $payload = $this->getRequestInput($this->request);
                    $payload['password'] = password_hash($this->request->getVar("password"),PASSWORD_DEFAULT);
                    $payload['status'] = 1;
                    $payload['isLoggedIN'] = 0;
                    $payload['isWeb'] = 0;
                    $payload['isProfile'] = 1;
                    $payload['createdDate'] = date('Y-m-d H:i:s');
                    if($UserModel->insert($payload)) 
                    {
                        $userID = $UserModel->insertID();
                        //$token = $this->encodeToken($userID,$payload['deviceId']);
                        $QRCode = $this->createProfileURL($userID,'public');
                        $UserModel->update($userID, ["QRCode" => $QRCode['qrCode'],"profileLink"=>$QRCode['url']]);
                        $userData = $this->commonUserData($userID);
                        $response = [
                            'success' => 1,
                            'message' => 'User has been registered successfully',
                            'data' => $userData
                        ];
                    }else{
                        $response = [
                            'success' => 0,
                            'message' => 'Failed to create user',
                        ];
                    }
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
    public function login()
    {
        try {
            $UserModel = $this->UserModel;
            $rules = [
				"email" => "required",
				"password" => "required"
			];
			$payload = $this->getRequestInput($this->request);
           if (!$this->validateRequest($payload, $rules)) {
                $error = $this->validator->getErrors();
                $response = [
                    'success' => 0,
                    'message' => "Email/Password required",
                ];
            }
            else{
                $password = $this->request->getVar("password");
                $email = $this->request->getVar("email");
                $userData = $UserModel->getWhere(['email' => $email,'isWeb' => 0])->getRowArray();
                if($userData){
                    $passCheck = password_verify($password, $userData['password']); 
                    if($passCheck){
                        if($userData['isProfile'] == 2){
                            $payload['isLoggedIN'] = 1;    
                        }
                        else if($userData['isProfile'] == 1 && $userData['isSkip'] == 1){
                            $payload['isLoggedIN'] = 1; 
                        }
                        else{
                            $payload['isLoggedIN'] = 0;
                        }
                        unset($payload['password']);
                        $payload['isLogout'] = 0;
                        $payload ? $UserModel->update($userData['id'], $payload) : '';
                        $userDataRes = $this->commonUserData($userData['id']);
                        if($userData['isSuspended'] == 0){
                            $response = [
                                'success' => 0,
                                'message' => $this->language_messages($userData['id'],'accountsuspended'),
                            ];
                        }
                        else{
                            $response = [
                                'success' => 1,
                                'message' => $this->language_messages($userData['id'],'login'),
                                'data' => $userDataRes
                            ];
                        }
                    }
                    else{
                        $response = [
                        'success' => 0,
                            'message' => 'Login Failed! Password Is Invalid.',
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => 'Login Failed! Email! Is Invalid.',
                    ];
                }
            }
        } catch (Exception $e) {
             $response = [
                    'success' => 0,
                    'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    public function findUserByUserID($userID)
    {
        
        $UserModel = $this->UserModel;
        $userData = $UserModel->getWhere(['id' => $userID])->getRowArray();
        return $userData; 
    }
    public function commonUserData($id)
    {
        $userID = $id != 0 ? $id : $this->decodeToken();
        $UserModel = $this->UserModel;
        $SubscriptionsModel = $this->SubscriptionsModel;
        $userData = $UserModel->getWhere(['id' => $userID])->getRowArray();
        if($userData){
            $theme = Services::getUserTheme($userID,'public');
            $token = $this->encodeToken($userID,$userData['deviceId']);
            $subscription = $SubscriptionsModel->getWhere(['userID' => $userID])->getRowArray();
            $userData['token'] = $token;
            $userData['colorID'] = $theme['id'] ? $theme['id'] : '4';
            $userData['color'] = $theme['color'] ? $theme['color'] : '#FFFFFF';
            $userData['iconType'] = $theme['iconType'] ? $theme['iconType'] : 'Rectangular';
            $userData['isSubscription'] = $subscription ? "1" : "0";
        }
        unset($userData['oldUserProfile']);
        return $userData;
    }
    public function getUserProfile()
    {
        try{
            $token = $this->decodeToken();
            $userData = $this->commonUserData($token);
            if($userData) 
            {
                $platformData = Services::userPlatformList($token,$token,'public');
                $userData['platforms'] = $platformData;
               $response = [
                    'success' => 1,
                    'message' => $this->language_messages($token,'dataFound'),
                    'data' => $userData
                ];
            }else{
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($token,'dataNotFound'),
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
    public function updateProfile()
    {
        try{
            $userID = $this->decodeToken();
            $UserModel = $this->UserModel;
            $image = 'userProfile';
            $folderName = 'users';
            $FileName = $_FILES[$image]['name'];
            if($FileName !=  "")
            {
                $file = $this->uploadImages($image,$folderName);
                if($file['success'] == 1){
                    $payload= $this->getRequestInput($this->request);
                    $payload['isProfile'] = 2;
                    $payload['isLoggedIN'] = 1;
                    $payload['userProfile'] = $file['fileName'];
                    $update = $payload ? $UserModel->update($userID, $payload) : '';
                    if($update){ 
                        $userData = $this->commonUserData($userID); 
                        $response = [
                            'success' => 1,
                            'message' => $this->language_messages($userID,'profileUpdated'),
                            'data' => $userData
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
                $payload= $this->getRequestInput($this->request);
                $payload['isProfile'] = 2;
                $payload['isLoggedIN'] = 1;
                $update = $payload ? $UserModel->update($userID, $payload) : '';
                if($update){ 
                    $userData = $this->commonUserData($userID); 
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'profileUpdated'),
                        'data' => $userData
                    ];
                }else{
                    $response = [
                        'success' => 0,
                        'message' =>  $this->language_messages($userID,'wrong'),
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
    public function logout(){
       try
       {
        $decode = $this->decodeTokenLogout(0);
        $UserModel = $this->UserModel;
        $userData = $UserModel->getWhere(["id" => $decode['userID'], "deviceId" => $decode['deviceId']])->getRowArray();
        if($userData['id']){
            $payload = ["deviceToken" => NULL,"deviceId" => NULL,"isLogout" => 1];    
        }
        else{
            //$payload = ["isLoggedIN" => 0];
        }
        $update = $UserModel->update($decode['userID'],$payload);
        if($update){
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($decode['userID'],'logout'),
                ];
            }
            else{
                $response = [
                    'success' => 0,
                    'message' =>  $this->language_messages($decode['userID'],'wrong'),
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
    public function forgotPassword()
    {
        try{
            $UserModel = $this->UserModel;
            $email = $this->request->getVar("email");
            $userData = $UserModel->getWhere(['email' => $email])->getRowArray();
            if($userData){
                if($userData['isSocial'] == 1)
                {
                    $response = [
                        'success' => 0,
                        'message' => "You don't have authority to change password because your account is associated with gmail/facebook",
                    ];    
                } 
                else if($userData['status'] == 0){
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($decode['userID'],'suspended'),
                    ];    
                }
                else
                {
                    $timestamp = strtotime("now");
                    $subject = 'Forgot Password';
                    $token = $this->encodeToken($userData['id'],$userData['deviceId']);
                    $code = rand(1000,10000);
                    //$link = base_url().'/user/reset/'.$timestamp.'/'.$token;
                    //$message = 'Here is the link to reset the password <a href='.$link.'> click </a>';
                    $message = 'Here is the code to reset the password '.$code;
                    $successEmail = $this->sendMail($email,$subject,$message,0);
                    if($successEmail['success'] == 1)
                    {
                        $UserModel->where(['id' => $userData['id']])->set(["otp" => $code])->update();
                        $userData1['token'] = $token;
                        $response = [
                            'data' => $userData1,    
                            'success' => 1,
                            'message' => $this->language_messages($userData['id'],'forgotcode'),
                        ];   
                    }
                    else {
                        $response = [
                            'success' => 0,
                            'message' =>  $this->language_messages($userData['id'],'wrong'),
                        ];
                    }
                }
            }
            else{
                $response = [
                    'success' => 0,
                    'message' => 'This email is not associated with account, Please try with the valid one!.',
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
      public function resetPassword()
    {
        try{
            $userID = $this->decodeTokenVerify();
            $userData = $this->commonUserData($userID);
            if($userData['isSocial'] == 1)
            {
                $response = [
                    'success' => 0,
                    'message' => "You don't have authority to change password because your account is associated with gmail/facebook",
                ];    
            }   
            else
            {
                $UserModel = $this->UserModel;
                $payload = ['password' => password_hash($this->request->getVar("password"),PASSWORD_DEFAULT)];
                $update = $UserModel->update($userID,$payload);
                if($update){
                    $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'resetSuccess'),
                    ];
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' =>  $this->language_messages($userID,'wrong'),
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
    public function verifyOTP()
    {
        try{
            $UserModel = $this->UserModel;
            $userID = $this->decodeTokenVerify();
            $otp = $this->request->getVar("otp");
            $userData = $UserModel->getWhere(['id' => $userID,'otp' => $otp])->getRow();
            if($userData){ 
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'otpVerify'),
                ];
            }else{
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'invalidOTP'),
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
    public function resendOtp(){
        $userID = $this->decodeToken();
        return $this->commonforResend($userID);
    }
    public function commonforResend($userID)
    {
        try{
            $UserModel = $this->UserModel;
            $userData = $this->findUserByUserID($userID);
            if($userData){
                $subject = 'Forgot Password';
                $code = rand(1000,10000);
                $message = 'Here is the code to reset the password '.$code;
                $successEmail = $this->sendMail($userData['email'],$subject,$message,0);
                if($successEmail['success'] == 1)
                {
                    $UserModel->where(['id' => $userData['id']])->set(["otp" => $code])->update();
                    $token = $this->encodeToken($userData['id'],$userData['deviceId']);
                    $userData['token'] = $token;
                    $response = 
                    [
                        'data' => $userData,    
                        'success' => 1,
                        'message' => $this->language_messages($userData['id'],'forgotcode'),
                    ];   
                }
                else {
                    $response = 
                    [
                        'success' => 0,
                        'message' =>  $this->language_messages($userData['id'],'wrong'),
                    ];    
                }
            }
            else{
                $response = [
                    'success' => 0,
                    'message' => 'User not found',
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
    /*start authorization section*/
     public function changePassword()
    {
        try{
            $userID = $this->decodeToken();
            $UserModel = $this->UserModel;
            $rules = [
				"oldPassword" => "required",
				"newPassword" => "required"
			];
			$input = $this->getRequestInput($this->request);
           if (!$this->validateRequest($input, $rules)) {
                $error = $this->validator->getErrors();
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'passwordRequired'),
                ];
            } else {
                $password = $input["oldPassword"];
                $payload = ['password' => password_hash($input["newPassword"],PASSWORD_DEFAULT)];
                $userData = $this->findUserByUserID($userID);
                if($userData){
                    $passCheck = password_verify($password, $userData['password']); 
                    if($passCheck){
                        $update = $UserModel->update($userID,$payload);
                        if($update)
                        {
                            $response = [
                            'success' => 1,
                            'message' => $this->language_messages($userID,'passwordUpdateSuccess'),
                            ];
                        }
                        else{
                            $response = [
                            'success' => 0,
                            'message' => $this->language_messages($userID,'passwordUpdateError'),
                            ];
                        }
                    }
                    else{
                        $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'oldPasswordError'),
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' => $this->language_messages($userID,'userNotFound'),
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
    public function publicAccountStatus($userID,$status)
    {
        $UserModel = $this->UserModel;
        $update = $UserModel->update($userID, ['status' => $status]);
        return $update ? $status : 0;
    }
    public function privateAccountStatus($userID,$PID,$status)
    {
        $PrivateAccountModel = $this->PrivateAccountModel;
        $update = $PrivateAccountModel->where(['PID' => $PID])->set(['status' => $status])->update();
        return $update ? $status : 0;
    }
    public function businessAccountStatus($userID,$BID,$status)
    {
        $BusinessAccountModel = $this->BusinessAccountModel;
        $update = $BusinessAccountModel->where(['BID' => $BID])->set(['status' => $status])->update();
        return $update ? $status : 0;
    }
    public function staffAccountStatus($userID,$SID,$status)
    {
        $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
        $update = $BusinessStaffAccountModel->where(['SID' => $SID])->set(['status' => $status])->update();
        return $update ? $status : 0;
    }
    public function userStatus()
    {
        try{
            $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
          ///  Services::updateStatusOfUsers($userID);
            if($payload['type'] == 'public')
            {
                $update = $this->publicAccountStatus($userID,$payload['status']);
            }
            else if($payload['type'] == 'private')
            {
                $update = $this->privateAccountStatus($userID,$payload['PID'],$payload['status']);
            }
            else if($payload['type'] == 'business')
            {
                $update = $this->businessAccountStatus($userID,$payload['BID'],$payload['status']);
            }
            else if($payload['type'] == 'staff')
            {
                $update = $this->staffAccountStatus($userID,$payload['SID'],$payload['status']);
            }
            if($update != 0){ 
                $response = [
                    'status'  => $update,
                    'success' => 1,
                    'message' => $this->language_messages($userID,'profileChangeStatus'),
                ];
            }else{
                $response = [
                    'success' => 0,
                    'message' =>  $this->language_messages($userID,'wrong'),
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
    public function businessStaffStatus()
    {
        try{
            $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
            $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
            $update = $BusinessStaffAccountModel->where(['SID' => $payload['SID']])->set(['status' => $payload['status']])->update();
            if($update){ 
                $response = [
                    'status'  => $payload['status'],
                    'success' => 1,
                    'message' => $this->language_messages($userID,'profileChangeStatus'),
                ];
            }else{
                $response = [
                    'success' => 0,
                    'message' =>  $this->language_messages($userID,'wrong'),
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
    public function userAccounts()
    {
        try{
            $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
            $UserModel = $this->UserModel;
            $PrivateAccountModel = $this->PrivateAccountModel;
            $BusinessAccountModel = $this->BusinessAccountModel;
            $userData = $UserModel->select('id,firstName,lastName,designation,userProfile,status')->getWhere(['id' => $userID])->getRowArray();
            if($userData){
                $privateAccounts = $PrivateAccountModel->getWhere(['userID' => $userID])->getResultArray();
                $businessAccounts1 = $BusinessAccountModel->getWhere(['userID' => $userID])->getResultArray();
                foreach($businessAccounts1 as $val)
                {
                    $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
                    $staffDetail = $BusinessStaffAccountModel->orderBY('SID','desc')->getWhere(['userID' => $userID,'BID' => $val['BID'],'isDelete' => 0])->getResultArray();
                    $val['staff'] = $staffDetail;
                    $businessAccounts[] = $val;
                }
                if($privateAccounts && $businessAccounts1){
                    $commonData = [
                        ["accountType"=> "Public","accountList" => [$userData]],
                        ["accountType"=> "Private","accountList" => $privateAccounts],
                        ["accountType"=> "Business","accountList" => $businessAccounts]
                    ];    
                }
                else if($privateAccounts){
                    $commonData = [
                        ["accountType"=> "Public","accountList" => [$userData]],
                        ["accountType"=> "Private","accountList" => $privateAccounts],
                    ];
                }
                else if($businessAccounts1){
                    $commonData = [
                        ["accountType"=> "Public","accountList" => [$userData]],
                        ["accountType"=> "Business","accountList" => $businessAccounts]
                    ];
                }
                else{
                    $commonData = [
                        ["accountType"=> "Public","accountList" => [$userData]]
                    ];
                }
                $response = [
                    'accounts'  => $commonData,
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
    public function addPlatforms()
    {
        try{
            $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
            $UserPlateformsModel = $this->UserPlateformsModel;
            $PlateformsModel = $this->PlateformsModel;
            $plateformData = $PlateformsModel->select('profileURL')->getWhere(['id' => $payload['platformID']])->getRowArray();
            $isCheck = $UserPlateformsModel->getWhere(["userID" => $userID,"accountID" => $payload['accountID'],"userType" => $payload['userType'],"platformID" => $payload['platformID']])->getNumRows();
            if($plateformData){ 
                if($isCheck == 0){
                    $payload['userID'] = $userID;
                    $payload['status'] = 1;
                    $payload['profileLink'] = $plateformData['profileURL'].$payload['phoneCode'].$payload['profileSlug'];
                    $insert = $UserPlateformsModel->insert($payload);
                    if($insert){
                        $PID = $UserPlateformsModel->insertID();
                        $data = Services::userPlatformDetail($PID,$payload['userType'],$payload['accountID']);
                        $response = [
                            'data' => $data,
                            'success' => 1,
                            'message' => $this->language_messages($userID,'socialNetworkAdded'),
                        ];
                    }
                    else{
                        $response = [
                            'success' => 0,
                            'message' =>  $this->language_messages($userID,'wrong'),
                        ];
                    }
                }
                else{
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'alreadySN'),
                    ];    
                }
            }else{
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'notExistSN'),
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
    public function updatePlatform()
    {
        try{
            $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
            $UserPlateformsModel = $this->UserPlateformsModel;
            $PlateformsModel = $this->PlateformsModel;
            $id = $payload['id'];
            $plateformData = $PlateformsModel->select('profileURL')->getWhere(['id' => $payload['platformID']])->getRowArray();
            $payload['profileLink'] = $plateformData['profileURL'].$payload['phoneCode'].$payload['profileSlug'];
            unset($payload['id']);
            $updatePlatfrom = $UserPlateformsModel->where(["id" => $id,"userID" => $userID])->set($payload)->update();
            if($updatePlatfrom){ 
                $data = Services::userPlatformDetail($id,$plateformData['userType'],$plateformData['accountID']);
                $response = [
                    'data' => $data,
                    'success' => 1,
                    'message' => $this->language_messages($userID,'updatedSN'),
                ];
            }
            else{
                $response = [
                    'success' => 0,
                    'message' =>  $this->language_messages($userID,'wrong'),
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
    public function deletePlatform($id)
    {
        try{
            $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
            $UserModel = $this->UserModel;
            $UserPlateformsModel = $this->UserPlateformsModel;
            $data = $UserPlateformsModel->getWhere(["id" => $id,"userID" => $userID])->getRowArray();
            if($data['isDefault'] == 1)
            {
                $UserModel->update($userID,['isDirectLink' => 0]);    
                $deletePlatform = $UserPlateformsModel->where(["id" => $id,"userID" => $userID])->delete();
            }
            else
            {
                $deletePlatform = $UserPlateformsModel->where(["id" => $id,"userID" => $userID])->delete();
            }
            if($deletePlatform){ 
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'deleteSN'),
                ];
            }
            else{
                $response = [
                    'success' => 0,
                    'message' =>  $this->language_messages($userID,'wrong'),
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
    public function getPlatforms()
    {
        try{
            $userID = $this->decodeToken();
            $limit = 10;
            $offset = $this->pagination($limit);
            $payload= $this->getRequestInput($this->request);
            $platformData = Services::userPlatformList($userID,$payload['accountID'],$payload['userType']);
            if($platformData)
            { 
                $response = [
                    'data' => $platformData, 
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
    public function setDirectLink()
    {
        try{
            $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
            $UserModel = $this->UserModel;
            $PrivateAccountModel = $this->PrivateAccountModel;
            $BusinessAccountModel = $this->BusinessAccountModel;
            $UserPlateformsModel = $this->UserPlateformsModel;
            $plateform = $UserPlateformsModel->getWhere(["id" => $payload['id'],"userID" => $userID])->getRowArray();
            if($plateform['userType'] == 'public'){
                $userUpdate = $UserModel->update($userID,["isDirectLink" => $payload['status']]); 
            }
            else if($plateform['userType'] == 'private'){
                $userUpdate = $PrivateAccountModel->update($plateform['accountID'],["isDirectLink" => $payload['status']]); 
            }
            else if($plateform['userType'] == 'business'){
                $userUpdate = $BusinessAccountModel->update($plateform['accountID'],["isDirectLink" => $payload['status']]); 
            }
            else {
                $response = [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'notExistUT'),
                ];
            }
            if($userUpdate)
            { 
                $UserPlateformsModel->where(["accountID" => $plateform['accountID'],"userType" => $plateform['userType']])->set(["isDefault" => 0])->update();
                $plateformUpdate = $UserPlateformsModel->where(["id" => $payload['id'],"userID" => $userID])->set(["isDefault" => $payload['status']])->update();
                $data = Services::userPlatformList($userID,$plateform['accountID'],$plateform['userType']);
                //userPlatformDetail($payload['id'],'public',$plateform['accountID']);
                //$data['isDirectLink'] = $payload['status'];
                $response = [
                    'data' => $data,
                    'success' => 1,
                    'message' => $payload['status'] == 1 ? $this->language_messages($userID,'setDL') : $this->language_messages($userID,'unsetDL'),
                ];   
            }else{
                $response = [
                    'success' => 0,
                    'message' =>  $this->language_messages($userID,'wrong'),
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
    public function customizeTheme()
    {
        try{
            $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
            $UserThemeModel = $this->UserThemeModel;
            $accountID = $payload['accountID'];
            $userType = $payload['userType'];
            $isCheck = $UserThemeModel->getWhere(["userID" => $userID,"accountID" => $accountID,"userType" => $userType])->getNumRows();
            if($isCheck == 0){
                $payload['userID'] = $userID;
                $payload['status'] = 1;
                $insert = $UserThemeModel->insert($payload);
                if($insert){
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'addedT'),
                    ];
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' =>  $this->language_messages($userID,'wrong'),
                    ];
                }
            }
            else{
                unset($payload['accountID']);
                unset($payload['userType']);
                $insert = $UserThemeModel->where(["userID" => $userID,"accountID" => $accountID,"userType" => $userType])->set($payload)->update();
                if($insert){
                    $response = [
                        'success' => 1,
                        'message' => $this->language_messages($userID,'updatedT'),
                    ];
                }
                else{
                    $response = [
                        'success' => 0,
                        'message' =>  $this->language_messages($userID,'wrong'),
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
    public function skip()
    {
        try{
            $userID = $this->decodeToken();
            $UserModel = $this->UserModel;
            $payload= $this->getRequestInput($this->request);
            $payload['isSkip'] = 1;
            $payload['isLoggedIN'] = 1;
            $insert = $UserModel->where(["id" => $userID])->set($payload)->update();
            if($insert){
                $userDataRes = $this->commonUserData($userID);
                $response = [
                    'data' => $userDataRes, 
                    'success' => 1,
                    'message' => $this->language_messages($userID,'statusChange'),
                ];
            }
            else{
                $response = [
                    'success' => 0,
                    'message' =>  $this->language_messages($userID,'wrong'),
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
    /*Analuytics start */
    public function analytics()
	{
	    try{
	        $userID = $this->decodeToken();
            $payload= $this->getRequestInput($this->request);
            //$UserModel = $this->UserModel;
            //$PrivateAccountModel = $this->PrivateAccountModel;
            //$BusinessAccountModel = $this->BusinessAccountModel;
            $userData1 = Services::getAnalytics('tbl_users','public','id',$userID,'id');
            $userData = $userData1[0];
            
            if($userData){
                $privateAccounts = Services::getAnalytics('tbl_privateAccount','private','PID',$userID,'userID');
                $businessAccounts1 = Services::getAnalytics('tbl_businessAccount','business','BID',$userID,'userID');
                foreach($businessAccounts1 as $val)
                {
                    $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
                    $staffDetail = Services::getAnalyticsForStaff($userID,$val['BID']);
                    $totalActiveUser = array_sum(array_column($staffDetail, 'numberDevicesLinked'));
                    $total = $val['NFCTagScan'] + $totalActiveUser;
                    $val['businessAndStaffScanTags'] = (string) $total;
                    $val['staff'] = $staffDetail;
                    $businessAccounts[] = $val;
                }
                //$businessAccounts = $this->arrayCallback($businessAccounts2,['businessAndStaffScanTags' => "0"]);
                if($privateAccounts && $businessAccounts1){
                    $commonData = [
                        ["accountType"=> "Public","accountList" => [$userData]],
                        ["accountType"=> "Private","accountList" => $privateAccounts],
                        ["accountType"=> "Business","accountList" => $businessAccounts]
                    ];    
                }
                else if($privateAccounts){
                    $commonData = [
                        ["accountType"=> "Public","accountList" => [$userData]],
                        ["accountType"=> "Private","accountList" => $privateAccounts],
                    ];
                }
                else if($businessAccounts1){
                    $commonData = [
                        ["accountType"=> "Public","accountList" => [$userData]],
                        ["accountType"=> "Business","accountList" => $businessAccounts]
                    ];
                }
                else{
                    $commonData = [
                        ["accountType"=> "Public","accountList" => [$userData]]
                    ];
                }
                $response = [
                    'accounts'  => $commonData,
                    'success' => 1,
                    'message' =>  $this->language_messages($userID,'dataFound'),
                ];
            }else{
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'dataNotFound'),
                ];
            }
	    } 
	    catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
	}
	public function changeLanguage()
    {
        try{
            $userID = $this->decodeToken();
            $UserModel = $this->UserModel;
            $payload= $this->getRequestInput($this->request);
            $update = $payload ? $UserModel->update($userID, $payload) : '';
            if($update){ 
                //$userData = $this->commonUserData($userID); 
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'language'),
                    //'data' => $userData
                ];
            }else{
                $response = [
                    'success' => 0,
                    'message' =>  $this->language_messages($userID,'wrong'),
                ];
            }
        }
        catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }  
    public function test()
    {
        try{
            $userID = $this->decodeToken();
            $UserModel = $this->UserModel;
            $payload= $this->getRequestInput($this->request);
            $update = $payload ? $UserModel->update($userID, $payload) : '';
            if($update){ 
                //$userData = $this->commonUserData($userID); 
                $response = [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'page_title'),
                    //'data' => $userData
                ];
            }else{
                $response = [
                    'success' => 0,
                    'message' => 'something went wrong',
                ];
            }
        }
        catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }   
    public function deleteAccount()
    {
        try{
            $userID = $this->decodeToken();
            $UserModel = $this->UserModel;
            $this->deleteProfilePicture($userID); 
            $delete = $UserModel->delete($userID);
            if($delete){ 
                $response = 
                [
                    'success' => 1,
                    'message' => $this->language_messages($userID,'deleteAccount'),
                ];
            }
            else
            {
                $response = 
                [
                    'success' => 0,
                    'message' => $this->language_messages($userID,'wrong'),
                ];
            }
        }
        catch (Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    
    public function deleteProfilePicture($userID) 
    {
        $UserModel = $this->UserModel;
        $PrivateAccountModel = $this->PrivateAccountModel;
        $BusinessAccountModel = $this->BusinessAccountModel;
        $BusinessStaffAccountModel = $this->BusinessStaffAccountModel;
        
        $userData = $UserModel->select('userProfile,QRCode')->getWhere(['id' => $userID])->getRowArray();
        @unlink('./uploads/users/'.$userData['userProfile']);
        @unlink('./uploads/qrcode/'.$userData['QRCode']);
        if($userData){
            $privateAccounts = $PrivateAccountModel->getWhere(['userID' => $userID])->getResultArray();
            foreach($privateAccounts as $privateAccount){
                @unlink('./uploads/privateAccounts/'.$privateAccount['privateUserProfile']);
                @unlink('./uploads/qrcode/'.$privateAccount['qrCode']);
            }    
            $businessAccounts = $BusinessAccountModel->getWhere(['userID' => $userID])->getResultArray();
            foreach($businessAccounts as $businessAccount){
                @unlink('./uploads/businessAccounts/'.$businessAccount['businessProfile']);
                @unlink('./uploads/qrcode/'.$businessAccount['qrCode']);
            }
            $BusinessStaffAccounts = $BusinessStaffAccountModel->getWhere(['userID' => $userID])->getResultArray();
            foreach($BusinessStaffAccounts as $BusinessStaffAccount){
                @unlink('./uploads/staff/'.$BusinessStaffAccount['profileImage']);
                @unlink('./uploads/qrcode/'.$BusinessStaffAccount['qrCode']);
            }
            }else{
        }
	}
	
	public function mailCredentials2()
	{
	  /*  $mail = [
            'APIKey' => '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',
            'fromMail' => 'shakti.parastechnologies@gmail.com',
            'adminMail' => 'amandeep.parastechnologies@gmail.com',
            'host' => 'ws156.win.arvixe.com',
            'username' => 'noreply@mlstricity.com',
            'password' => '2gTmt59@',
            'port' => 26
        ];*/
            $mail = [
            'APIKey' => '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',
            'fromMail' => 'noreply.maaracard@maaragroup.com',
            'adminMail' => 'amandeep.parastechnologies@gmail.com',
            'host' => 'p3plzcpnl460726.prod.phx3.secureserver.net',
            'username' => 'contact@maaracard.com',
            'password' => 'hb?pd8rXcSO0',
            'port' => 587
        ];
        return $mail;
	}
	public function smtp2()
    {
              
	    include('./vendor/autoload.php');
        $cre = $this->mailCredentials2();
        $FROM= $cre['fromMail'];
        $mail = new PHPMailer;
        $mail->isSMTP();                                     
        $mail->Host = $cre['host'];                      
        $mail->SMTPAuth = false;    
        $mail->SMTPDebug = 2;
        $mail->Username = $cre['username'];                  
        $mail->Password = $cre['password'];                           
        $mail->Port = $cre['port'];                                    
        $mail->setFrom('shakti.parastechnologies@gmail.com', 'MAARA'); 
        $mail->addAddress("amandeep.parastechnologies@gmail.com");    
        $mail->WordWrap = 50;                                
        $mail->isHTML(true);                                
        $mail->Subject = "ssadasd";
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';;
        $mail->AltBody = '';
        $mail->msgHTML("ssadasd");
        $isChecked =$mail->send();
         /*$mail = new PHPMailer();
         $mail->CharSet =  "utf-8";
         $mail->IsSMTP();
         $mail->SMTPDebug = 2;
         $mail->SMTPAuth = true;
         $mail->Host = $cre['host'];
         $mail->Username = $cre['username'];
         $mail->Password = $cre['password'];
         $mail->Port = $cre['port'];
         $mail->setFrom('amandeep.parastechnologies@gmail.com', 'Your Name');
         $mail->AddAddress('saurabh.parastechnologies@gmail.com', 'To Name');
         $mail->addCC('amandeep.parastechnologies@gmail.com');
         $mail->addBCC('amandeep.parastechnologies@gmail.com');
     
         $mail->Subject  =  'Test Subject';
         $mail->IsHTML(true); 
         $mail->Body    = 'Your Message Body';
         if ($mail->send()) {
              echo "Message sent!";
         } else {
             echo "Error: " . $mail->ErrorInfo;
         }*/
        echo '<pre>';
        print_r($mail);
        /*if($isChecked)
        {
            $res = ["success" => 1];
        }
        else 
        {
            $res = ["success" => 0, "message" => $mail->ErrorInfo];
        } 
        return $res;*/
    }
	public function newone()
	{
	    
	    /*  'APIKey' => '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',
            'fromMail' => 'shakti.parastechnologies@gmail.com',
            'adminMail' => 'amandeep.parastechnologies@gmail.com',
            'host' => 'ws156.win.arvixe.com',
            'username' => 'noreply@mlstricity.com',
            'password' => '2gTmt59@',
            'port' => 26
            p3plzcpnl460726.prod.phx3.secureserver.net
Port: 587
            */
               /* $mail = [
            'APIKey' => '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',
            'fromMail' => 'shakti.parastechnologies@gmail.com',
            'adminMail' => 'amandeep.parastechnologies@gmail.com',
            'host' => 'ws156.win.arvixe.com',
            'username' => 'noreply@mlstricity.com',
            'password' => '2gTmt59@',
            'port' => 26
        ];
        
          $mail = [
            'APIKey' => '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',
            'fromMail' => 'noreply.maaracard@maaragroup.com',
            'adminMail' => 'amandeep.parastechnologies@gmail.com',
            'host' => 'maaracard.com',
            'username' => 'contact@maaracard.com',
            'password' => 'hb?pd8rXcSO0',
            'port' => 465
        ];
        */
            
	    include('./vendor/autoload.php');
	    
	    /*$mail = new PHPMailer;
        $mail->isSMTP();                                     
        $mail->SMTPDebug = 0;   
        //$mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false; 
        $mail->Host = 'ws156.win.arvixe.com';                      
        $mail->SMTPAuth = false;    
        $mail->Username = 'noreply@mlstricity.com';                  
        $mail->Password = "2gTmt59@";
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 26;                             
        $mail->setFrom('shakti.parastechnologies@gmail.com', 'MAARA'); 
        $mail->addAddress("amandeep.parastechnologies@gmail.com");  
        $mail->WordWrap = 50;                                
        $mail->isHTML(true);                                
        $mail->Subject = "sahdjsad";
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';;
        $mail->AltBody = '';
        $mail->msgHTML("aHSGAHgs");
        $isChecked =$mail->send();
        echo '<pre>';
            print_r($mail);*/
            
            
//	   

// Settings 


        $TO_EMAIL= 'amandeep@parastechnologies.com';
        $email = new Mail();
        // Replace the email address and name with your verified sender
        $email->setFrom('info@bgpaymentsolutions.com');
        $email->setSubject('Sending with Twilio SendGrid is Fun');
        // Replace the email address and name with your recipient
        $email->addTo($TO_EMAIL);
        $email->addContent(
            'text/html',
            '<strong>and fast with the PHP helper library.</strong>'
        );
        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($email);
            
            if($response)
            {
                echo "send";
            }
            else
            {
                echo "not sent";
            }
            printf("Response status: %d\n\n", $response->statusCode());
        
            $headers = array_filter($response->headers());
            echo "Response Headers\n\n";
            foreach ($headers as $header) {
                echo '- ' . $header . "\n";
            }
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
        /*$email = new \SendGrid\Mail\Mail();
        echo "dfsf";
        $email->setFrom($FROM_EMAIL, "");
        $email->setSubject($subject);
        $email->addTo($TO_EMAIL, "");
        $email->addContent("text/html", $message);
        $sendgrid = new \SendGrid($API_KEY);
        $response = $sendgrid->send($email);
        print_r($response);
        if($response->statusCode() == 202)
        {
            $res = ["success" => 1];
        }
        else 
        {
            $res = ["success" => 0, "message" => $response->ErrorInfo];
        }*/
        
        /*try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
          echo 'Caught exception: '. $e->getMessage() ."\n";
        }*/
        
        /*$from = new SendGrid\Email(null, $FROM_EMAIL);
        $to = new SendGrid\Email(null, $TO_EMAIL);
        $htmlContent = $message;
        $content = new SendGrid\Content("text/html",$htmlContent);
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        $sg = new \SendGrid($API_KEY);
        $response = $sg->client->mail()->send()->post($mail);
        print_r($response);
        if($response->statusCode() == 202)
        {
            return true;
        }
        else 
        {
            return false;
        } */
        
           /* $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8';
            
            $mail->Host       = "p3plzcpnl460726.prod.phx3.secureserver.net";    // SMTP server example
            $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
            $mail->Username   = 'contact@maaracard.com';            // SMTP account username example
            $mail->Password   = "hb?pd8rXcSO0";            // SMTP account password example
            $mail->setFrom('shakti.parastechnologies@gmail.com', 'MAARA'); 
            $mail->addAddress("amandeep.parastechnologies@gmail.com");
            // Content
            $mail->isHTML(true);                       // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body gffdg<b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            $mail->send();
            echo '<pre>';
            print_r($mail);*/
	}
	public function ajaxTest()
	{
	    echo "ssjhfjsdf";
	}
}



