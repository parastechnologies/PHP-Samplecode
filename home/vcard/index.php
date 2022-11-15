<?php

require '../../vendor/autoload.php';

use JeroenDesloovere\VCard\VCard;
//require_once '../vendor/behat/transliterator/src/Behat/Transliterator/Transliterator.php';
//require_once '../vendor/jeroendesloovere/vcard/src/VCard.php';
//require_once '../../vendor/firebase/php-jwt/src/JWT.php';
//require_once '../../vendor/firebase/php-jwt/src/Key.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


function db(){
    $mysqli = new mysqli("localhost","","","");
    return $mysqli;
}
function getData($table,$key,$value,$type)
{
    $mysqli = db();
    $sql = "Select u.*,up.phoneCode,up.profileSlug from $table as u 
        LEFT JOIN tbl_userPlateforms as up ON u.$key = up.accountID AND (up.userType = '$type' AND platformID = 16)
        LEFT JOIN tbl_plateforms as p ON up.platformID = p.id AND p.slug = 'phone' 
        where u.$key = $value GROUP BY u.$key";
    $result = $mysqli->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if($row){
        addAnalytics();
    }
    return $row;
}
function addAnalytics()
{
    $deviceNumber = $_GET['deviceNumber'];
    if($deviceNumber)
    {
        $userType = $_GET['userType'];
        $accountID = $_GET['profileID'];
        $mysqli = db();
        $key = 'kzUf4sxss4AeGlogyDFFDF45345mixoFDF4AqT1Nyi1zDrEVfpz';
        $encodedToken = $_SERVER['HTTP_AUTHORIZATION'];
        $arr = explode(" ", $encodedToken);
        $token = $arr[1];
        if($token){
            $decodedToken = JWT::decode($token, new Key($key, 'HS256'));
            $userID = $decodedToken->data->userID;
            $device = $mysqli->query("select a.profileID,a.userType,a.status,a.userType,d.deviceNumber,a.deviceID from 
            tbl_devices as d LEFT JOIN tbl_activeDevices as a ON d.id = a.deviceID where d.deviceNumber = '$deviceNumber'");
            $device1 = $device->fetch_array(MYSQLI_ASSOC);
            $deviceID = $device1['deviceID'];  
            $isCheck = $mysqli->query("select * from tbl_analytics where deviceNumber = '$deviceNumber' AND userID = '$userID' AND count = 0");
            $row = $isCheck->fetch_array(MYSQLI_ASSOC); 
            if(empty($row))
            {
                $mysqli->query("insert into tbl_analytics (userID,accountID,deviceID,deviceNumber,userType,count,status) values('$userID','$accountID','$deviceID','$deviceNumber','$userType',0,1)");
            }
        }   
    }
}
$type = $_GET['userType'];
$id = $_GET['profileID'];
if($type == 'public')
{
    $row = getData('tbl_users','id',$id,$type);
    $vcardObj = new VCard();
    $lastname = $row['lastName'];
    $firstname = $row['firstName'];
    $additional = '';
    $prefix = '';
    $suffix = '';
    $vcardObj->addName($lastname, $firstname, $additional, $prefix, $suffix);
    $vcardObj->addEmail($row['email']);
    $vcardObj->addPhoneNumber($row['phoneCode'].$row['phoneNumber']);
    $vcardObj->addJobtitle($row['designation']);
  //  $row['userProfile'] ? $vcardObj->addPhoto('../../uploads/users/'.$row['userProfile']) : "";
    $vcardObj->download();
}
else if($type == 'private')
{
    $row = getData('tbl_privateAccount','PID',$id,$type);
    $vcardObj = new VCard();
    $lastname = '';
    $firstname = $row['privateAccountName'];
    $additional = '';
    $prefix = '';
    $suffix = '';
    $vcardObj->addName($lastname, $firstname, $additional, $prefix, $suffix);
    $vcardObj->addEmail($row['email']);
    $vcardObj->addPhoneNumber($row['phoneCode'].$row['phoneNumber']);
    //$vcardObj->addJobtitle($row['designation']);
   // $row['privateUserProfile'] ? $vcardObj->addPhoto('../../uploads/privateAccounts/'.$row['privateUserProfile']) : "";
    $vcardObj->download();
}
else if($type == 'business')
{
     $row = getData('tbl_businessAccount','BID',$id,$type);
    $vcardObj = new VCard();
    $lastname = '';
    $firstname = $row['businessName'];
    $additional = '';
    $prefix = '';
    $suffix = '';
    $vcardObj->addName($lastname, $firstname, $additional, $prefix, $suffix);
    $vcardObj->addEmail($row['email']);
    $vcardObj->addPhoneNumber($row['phoneCode'].$row['phoneNumber']);
    $vcardObj->addJobtitle($row['designation']);
   // $row['businessProfile'] ? $vcardObj->addPhoto('../../uploads/businessAccounts/'.$row['businessProfile']) : "";
    $vcardObj->download();
}
else if($type == 'staff')
{
    $row = getData(' tbl_businessStaffAccount','SID',$id,$type);
    $vcardObj = new VCard();
    $lastname = '';
    $firstname = $row['name'];
    $additional = '';
    $prefix = '';
    $suffix = '';
    $vcardObj->addName($lastname, $firstname, $additional, $prefix, $suffix);
    $vcardObj->addEmail($row['email']);
    $vcardObj->addPhoneNumber($row['phoneCode'].$row['phoneNumber']);
    $vcardObj->addJobtitle($row['designation']);
    //$row['profileImage'] ? $vcardObj->addPhoto('../../uploads/users/'.$row['staff']) : "";
    $vcardObj->download();
}

?>