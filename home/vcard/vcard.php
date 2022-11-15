<?php
echo "dsf";
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
        $vcardObj->addAddress("#123");

      //  return $vcardObj->download();
?>