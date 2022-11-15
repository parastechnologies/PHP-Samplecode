<?php
function getData($table,$key,$value)
{
    $mysqli = new mysqli("localhost","amandeep_maaraUser","pe7%Gb-i%TfL","amandeep_maaraDB");
   echo $sql = "Select *,up.phoneCode,up.profileSlug from $table as u 
        LEFT JOIN tbl_userPlateforms as up ON u.$key = up.profileID AND p.userType = $value
        LEFT JOIN tbl_plateforms as p ON up.platformID = p.id AND p.slug = 'phone' 
        where u.$key = $value";
    $result = $mysqli->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);  
    print_r($row);
}

$type = 'public';
if($type == 'public')
{
    getData('tbl_users','id',61);
}
else if($type == 'private')
{
    
}
else if($type == 'business')
{
    
}
else if($type == 'staff')
{
    
}



//printf ("%s (%s)\n", $row[0], $row[1]);






/*echo "skdakshd";
print_r($_SERVER);*/
/*echo $_SERVER['REQUEST_URI'];

use JeroenDesloovere\VCard\VCard;
require_once '../vendor/behat/transliterator/src/Behat/Transliterator/Transliterator.php';
require_once '../vendor/jeroendesloovere/vcard/src/VCard.php';

        // define vcard
$vcardObj = new VCard();
// add personal data
$vcardObj->addName("Saurabh");
$vcardObj->addBirthday("18-june-1995");
$vcardObj->addEmail("Saurabh@gmail.com");
$vcardObj->addPhoneNumber("9878467797");
$vcardObj->addAddress("#123");*/

?>