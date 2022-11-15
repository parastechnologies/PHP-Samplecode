<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
	public function index()
    {
        try 
        {
            $data = [];
            $this->loadViews('index',$data);
        } 
        catch (Exception $e) 
        {
            $response = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
        return $this->respondCreated($response);
    }
    /**
     * This function used to login view 
     */
    public function login()
    {
        $session = $this->session; 
        $data = [];
        $data['messageBoard'] = $this->SessionMessageForSuccessAndError('loginSuccess','loginError');
        echo $this->loadViewsLogin('auth/login',$data);
    }
    
    public function loginMe()
    {
        try{
            $session = $this->session; 
            $rules = [
				"email" => "required|valid_email|max_length[128]|trim",
				"password" => "required",
			];
			$input = $this->getRequestInput($this->request);
            if (!$this->validateRequest($input, $rules)) {
                $error = $this->validator->getErrors();
                $session->setFlashdata('loginError',$error);
                return redirect()->to($this->adminBaseURL.'login'); 
            }
            else{
                $email = strtolower($this->request->getVar('email'));
                $remember = $this->request->getVar('remember');
                $password = $this->request->getVar('password');
                $AdminModel = $this->AdminModel;
                $adminData = $AdminModel->getWhere(['email' => $email])->getRowArray();
                if($adminData){
                    $passCheck = password_verify($password, $adminData['password']); 
                    if($passCheck){
                         if($remember == 1) {
                        	setcookie ("email",$email,time() + 3600 * 24 * 30);
                            setcookie ("password",$password,time() + 3600 * 24 * 30);
                        
                        } 
                        else {
                        	setcookie("email","");
                        	setcookie("password","");
                        }
                        $sessiondata = [
                            'maaraAdminID'  => $adminData['id'],
                            'maaraAdminIsLoggedIn' => 1,
                        ];
                        $session->set($sessiondata);
                        $session->setFlashdata('loginSuccess',['Login Success!']);   
                       return redirect()->to($this->adminBaseURL.'dashboard'); 
                    }
                    else{
                        $session->setFlashdata('loginError',['Login Failed! Password Is Invalid.']);
                        return redirect()->to($this->adminBaseURL.'login'); 
                    }
                }
                else{
                    $session->setFlashdata('loginError',['Login Failed! Email! Is Invalid.']);
                    return redirect()->to($this->adminBaseURL.'login'); 
                }
            }
        }
        catch(Exception $e){
            $session->setFlashdata('loginError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'login'); 
        }
    }
    public function forgotPassword()
    {
        try 
        {
           $data = [];
           $data['messageBoard'] = $this->SessionMessageForSuccessAndError('forgotSuccess','forgotError');
           $this->loadViewsLogin('auth/forgotPassword',$data);
        } 
        catch (Exception $e) 
        {
            $response = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
    }
    public function forgotPasswordMail()
    {
        try{
            $session = $this->session; 
            $rules = [
				"email" => "required|valid_email|max_length[128]|trim",
			];
			$input = $this->getRequestInput($this->request);
            if (!$this->validateRequest($input, $rules)) {
                $error = $this->validator->getErrors();
                $session->setFlashdata('forgotError',$error);
                return redirect()->to($this->adminBaseURL.'forgot/password'); 
            }
            else{
                $email = strtolower($this->request->getVar('email'));
                $AdminModel = $this->AdminModel;
                $adminData = $AdminModel->select('id')->getWhere(['email' => $email])->getRowArray();
                if($adminData){
                    $token = $this->encodeToken($adminData['id'],0);
                    $subject = "Forgot Password";
                    $link = $this->adminBaseURL."reset/password/".$token;
                    $message = 'Dear '.$email.',  
                      <br/>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and 
                      nothing will happen to your account.
                      <br/>In case you want to reset your password
                      <a style="color:blue" href="'.$link.'">Click here</a>
                      <br/><br/>Regards,
                      <br/>Maara';
                    $successEmail  = $this->sendMail($email,$subject,$message,0);
                    if($successEmail['success'] == 1){
                        $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
                        $expDate = date("Y-m-d H:i:s",$expFormat);
                        $id = $adminData['id'];
                        $expDateUpdate = $AdminModel->update($id,["expDate" => $expDate]);
                        $session->setFlashdata('forgotSuccess',['Mail has been sent Sucessfully']);
                        return redirect()->to($this->adminBaseURL.'forgot/password');
                    }
                    else{
                        $session->setFlashdata('forgotError',[$successEmail['message']]);
                        return redirect()->to($this->adminBaseURL.'forgot/password');
                    }
                }
                else{
                    $session->setFlashdata('forgotError',['This account is not associated with us.']);
                    return redirect()->to($this->adminBaseURL.'forgot/password'); 
                }
            }
        }
        catch(Exception $e){
            $session->setFlashdata('forgotError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'forgot/password'); 
        }
    }
    public function resetPassword($token)
    {
        try 
        {
            $session = $this->session;
            $key = $this->getSecretKey();
            $id =  $this->decodeTokenForAdmin($token);
            $AdminModel = $this->AdminModel;
            $adminData = $AdminModel->getWhere(['id' => $id])->getRowArray();
            $curDate = date("Y-m-d H:i:s");
            $expDate = $adminData['expDate'];
            if ($expDate >= $curDate){ 
                $data = [];
                $data['messageBoard'] = $this->SessionMessageForSuccessAndError('resetSuccess','resetError');
                $this->loadViewsLogin('auth/resetPassword',$data);
            }
            else{
                $session->setFlashdata('forgotError',['The link is expired. You are trying to use the expired link which <br>as valid only 24 hours (1 day after request).
                Please send again mail to reset your password']);
                return redirect()->to($this->adminBaseURL.'forgot/password');    
            }
        } 
        catch (Exception $e) 
        {
            $response = [
                'success' => 0,
                'messages' => $e->getMessage(),
            ];
        }
    }
    public function resetNewPassword()
    {
         try{
            $session = $this->session; 
            $token = $this->request->getVar('token');
            $rules = [
				"password" => "required|min_length[8]|max_length[32]",
				"confirmPassword" => "required|matches[password]"
			];
			$input = $this->getRequestInput($this->request);
            if (!$this->validateRequest($input, $rules)) {
                $error = $this->validator->getErrors();
                $session->setFlashdata('resetError',$error);
                return redirect()->to($this->adminBaseURL.'reset/password/'.$token);
            }
            else{
                $id =  $this->decodeTokenForAdmin($token);
                $AdminModel = $this->AdminModel;
                $adminData = $AdminModel->getWhere(['id' => $id])->getRowArray();
                if($adminData)
                {  
                    $update = $AdminModel->update($id,["password" => password_hash($this->request->getVar("password"),PASSWORD_DEFAULT)]);
                    if($update){
                        $session->setFlashdata('loginSuccess',['Password has been changed Successfully,Please login here']);
                        return redirect()->to($this->adminBaseURL.'login');
                    }
                    else{
                        $session->setFlashdata('resetError',['Something went wrong']);
                        return redirect()->to($this->adminBaseURL.'reset/password/'.$token);
                    }
                }
                else{
                    $session->setFlashdata('resetError',['Something went wrong']);
                    return redirect()->to($this->adminBaseURL.'reset/password/'.$token);
                }
            }
        }
        catch(Exception $e){
            $session->setFlashdata('resetError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'reset/password/'.$token);
        } 
    }
    public function logout()
    {
         try{
            $session = $this->session; 
            unset($_SESSION['maaraAdminID']);
            unset($_SESSION['maaraAdminIsLoggedIn']);
            $session->destroy();
            return redirect()->to($this->adminBaseURL.'login');
         }
        catch(Exception $e){
            $session->setFlashdata('resetError',$e->getMessage());
            return redirect()->to($this->adminBaseURL.'dashboard');
        }
    }
}
