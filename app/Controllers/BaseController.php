<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


use CodeIgniter\HTTP\Response;
use ReflectionException;
include('./vendor/autoload.php');

//require_once './vendor/behat/transliterator/src/Behat/Transliterator/Transliterator.php';
//require_once './vendor/jeroendesloovere/vcard/src/VCard.php';


use JeroenDesloovere\VCard\VCard;


//require APPPATH.'vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Header;
use CodeIgniter\Validation\Exceptions\ValidationException;
//session_set_cookie_params(['samesite' => 'None', 'secure' => true]);

use Config\Services;

use App\Models\UserModel;
use App\Models\PageModel;
use App\Models\PrivateAccountModel;
use App\Models\BusinessAccountModel;
use App\Models\BusinessStaffAccountModel;
use App\Models\DevicesModel;
use App\Models\ActiveDevicesModel;
use App\Models\PlateformsModel;
use App\Models\UserPlateformsModel;
use App\Models\ThemesModel;
use App\Models\UserThemeModel;
use App\Models\ConnectionsModel;
use App\Models\DeviceTypesModel;
use App\Models\AdminModel;
use App\Models\ProductColorImagesModel;
use App\Models\ColorsModel;
use App\Models\ProductsModel;
use App\Models\StateModel;
use App\Models\CountryModel;
use App\Models\UserAddressModel;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;
use App\Models\UserCardsModel;
use App\Models\AnalyticsModel;
use App\Models\SubscriptionsLogModel;
use App\Models\SubscriptionsModel;
use App\Models\SocialLinksModel;

use \SendGrid\Mail\Mail;

//use SendGrid;
/*use SendGrid;
use PHPMailer;
helper('curl');

use App\Models\UserModel;
use App\Models\ContactUsModel;
use App\Models\PageModel;
use App\Models\TokensModel;
use App\Models\QuestionsModel;
use App\Models\AnswersModel;
use App\Models\RatingModel;
use App\Models\NotificationsModel;
use App\Models\AdminModel;*/
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;

class BaseController extends ResourceController
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['curl'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

        
        $this->UserModel = new UserModel();
        $this->PageModel = new PageModel();
        $this->PrivateAccountModel = new PrivateAccountModel();
        $this->BusinessAccountModel = new BusinessAccountModel();
        $this->BusinessStaffAccountModel = new BusinessStaffAccountModel();
        $this->DevicesModel = new DevicesModel();
        $this->ActiveDevicesModel = new ActiveDevicesModel();
        $this->PlateformsModel = new PlateformsModel();
        $this->UserPlateformsModel = new UserPlateformsModel();
        $this->ThemesModel = new ThemesModel();
        $this->UserThemeModel = new UserThemeModel();
        $this->ConnectionsModel = new ConnectionsModel();
        $this->DeviceTypesModel = new DeviceTypesModel();
        $this->AdminModel = new AdminModel();
        $this->ProductColorImagesModel = new ProductColorImagesModel();
        $this->ColorsModel = new ColorsModel();
        $this->ProductsModel = new ProductsModel();
        $this->StateModel = new StateModel();
        $this->CountryModel = new CountryModel();
        $this->UserAddressModel = new UserAddressModel();
        $this->OrdersModel = new OrdersModel();
        $this->OrderItemsModel = new OrderItemsModel();
        $this->UserCardsModel = new UserCardsModel();
        $this->AnalyticsModel = new AnalyticsModel();
        $this->SubscriptionsLogModel = new SubscriptionsLogModel();
        $this->SubscriptionsModel = new SubscriptionsModel();
        $this->SocialLinksModel = new SocialLinksModel();
        $this->session = \Config\Services::session(); 
        $this->adminBaseURL = base_url()."/WS0maaraFZ9D/";
        $this->BaseURL1 = base_url()."/";
        $this->BaseURL = base_url();
        $this->adminName = 'WS0maaraFZ9D';
        $this->userImagePath = base_url()."/public/uploads/users/";
        $this->adminImagePath = base_url()."/public/uploads/admin/";
        $this->currencySign = "FCFA ";
        $this->salt = "AeGlogyDFFDF45DF4Aq";
        $this->productImagePath =  base_url().'/public/uploads/products/';
        $this->images =  base_url().'/public/assets/front/images/';
        $this->profileURL = 'https://test.com/';
        $this->currency = '$';
        $this->MerchandID = '';
        $this->ApiKey = '';
        $this->paymentURL = "";
        
        //$this->load->database();
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
	}
	public function getSecretKey()
	{
	     return '';    
	}

	public function decodeBase64Data($key)
	{
	    $data = base64_decode($key.$this->salt);
	    $exploeData = explode("Ae",$data);
	    return $exploeData[0];
	}
	public function encodeToken($userID,$deviceID)
    {
        $userData  = ["userID" => $userID,"deviceId" => $deviceID];
        $key = $this->getSecretKey();
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "data" => $userData
        );
        
        $encode = JWT::encode($payload, $key, 'HS256');
        return $encode; 
        /*print_r($jwt);
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        
        print_r($decoded);
        $decoded_array = (array) $decoded;
        JWT::$leeway = 60;*/
        //$decoded = JWT::decode($jwt, new Key($key, 'HS256')); 
    }
    public function commonDecodeToken()
    {
        $key = $this->getSecretKey();
        $encodedToken = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $encodedToken);
        $token=$arr[1];
        $decodedToken = JWT::decode($token, new Key($key, 'HS256'));
        $userID = $decodedToken->data->userID;
        $deviceId = $decodedToken->data->deviceId;
        return ["userID" => $userID,"deviceId" => $deviceId];
    }
    public function decodeTokenVerify()
    {
        $UserModel = new UserModel();
        $decode = $this->commonDecodeToken();
        $userData = $UserModel->getWhere(["id" => $decode['userID'], "deviceId" => $decode['deviceId']])->getRowArray();
        if($userData)
        {
                return $decode['userID'];
        }
        else{
           // return $decode['userID'];
             $response = [
                'isAuthorized' => 1,
                'success' => 0,
                'message' => "User Unauthorized",
            ];
            print_r(json_encode($response, JSON_PRETTY_PRINT));
            exit();
        }
    }
    public function decodeToken()
    {
        $UserModel = new UserModel();
        $decode = $this->commonDecodeToken();
        $userData = $UserModel->getWhere(["id" => $decode['userID'], "deviceId" => $decode['deviceId']])->getRowArray();
        if($userData){
            if($userData['status'] == 0){
                $response = [
                    'isSuspended' => 0,
                    'success' => 0,
                    'message' => $this->language_messages($decode['userID'],'suspended'),
                ];
                print_r(json_encode($response, JSON_PRETTY_PRINT));
                exit();
            }
            else if($userData['isLogout'] == 1){
                $response = [
                    'isAuthorized' => 1,
                    'success' => 0,
                    'message' => "User Unauthorized",
                ];
                print_r(json_encode($response, JSON_PRETTY_PRINT));
                exit();
            }
            else{
                return $decode['userID'];
            }
        }
        else{
           // return $decode['userID'];
             $response = [
                'isAuthorized' => 1,
                'success' => 0,
                'message' => "User Unauthorized",
            ];
            print_r(json_encode($response, JSON_PRETTY_PRINT));
            exit();
        }
    }
    public function decodeTokenLogout($type)
    {
        $UserModel = new UserModel();
        if($type == 1){
           $decode = $this->commonDecodeToken();
            $userData = $UserModel->getWhere(["id" => $decode['userID'], "deviceId" => $decode['deviceId']])->getRowArray();
            if($userData){
                if($userData['isSuspended'] == 0){
                    $response = [
                    'isSuspended' => 0,
                    'success' => 0,
                    'message' => $this->language_messages($decode['userID'],'suspended'),
                ];
                print_r(json_encode($response, JSON_PRETTY_PRINT));
                exit();
                }
                else{
                    return ["userID" => $decode['userID'],"deviceId" => $decode['deviceId']];
                }
            }
            else{
                return ["userID" => $decode['userID'],"deviceId" => $decode['deviceId']];
            }
        }
        else{
           return  $this->commonDecodeToken();   
        }
    }
    public function decodeTokenByParam($token)
    {
        $UserModel = new UserModel();
        $key = $this->getSecretKey();
        $decodedToken = JWT::decode($token, new Key($key, 'HS256'));
        $userID = $decodedToken->data->userID;
        $deviceId = $decodedToken->data->devicId;
        $userData = $UserModel->getWhere(["id" => $userID, "deviceId" => $deviceId])->getRowArray();
        if($userData){
            if($userData['isSuspended'] == 0){
                $response = [
                'isSuspended' => 0,
                'success' => 0,
                'message' => $this->language_messages($userID,'suspended'),
            ];
            print_r(json_encode($response, JSON_PRETTY_PRINT));
            exit();
            }
            else{
                return $decodedToken->data->userID;
            }
        }
        else{
            return $decodedToken->data->userID;
        }
    }
    public function decodeTokenForAdmin($token)
    {
        $key = $this->getSecretKey();
        $decodedToken = JWT::decode($token, new Key($key, 'HS256'));
        return $decodedToken->data->userID;
    }
    public function getRequestInput(RequestInterface $request)
    {
        $input = $request->getPost();
        if (empty($input)) {
            $input = json_decode($request->getBody(), true);
        }
        return $input;
    }
    public function getResponse(array $responseBody,int $code = ResponseInterface::HTTP_OK)
    {
        return $this
            ->response
            ->setStatusCode($code)
            ->setJSON($responseBody);
    }
    public static function notificationTypes()
    {
        $types = [
            "rating" => "rating",
            "submitAnswer" => "submitAnswer"
        ];
        return $types;
    }
	public function validateRequest($input, array $rules, array $messages =[])
    {
        $this->validator = Services::Validation()->setRules($rules);
        $validation = Services::validation();
        if (is_string($rules)) {
            $validation = config('Validation');
            if (!isset($validation->$rules)) {
                throw ValidationException::forRuleNotFound($rules);
            }
    
            if (!$messages) {
                $errorName = $rules . '_errors';
                $messages = $validation->$errorName ?? [];
            }
            $rules = $validation->$rules;
        }

        return $this->validator->setRules($rules, $messages)->run($input);
    }
    public function uploadImages($image,$folderName)
    {
        helper('text');
        $date = date('dmY');
        $file = $this->request->getFile($image);
       // print_r($file);
        $rand = random_string('alnum', 16).$date;
       // $FileName = $_FILES[$image]['name'];
        $TempName = $_FILES[$image]['tmp_name'];
        $FileName =  $file->getRandomName();
        $image1 = $rand.$FileName;
        $source = './public/uploads/'.$folderName."/".$image1;
        $fileName = move_uploaded_file($TempName,$source);
        if($fileName){
            return ["success" => 1,"fileName" => $image1];
        }
        else{
            return ["success" => 0,"message" => $_FILES[$image]["error"]];
        }
    }
    public function multipleUploadImages($image,$folderName,$key)
    {
        helper('text');
        $date = date('dmY');
        $rand = random_string('alnum', 16).$date;
        $FileName = $_FILES[$image]['name'][$key];
        $TempName = $_FILES[$image]['tmp_name'][$key];
        $image1 = $rand.$FileName;
        $source = './public/uploads/'.$folderName."/".$image1;
        $fileName = move_uploaded_file($TempName,$source);
        if($fileName){
            $images = $image1;
            return array("success" => 1,"imageName" => $FileName,"fileName" => $images);
        }
        else{
            return array("success" => 0,"message" => "Not uploaded because of error #".$_FILES[$image][$key]["error"]);
        }
    }
    public static function mailCredentials()
	{
	   
	    $mail = [
            'APIKey' => '',
            'fromMail' => '',
            'adminMail' => '',
            'host' => '',
            'username' => '',
            'password' => '',
            'port' => 26
        ];
        return $mail;
	}

    public function smtp($email,$subject,$message,$type)
    {
        $cre = $this->mailCredentials();
        $FROM= $cre['fromMail'];
        $PEMAIL= $type == 1 ? $cre['adminMail'] : $email;
        $mail = new PHPMailer;
        $mail->isSMTP();                                     
        $mail->SMTPDebug = 0;   
        $mail->SMTPAutoTLS = false; 
        $mail->Host = $cre['host'];                      
        $mail->SMTPAuth = true;    //true or false
        $mail->Username = $cre['username'];                  
        $mail->Password = $cre['password'];
        //$mail->SMTPSecure = 'ssl';
        //$mail->SMTPSecure = false;
        $mail->Port = $cre['port'];                                    
        $mail->setFrom($cre['fromMail'], ''); 
        $mail->addAddress($PEMAIL);  
        $mail->WordWrap = 50;                                
        $mail->isHTML(true);                                
        $mail->Subject = $subject;
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';;
        $mail->AltBody = '';
        $mail->msgHTML($message);
        $isChecked =$mail->send();
       // echo '<pre>';
        //print_r($mail);
        if($isChecked)
        {
            $res = ["success" => 1];
        }
        else 
        {
            $res = ["success" => 0, "message" => $mail->ErrorInfo];
        } 
        return $res;
    }
    public function sendgrid($emaill,$subject,$message,$type)
    {
        $cre = $this->mailCredentials();
        $API_KEY = '-';//$cre['APIKey'];
        $FROM_EMAIL =  '';//$cre['fromMail'];
        echo $TO_EMAIL= $type == 1 ? $cre['adminMail'] : $emaill;
        $email = new Mail();
        $email->setFrom($FROM_EMAIL);
        $email->setSubject('Sending with Twilio SendGrid is Fun asdas');
        $email->addTo($TO_EMAIL);
        $email->addContent(
            'text/html',
            '<strong>and fast with the PHP helper library.</strong>'
        );
        $sendgrid = new \SendGrid($API_KEY);
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
    }
    public function sendMail($email,$subject,$message,$type)
    {
        include('./vendor/autoload.php');
        
        //require './vendor/PHPMailer/PHPMailerAutoload.php';
       $res = $this->smtp($email,$subject,$message,$type);
     //  $res = $this->sendgrid($email,$subject,$message,$type);
        //return $res;
       // $sendgrid = $this->sendgrid($email,$subject,$message);
       // $res = $this->smtp($email,$subject,$message);
        /*if($res){
            return $res;
        }
        else{*/
            
            /*$sendgrid = $this->sendgrid($email,$subject,$message);
            if($sendgrid){
                return $sendgrid;
            }
            else {
                return false;
            }*/
        //}
        return $res;
    }
    public function pagination($limit)
    {
        $pageNo = $this->request->getVar("pageNo");
        $offset = $pageNo  * $limit;
        return $offset;
    }
    public function encrypter($data)
    {
        $encrypter = \Config\Services::encrypter();
        $ciphertext = $encrypter->encrypt($data);
        return base64_encode($ciphertext);
    }
    public function decrypter($data)
    {
        $encrypter = \Config\Services::encrypter();
        $ciphertext = $encrypter->decrypt(base64_decode($data));
        return $ciphertext; 
    }
    public function totalData($userID)
    {
        $questions = $this->QuestionsModel->selectCount('id')->getWhere(['userID' => $userID])->getRowArray();
        $answers = $this->AnswersModel->selectCount('id')->getWhere(['userID' => $userID])->getRowArray();
        $tokens = $this->TokensModel->select('token')->getWhere(['userID' => $userID])->getRowArray();
        return [
            "questions" => $questions ? $questions['id'] : "0",
            "answers" => $answers? $answers['id'] : "0",
            "tokens" => $tokens ? $tokens['token'] : "0",
        ];
    }
    
     function loadViews($viewName = "", $headerInfo = [], $pageInfo = [], $footerInfo = [])
    {
        $uri = service('uri');
        $headerInfo['uri'] = $uri;
        $headerInfo['adminBaseURL'] = $this->adminBaseURL;
        $headerInfo['imageURL'] = $this->BaseURL.'/public/assets/back/images/';
        $headerInfo['baseURLCSS'] = $this->BaseURL.'/public/assets/back/css/';
        $headerInfo['currencySign'] = $this->currencySign;
        $footerInfo['baseURLJS'] = $this->BaseURL.'/public/assets/back/js/';
        $headerInfo['baseURLVendor'] = $this->BaseURL.'/public/assets/back/vendor/';
        $footerInfo['baseURLVendor'] = $this->BaseURL.'/public/assets/back/vendor/';
        $headerInfo['userImagePath'] = $this->userImagePath;
        $headerInfo['TypeImagePath'] = $this->BaseURL.'/public/uploads/deviceTypes/';
        $footerInfo['adminBaseURL'] = $headerInfo['adminBaseURL'];
        $headerInfo['productImagePath'] = $this->BaseURL.'/public/uploads/products/';
        $headerInfo['QRcodePath'] = $this->BaseURL.'/public/uploads/qrcode/';
        $headerInfo['socialImagePath'] = $this->BaseURL.'/public/uploads/socialLinks/';
        $headerInfo['businessAccountImage'] = $this->BaseURL.'/public/uploads/businessAccounts/';
        $headerInfo['privateAccountImage'] = $this->BaseURL.'/public/uploads/privateAccounts/';
        $headerInfo['adminImagePath'] = $this->adminImagePath;
        $ColorsModel = $this->ColorsModel;
        $colors = $ColorsModel->findAll();
        $footerInfo['colors'] = $colors;
        $headerInfo['profile'] = $this->AdminModel->getWhere(['id' => session()->get('maaraAdminID')])->getRowArray();
        $products = Services::getProducts();
        $footerInfo['products'] = $products;
        echo view('admin/includes/header', $headerInfo);
        echo view('admin/'.$viewName, $pageInfo);
        echo view('admin/includes/footer', $footerInfo);
    }
    function loadViewsLogin($viewName = "", $headerInfo = [], $pageInfo = [], $footerInfo = [])
    {
        $uri = service('uri');
        $headerInfo['uri'] = $uri;
        $headerInfo['adminBaseURL'] = $this->adminBaseURL;
        $headerInfo['imageURL'] = $this->BaseURL.'/public/assets/back/images/';
        $headerInfo['baseURLCSS'] = $this->BaseURL.'/public/assets/back/css/';
        $footerInfo['baseURLJS'] = $this->BaseURL.'/public/assets/back/js/';
        echo view('admin/includes/head', $headerInfo);
        echo view('admin/'.$viewName, $pageInfo);
        echo view('admin/includes/loginFooter', $footerInfo);
    }
    function loadLandingViews($viewName = "", $headerInfo = [], $pageInfo = [], $footerInfo = [])
    {
        $uri = service('uri');
        $session = $this->session;
        $headerInfo['uri'] = $uri;
        //$footerInfo['uri'] = $uri;
        $headerInfo['images'] = $this->BaseURL.'/public/assets/front/images/';
        $headerInfo['css'] = $this->BaseURL.'/public/assets/front/css/';
        $headerInfo['currencySign'] = $this->currencySign;
        $footerInfo['js'] = $this->BaseURL.'/public/assets/front/js/';
        $headerInfo['baseURLVendor'] = $this->BaseURL.'/public/assets/back/vendor/';
        $footerInfo['baseURLVendor'] = $this->BaseURL.'/public/assets/back/vendor/';
        $headerInfo['userImagePath'] = $this->userImagePath;
        $headerInfo['TypeImagePath'] = $this->BaseURL.'/public/uploads/deviceTypes/';
        $headerInfo['productImagePath'] = $this->BaseURL.'/public/uploads/products/';
        $headerInfo['customImagePath'] = $this->BaseURL.'/public/uploads/customCards/';
        $headerInfo['socialImagePath'] = $this->BaseURL.'/public/uploads/socialLinks/';
        $footerInfo['adminBaseURL'] = $headerInfo['adminBaseURL'];
        $headerInfo['adminProductPath'] = $this->adminProductPath;
        $headerInfo['adminImagePath'] = $this->adminImagePath;
        $headerInfo['salt'] = $this->salt;
        $headerInfo['MerchandID'] = $this->MerchandID;
        $headerInfo['ApiKey'] = $this->ApiKey;
        $headerInfo['currency'] = $this->currency;
        $headerInfo['paymentURL'] = $this->paymentURL;
        $headerInfo['email'] = $_SESSION['email'];
        $headerInfo['loggedin'] = $_SESSION['maaraUserIsLoggedIn'];
        $headerInfo['id'] = $headerInfo['loggedin'] == 1 ? $this->decodeTokenByParam($_SESSION['userToken']) : "";
        $headerInfo['items'] = $_SESSION['cartItems'] ? $_SESSION['cartItems'] : [];
        $cartCount = array_sum(array_values(array_column($headerInfo['items'], 'qty')));
        $headerInfo['qty'] = $cartCount ? $cartCount : 0;
        $footerInfo['socials'] = $this->SocialLinksModel->getWhere(['status' => 1])->getResultArray();
        if($uri->getSegment(1) == 'custom' && $uri->getSegment(2) == 'card')
        {
            $productID = base64_decode($uri->getSegment(3));
            $PID = explode($this->salt,$productID);
            $ProductsModel = $this->ProductsModel;
            $footerInfo['deviceTypeID'] = $ProductsModel->select('deviceTypeID')->getWhere(['id' => $PID[0]])->getRowArray();
        }
        echo view('includes/header', $headerInfo);
        echo view($viewName, $pageInfo);
        echo view('includes/footer', $footerInfo);
    }
    public function SessionMessageForSuccessAndError($successtype,$errortype)
    {
        $session = \Config\Services::session();
        $error = $session->getFlashdata($errortype);
        if($error)
        {
            $errorString = implode("<br>",$error);
            $message = '<div class="alert alert-danger alert-dismissible">
                         '.$errorString.'
                         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                       </div>';
         /*   $message = '<div class="alert alert-danger alert-dismissable" id="errorMessage">
                    <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-hidden="true">×</a>'.$errorString.'                    
                  </div>';*/
        }
        $success = $session->getFlashdata($successtype);
        if($success)
        {
            $successString = implode("<br>",$success);
            $message = '<div class="alert alert-success alert-dismissible">
                         '.$successString.'
                         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                       </div>';
            /*$message =  '<div class="alert alert-success alert-dismissable" id="successMessage">
                    <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-hidden="true">×</a>'.$successString.'                
                  </div>';*/
        } 
        return $message;
    }
    public function arrayCallback($array,$addArray)
    {
        $array = array_map(function($arr) use ($addArray){
            return $arr + $addArray;
        }, $array);
        return $array; 
    }
    
    public function ORCode($token)
    {
        helper('text');
        $size = isset($_GET['size']) ? $_GET['size'] : '300x300';
        $date = date('dmY');
        $code = random_string('alnum', 8).$date;
        $fileName = 'qr'.$code.'.png';
        $filepath = './public/uploads/qrcode/'.$fileName;
        $logo = '';//'./public/uploads/logo.png';
        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|0&chs='.$size.'&chl='.urlencode($token));
        //if($logo !== FALSE){
        	$logo = '';//imagecreatefromstring(file_get_contents($logo));
        	$QR_width = imagesx($QR);
        	$QR_height = imagesy($QR);
        	$logo_width = '';//imagesx($logo);
        	$logo_height = '';//imagesy($logo);
        	// Scale logo to fit in the QR Code
        	$logo_qr_width = $QR_width/5;
        	$scale = '';//$logo_width/$logo_qr_width;
        	$logo_qr_height = '';//$logo_height/$scale;
        	//imagecopyresampled($QR,$QR_width/2.5, $QR_height/2.5, 0, 0);
        //	imagecopyresampled($QR,$logo, $QR_width/2.5, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        //}
        imagepng($QR,$filepath);
        imagedestroy($QR);
        return $fileName;
    }
    function AESEncrypt($string)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = 'D4Wb1FebihODDvxI';
        $encryption_key = "maara";
        $encryption = openssl_encrypt($string, $ciphering,$encryption_key, $options, $encryption_iv);
        return base64_encode($encryption);
    }
    function AESDecrpt($string)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = 'D4Wb1FebihODDvxI';
        $encryption_key = "maara";
        $encryption = openssl_decrypt(base64_decode($string), $ciphering,$encryption_key, $options, $encryption_iv);
        return ["json" => $encryption,"decode"=>json_decode($encryption,true)];
    }
    public function createProfileURL($id,$type)
    {
        $keyData = json_encode([$id,$type],JSON_FORCE_OBJECT);
        $key = $this->AESEncrypt($keyData);
        $url = $this->profileURL."profile/".$key;
        $qrCode = $this->ORCode($url);
        return ["qrCode" => $qrCode,"url" => $url,"key"=>$key];
    }
    
    public function ipInfo($ip = NULL, $purpose = "location", $deep_detect = TRUE) 
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
    public function vcard()
    {
        $vcard = new VCard();

        // define variables
        $lastname = 'Desloovere';
        $firstname = 'Jeroen';
        $additional = '';
        $prefix = '';
        $suffix = '';
        
        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);
        
        // add work data
        $vcard->addCompany('Siesqo');
        $vcard->addJobtitle('Web Developer');
        $vcard->addRole('Data Protection Officer');
        $vcard->addEmail('info@jeroendesloovere.be');
        $vcard->addPhoneNumber(1234121212, 'PREF;WORK');
        $vcard->addPhoneNumber(123456789, 'WORK');
        $vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
        $vcard->addLabel('street, worktown, workpostcode Belgium');
        $vcard->addURL('http://www.jeroendesloovere.be');
        
        //print_r($vcard->getOutput());
        // return vcard as a string
        return $vcard->download();//$vcard->getOutput();
        
        // return vcard as a download
        //return $vcard->download();
       /* header('Content-Type: text/x-vcard');  
        $vcardObj = new VCard();
        $vcardObj->addName("Saurabh");
        $vcardObj->addBirthday("18-june-1995");
        $vcardObj->addEmail("Saurabh@gmail.com");
        $vcardObj->addPhoneNumber("9878467797");
        $vcardObj->addAddress("#123");
        $vcardObj->setFilename( "test");
        return $vcardObj->download();*/
    }
    public function newd()
    {
        $vcard = new VCard();
    
        $vcard->addName( "tests","lajls");
        if ( isset ( $photo ) && ! empty ( $photo ) ) {
            $photo  = base_url ( 'public/uploads/user_images/' . $photo );
            $vcard->addPhoto( $photo );
        }
        if ( isset ( $designation ) && ! empty ( $designation ) ) {
            $vcard->addJobtitle( $designation );
        }
        if ( isset ( $description ) && ! empty ( $description ) ) {
            $vcard->addNote( $description );
        }
        
        $email = '';
        if ( $type == 'public' ) {
            $email  = $this->user_model->get_public_email ( $user_id);
            if ( isset ( $email ) && ! empty ( $email ) ) {
                $vcard->addEmail( $email, 'HOME' );
            }
        }
                
        $profile_url = base_url ( 'profile/' . $profile_id );
        $vcard->addItem( 'item1.URL', $profile_url );
        $vcard->addItem( 'item1.X-ABLabel', 'Profile' );
        
        $apps   = $this->user_model->get_user_apps ( $user_id, $account_id );
        $i = 2;
        if ( ! empty ( $apps ) ) {
            foreach ( $apps as $app ) {
                if ( ( $app['slug'] == 'phone' ) && ! empty ( $app['content'] ) ) {
                        $vcard->addPhoneNumber( $app['content'], 'WORK' );
                } else if ( ( $app['slug'] == 'email' ) && ! empty ( $app['content'] ) && ( strtolower( $app['content'] ) != strtolower( $email ) ) ) {
                        $vcard->addEmail( $app['content'], 'WORK' );
                } else if ( ! empty ( $app['content'] ) ) {
                    $content = $app['content'];
                    if ( ( strstr ( $content, "https://" ) !== false ) || ( strstr ( $content, "http://" ) !== false ) ) {
                        $url = $content;
                    } else {
                        $url = $app['base_url'].$content;
                    }
                    $vcard->addItem( 'item'.$i.'.URL', $url );
                    $vcard->addItem( 'item'.$i.'.X-ABLabel', $app['title'] );
                    $i++;
                }
            }
        }
        
        $vcard->setFilename( $name . (isset($surname)?' '.$surname:'') );
        
        return $vcard->download();
        $this->output ( $response );
    }
    public function get_user_device() {
        //Detect special conditions devices
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
        $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
        
        //do something with this information
        if( $iPod || $iPhone || $iPad ){
            return 'ios';
        } else if($Android){
            return 'android';
        } else {
            return 'web';
        }
    }
    public function language_messages($userID,$type)
    {
        $language = \Config\Services::language();
        $userData = $this->UserModel->select('language')->getWhere(["id" => $userID])->getRowArray();
        $language->setLocale($userData['language']);
        return lang("Text.".$type);
    }
}