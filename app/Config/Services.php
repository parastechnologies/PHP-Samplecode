<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */
    public function db()
    {
        $db = \Config\Database::connect();
        return $db;
    }
    public function userDevicesList($userID)
    {
        $db = Services::db();
        $builder = $db->table('tbl_activeDevices as a');
        $builder->select("d.*,a.id as AID,a.status,a.userType,t.icon,IF(a.deviceName IS NOT NULL,a.deviceName,d.deviceName) as deviceName");
        $builder->where('a.userID',$userID);
        $builder->Where('a.status !=',3);
        /*$builder->groupStart();
        $builder->where('a.status',0);
        $builder->orWhere('a.status',1);
        $builder->groupEnd();*/
        $builder->join('tbl_devices as d', 'd.id = a.deviceID','inner');
        $builder->join('tbl_deviceTypes as t', 't.id = d.deviceType','left');
        //$builder->limit($limit,$offset);
        $builder->orderBy('id','desc');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getDeviceByTagID($deviceNumber)
    {
        $db = Services::db();
        $builder = $db->table('tbl_devices as d');
        $builder->select("a.profileID,a.userType,a.status,a.userType,d.deviceNumber,a.deviceID");
        $builder->where('d.deviceNumber',$deviceNumber);
        $builder->join('tbl_activeDevices as a', 'd.id = a.deviceID','inner');
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function userConnectionList($userID,$offset,$limit)
    {
        $db = Services::db();
        $builder = $db->table('tbl_connections as c');
        $builder->select("c.*, 
        (CASE
            WHEN  userType = 'public' THEN CONCAT(u.firstName, ' ', u.lastName)
            WHEN userType = 'private' THEN p.privateAccountName
            WHEN userType = 'business' THEN b.businessName
            WHEN userType = 'staff' THEN s.name
            ELSE NULL  
        END) as name,
        (CASE
            WHEN  userType = 'public' THEN u.designation
            WHEN userType = 'staff' THEN s.designation
            ELSE NULL  
        END) designation,
        (CASE
            WHEN  userType = 'public' THEN u.description
            WHEN userType = 'private' THEN p.privateAccountDescription
            WHEN userType = 'business' THEN b.businessDescription
            ELSE NULL  
        END) description,
        (CASE
            WHEN userType = 'public' THEN u.userProfile
            WHEN userType = 'private' THEN p.privateUserProfile
            WHEN userType = 'business' THEN b.businessProfile
            WHEN userType = 'staff' THEN s.profileImage
            ELSE NULL  
        END) as profileImage");
        $builder->where('c.userID',$userID);
        $builder->where('c.status',1);
        $builder->join('tbl_users as u', 'u.id = c.profileID AND userType = "public"','LEFT');
        $builder->join('tbl_privateAccount as p', 'p.PID = c.profileID AND userType = "private"','LEFT');
        $builder->join('tbl_businessAccount as b', 'b.BID = c.profileID AND userType = "business"','LEFT');
        $builder->join('tbl_businessStaffAccount as s', 's.SID = c.profileID AND userType = "staff" ','LEFT');
        $builder->limit($limit,$offset);
        $builder->orderBy('c.id','desc');
        $query = $builder->get();
       // echo $db->getLastQuery();
        return $query->getResultArray();
    }
    public function getConnectedUserStatus($userID,$profileID,$profileType)
    {
        $db = Services::db();
        $builder = $db->table('tbl_connections as c');
        $builder->select("status");
        //$builder->groupStart();
        $builder->where('c.userID',$userID);
        $builder->where('c.profileID',$profileID);
        $builder->where('c.userType',$profileType);
        /*$builder->orGroupStart();
        $builder->where('c.userID',$profileID);
        $builder->where('c.profileID',$userID);
        $builder->where('c.userType',$userProfileType);
        $builder->groupEnd();*/
        $builder->where('c.status',1);
        $query = $builder->get();
       // echo $db->getLastQuery();
        return $query->getRowArray();
    }
    public function userPlatformList($userID,$accountID,$userType)
    {
        $db = Services::db();
       // $con1 = Services::getUserTheme($accountID,$userType);
     //   $iconType = $con1['iconType'] ? $con1['iconType'] : 'Rectangular';
        $isDirectLink = Services::isCheckDirectLink($accountID,$userType);
        $builder = $db->table('tbl_userPlateforms as up');
        $builder->select("up.*,p.slug,p.name,p.hints,p.baseURL,p.profileURL,p.inputType,`p`.`image` as `rectImage`,`p`.`roundBlurImage`,`p`.`blurImage`,`p`.`roundImage`,
        CASE
            WHEN ($isDirectLink != 0 && isDefault = 0) THEN `p`.`blurImage`
            ELSE `p`.`image`
        END as image");
        //$builder->select("up.*,p.name,p.hints,p.baseURL,p.profileURL,p.inputType,`p`.`image`,`p`.`image` as `rectImage`,`p`.`roundBlurImage`,`p`.`blurImage`,`p`.`roundImage`");
        $builder->where('up.userID',$userID);
        $builder->where('up.accountID',$accountID);
        $builder->where('up.userType',$userType);
        $builder->join('tbl_plateforms as p', 'p.id = up.platformID','inner');
        $builder->join('tbl_userTheme as t', "t.accountID = up.accountID AND t.userType = '$userType'",'left');
      //  LEFT JOIN `tbl_userTheme` as `t` ON `t`.`accountID` = `up`.`accountID` AND t.userType = 'public'
       // $builder->limit($limit,$offset);
        $builder->orderBy('up.order','asc');
        $query = $builder->get();
       // echo $db->getLastQuery();
        return $query->getResultArray();
    }
      public function userPlatformSingle($userID,$accountID,$userType)
    {
        $db = Services::db();
        $isDirectLink = Services::isCheckDirectLink($accountID,$userType);
        $builder = $db->table('tbl_userPlateforms as up');
        $builder->select("up.*,p.slug,p.name,p.hints,p.baseURL,p.profileURL,p.inputType");
        $builder->where('up.userID',$userID);
        $builder->where('up.accountID',$accountID);
        $builder->where('up.userType',$userType);
        $builder->where('up.isDefault',1);
        $builder->join('tbl_plateforms as p', 'p.id = up.platformID','inner');
        $builder->orderBy('up.order','asc');
        $query = $builder->get();
       // echo $db->getLastQuery();
        return $query->getRowArray();
    }
    public function isCheckDirectLink($accountID,$userType)
    {
        $db = Services::db();
        $builder = $db->table('tbl_userPlateforms as up');
        $builder->select("isDefault");
        $builder->where('up.accountID',$accountID);
        $builder->where('up.userType',$userType);
        $builder->where('up.isDefault',1);
        $query = $builder->get();
        return $query->getNumRows();
    }
    public function userPlatformDetail($PID,$userType,$accountID)
    {
        /*$db = Services::db();
        $isDirectLink = Services::isCheckDirectLink($accountID,$userType);
        $sel = $db->query("SELECT `up`.*, CASE WHEN $isDirectLink != 0 THEN p.blurImage ELSE p.image END as image,
            `p`.`name`, `p`.`hints`,
            `p`.`instruction`, `p`.`baseURL`, `p`.`profileURL`, `p`.`inputType`
            FROM `tbl_userPlateforms` as `up`
            INNER JOIN `tbl_plateforms` as `p` ON `p`.`id` = `up`.`platformID`
            LEFT JOIN `tbl_userTheme` as `t` ON `t`.`accountID` = `up`.`accountID` AND `t`.`userType` = 'public'
            WHERE `up`.`id` = $PID");
        return $sel->getRowArray();*/
        $db = Services::db();
        $isDirectLink = Services::isCheckDirectLink($accountID,$userType);
        $sel = $db->query("SELECT `up`.*, CASE WHEN $isDirectLink != 0 THEN p.blurImage ELSE p.image END as image,
            `p`.`name`, `p`.`hints`,p.image as rectImage, p.roundBlurImage, p.blurImage, p.roundImage,
            `p`.`instruction`, `p`.`baseURL`, `p`.`profileURL`, `p`.`inputType`
            FROM `tbl_userPlateforms` as `up`
            INNER JOIN `tbl_plateforms` as `p` ON `p`.`id` = `up`.`platformID`
            LEFT JOIN `tbl_userTheme` as `t` ON `t`.`accountID` = `up`.`accountID` AND `t`.`userType` = 'public'
            WHERE `up`.`id` = $PID");
        return $sel->getRowArray();
    }
    /* Start admin panel */
    public function getProducts()
    {
        $db = Services::db();
        $builder = $db->table('tbl_products as p');
        $builder->select("p.*,i.image,dt.typeName");
        $builder->join('tbl_productColorImages as i', 'i.productID = p.id AND i.colorID IS NULL','left');
        $builder->join('tbl_deviceTypes as dt', 'dt.id = p.deviceTypeID','left');
        $builder->orderBy('p.id','desc');
        $builder->groupBy('p.id');
        $query = $builder->get();
        return $query->getResultArray();
    }
   public function getDevicesTypes()
    {
        $db = Services::db();
        $builder = $db->table('tbl_deviceTypes as dt');
        $builder->select("dt.*,IF(d.deviceType,1,0) as isCheck");
        $builder->join('tbl_devices as d', 'd.deviceType = dt.id','left');
        $builder->orderBy('dt.id','desc');
        $builder->groupBy('dt.id');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getProductDetail($id)
    {
        $db = Services::db();
        $builder = $db->table('tbl_products as p');
        $builder->select("p.*,dt.typeName");
        $builder->where('p.id',$id);
        $builder->join('tbl_deviceTypes as dt', 'dt.id = p.deviceTypeID','left');
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function getProductImages($id)
    {
        $db = Services::db();
        $builder = $db->table('tbl_productColorImages as i');
        $builder->select("i.*,c.colorName");
        $builder->where("i.productID",$id);
        $builder->join('tbl_colors as c', 'c.id = i.colorID','left');
        $query = $builder->get();
        //echo $db->getLastQuery();
        return $query->getResultArray();
    }
    public function getProductByColors($id)
    {
        $db = Services::db();
        $builder = $db->table('tbl_productColorImages as i');
        $builder->select("i.*,c.colorName");
        $builder->where("i.productID",$id);
        $builder->where("i.colorID IS NOT NULL");
        $builder->join('tbl_colors as c', 'c.id = i.colorID','left');
        $query = $builder->get();
        //echo $db->getLastQuery();
        return $query->getResultArray();
    }
    public function getOrdersProcessInAdmin()
    {
        $db = Services::db();
        $builder = $db->table('tbl_orders as o');
        $builder->select("o.*,IF(o.userID,u.email,a.email) as email");
        $builder->where("o.status !=","3");
        $builder->where("o.userStatus","1");
        $builder->orderBy('o.orderID','desc');
        $builder->join('tbl_users as u', 'u.id = o.userID AND u.isWeb = 1','left');
        $builder->join('tbl_userAddress as a', 'a.id = o.shippingAddressID AND o.userID IS NULL','left');
        $query = $builder->get();
       // echo $db->getLastQuery();
        return $query->getResultArray();
    }
    public function getOrdersPastInAdmin()
    {
        $db = Services::db();
        $builder = $db->table('tbl_orders as o');
        $builder->select("o.*,u.email");
        $builder->where("o.status","3");
        $builder->join('tbl_users as u', 'u.id = o.userID AND u.isWeb = 1','left');
        $builder->orderBy('o.orderID','desc');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getorderDetail($orderID)
    {
        $db = Services::db();
        $builder = $db->table('tbl_orders as o');
        $builder->select("o.*,o.status as orderStatus,IF(o.userID,u.email,a.email) as email,IF(o.userID,1,0) as isCheck,a.*,s.name as state");
        $builder->where("o.orderID",$orderID);
        $builder->join('tbl_users as u', 'u.id = o.userID AND u.isWeb = 1','left');
        $builder->join('tbl_userAddress as a', 'a.id = o.shippingAddressID','left');
        $builder->join('tbl_states as s', 's.id = a.stateID','left');
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function cartList($orderID)
    {
        $db = Services::db();
        $builder = $db->table('tbl_orderItems as i');
        $builder->select("p.name,m.image as pImage,i.*");
        $builder->where('i.orderID ',$orderID);
        $builder->join('tbl_products as p', 'p.id = i.productID','inner');
        $builder->join('tbl_productColorImages as m', 'm.productID = i.productID  AND i.isCustom = 0','left');
        $builder->groupBy('m.productID');
        $query = $builder->get();
       // echo $db->getLastQuery();
        return $query->getResultArray();
    }
    public function cartListLanding($orderID)
    {
        $db = Services::db();
        $builder = $db->table('tbl_orderItems as i');
        $builder->select("p.name,m.image as pImage,i.*,c.colorName");
        $builder->where('i.orderID ',$orderID);
        $builder->join('tbl_products as p', 'p.id = i.productID','inner');
        $builder->join('tbl_productColorImages as m', 'm.productID = i.productID  AND i.isCustom = 0','left');
        $builder->join('tbl_colors as c', 'c.id = i.colorID AND (i.colorID IS NOT NULL AND i.isCustom != 1)','left');
        $builder->groupBy('m.productID');
        $query = $builder->get();
     //   echo $db->getLastQuery();
        return $query->getResultArray();
    }

    public function getUsersInAdmin()
    {
        $db = Services::db();
        $builder = $db->table('tbl_users as u');
        $builder->select("u.*,p.PID,b.BID,s.plan");
        $builder->where('u.isWeb',0);
        $builder->join('tbl_businessAccount as b', 'b.userID = u.id','left');
        $builder->join('tbl_privateAccount as p', 'p.userID = u.id','left');
        $builder->join('tbl_subscriptions as s', 's.userID = u.id','left');
        $builder->groupBy('u.id');
        $builder->orderBy('u.id','desc');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getSubscriptionInAdmin()
    {
        $db = Services::db();
        $builder = $db->table("tbl_subscriptions as s");
        $builder->select("u.firstName,u.lastName,u.email,u.userProfile,s.source,s.plan,s.orderID");
        $builder->join('tbl_users as u',"u.id = s.userID",'inner');
        $builder->orderBy("s.id","desc");
        $query = $builder->get();
        return $query->getResultArray();
        //SELECT b.*,COUNT(ad.id) as total from tbl_businessAccount as b LEFT JOIN tbl_activeDevices as ad ON ad.profileID = b.BID AND ad.userType = 'business' WHERE b.userID = 66 GROUP BY b.BID
    }
    public function getDevices()
    {
        /*$db = Services::db();
        $builder = $db->table('tbl_devices as d');
        $builder->select("d.*,u.profileLink,u.QRCode,u.profileLink,p.profileLink as privateprofileLink,
        p.QRCode as privateQRCode,b.profileLink as businessprofileLink,b.QRCode as businessQRCode,u.profileLink as staffprofileLink,s.QRCode as staffQRCode");
        $builder->join('tbl_activeDevices as a', 'a.deviceID = d.id','left');
        $builder->join('tbl_users as u', 'u.id = a.profileID AND a.userType = "public"','LEFT');
        $builder->join('tbl_privateAccount as p', 'p.PID = a.profileID AND a.userType = "private"','LEFT');
        $builder->join('tbl_businessAccount as b', 'b.BID = a.profileID AND a.userType = "business"','LEFT');
        $builder->join('tbl_businessStaffAccount as s', 's.SID = a.profileID AND a.userType = "staff" ','LEFT');
        $builder->groupBy('d.id');
        $builder->orderBy('d.id','desc');
        $query = $builder->get();
        return $query->getResultArray();*/
        
        
          $db = Services::db();
        $builder = $db->table('tbl_devices as d');
         $builder->select("d.*, 
        (CASE
            WHEN  userType = 'public' THEN u.profileLink
            WHEN userType = 'private' THEN p.profileLink
            WHEN userType = 'business' THEN b.profileLink
            WHEN userType = 'staff' THEN s.profileLink
            ELSE NULL  
        END) as deviceURL,
        (CASE
            WHEN  userType = 'public' THEN u.QRCode
            WHEN userType = 'private' THEN p.QRCode
            WHEN userType = 'business' THEN b.QRCode
            WHEN userType = 'staff' THEN s.QRCode
            ELSE NULL  
        END) as qrCode");
        $builder->join('tbl_activeDevices as a', 'a.deviceID = d.id','left');
        $builder->join('tbl_users as u', 'u.id = a.profileID AND a.userType = "public"','LEFT');
        $builder->join('tbl_privateAccount as p', 'p.PID = a.profileID AND a.userType = "private"','LEFT');
        $builder->join('tbl_businessAccount as b', 'b.BID = a.profileID AND a.userType = "business"','LEFT');
        $builder->join('tbl_businessStaffAccount as s', 's.SID = a.profileID AND a.userType = "staff" ','LEFT');
        $builder->groupBy('d.id');
        $builder->orderBy('d.id','desc');
        $query = $builder->get();
        return $query->getResultArray();
    }
    /* Stop admin panel */
    /*Start Landing Panel*/
        public function getDevicesByID($deviceNumber)
    {
        $db = Services::db();
        $builder = $db->table('tbl_devices as d');
         $builder->select("d.*, 
        (CASE
            WHEN  userType = 'public' THEN u.profileLink
            WHEN userType = 'private' THEN p.profileLink
            WHEN userType = 'business' THEN b.profileLink
            WHEN userType = 'staff' THEN s.profileLink
            ELSE NULL  
        END) as deviceURL,
        (CASE
            WHEN  userType = 'public' THEN u.QRCode
            WHEN userType = 'private' THEN p.QRCode
            WHEN userType = 'business' THEN b.QRCode
            WHEN userType = 'staff' THEN s.QRCode
            ELSE NULL  
        END) as qrCode");
        $builder->join('tbl_activeDevices as a', 'a.deviceID = d.id','left');
        $builder->join('tbl_users as u', 'u.id = a.profileID AND a.userType = "public"','LEFT');
        $builder->join('tbl_privateAccount as p', 'p.PID = a.profileID AND a.userType = "private"','LEFT');
        $builder->join('tbl_businessAccount as b', 'b.BID = a.profileID AND a.userType = "business"','LEFT');
        $builder->join('tbl_businessStaffAccount as s', 's.SID = a.profileID AND a.userType = "staff" ','LEFT');
     //   $payload['deviceNumber']
        //$builder->groupBy('d.id');
        //$builder->orderBy('d.id','desc');
        $builder->where('d.deviceNumber',$deviceNumber);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function getHomeRecentProducts()
    {
        $db = Services::db();
        $builder = $db->table('tbl_products as p');
        $builder->select("p.*,GROUP_CONCAT(c.colorName,'-',c.id) as colors,IF(`i`.`colorID`,`i`.`image`,`m`.`image`) as `image`,`i`.`colorID`,`c`.`colorName`");
        $builder->join('tbl_productColorImages as i', 'i.productID = p.id AND i.colorID IS NOT NULL','left');
        $builder->join('tbl_productColorImages as m', 'm.productID = p.id AND m.colorID IS NULL','left');
        $builder->join('tbl_colors as c', 'c.id = i.colorID ','left');
        $builder->orderBy('p.id','desc');
        $builder->groupBy('p.id');
        $builder->limit(4);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getRelatedProducts($productID,$deviceID)
    {
        $db = Services::db();
        $builder = $db->table('tbl_products as p');
        $builder->select("p.*,GROUP_CONCAT(c.colorName,'-',c.id) as colors,IF(`i`.`colorID`,`i`.`image`,`m`.`image`) as `image`,`i`.`colorID`,`c`.`colorName`");
        $builder->where("p.deviceTypeID",$deviceID);
        if($productID != 0)
        {
            $builder->where("p.id !=",$productID);   
        }
        $builder->join('tbl_productColorImages as i', 'i.productID = p.id AND i.colorID IS NOT NULL','left');
        $builder->join('tbl_productColorImages as m', 'm.productID = p.id AND m.colorID IS NULL','left');
        $builder->join('tbl_colors as c', 'c.id = i.colorID ','left');
        $builder->orderBy('p.id','desc');
        $builder->groupBy('p.id');
       // $builder->limit(4);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getProductImagesColor($productID,$colorID)
    {
        $db = Services::db();
        $builder = $db->table('tbl_productColorImages as i');
        $builder->select("i.*,c.colorName");
        $builder->where("i.productID",$productID);
        if($colorID != 0)
        {
            $builder->where("i.colorID",$colorID);   
        }
        $builder->join('tbl_colors as c', 'c.id = i.colorID AND i.colorID IS NOT NULL','left');
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function getUserTheme($accountID,$type)
    {
        $db = Services::db();
        $builder = $db->table('tbl_userTheme as t');
        $builder->select("t.iconType,c.color,c.id");
        $builder->where("t.accountID",$accountID);
        $builder->where("t.userType",$type);
        $builder->join('tbl_themes as c', 'c.id = t.themeID ','left');
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function updateStatusOfUsers($userID)
    {
        $db = Services::db();
        $sel = $db->query("UPDATE tbl_users as u 
            LEFT JOIN `tbl_businessAccount` as `b` ON `u`.`id` = `b`.`userID`
            LEFT JOIN `tbl_privateAccount` as `p` ON `u`.`id` = `p`.`userID`
            LEFT JOIN `tbl_businessStaffAccount` as `s` ON `u`.`id` = `s`.`userID`
            SET u.status = 2,b.status = 2,p.status = 2,s.status=2
            WHERE `u`.`id` = $userID");
        //$sel->update();    
       // echo $db->getLastQuery();  
        return true;
    }
    
    public function getAnalytics($table,$type,$key,$userID,$key1)
    {
        $db = Services::db();
        $builder = $db->table("$table as t");
        $builder->select("t.*,COUNT(DISTINCT ad.id) as numberDevicesLinked,COUNT(DISTINCT a.id) as NFCTagScan,COUNT(DISTINCT d.id) as contactScan");
        $builder->where("t.$key1",$userID);
        $builder->join('tbl_activeDevices as ad',"ad.profileID = t.$key AND ad.userType = '$type' AND ad.status = 1",'left');
        $builder->join('tbl_analytics as a',"a.accountID = t.$key AND a.userType = '$type' AND a.count = 1",'left');
        $builder->join('tbl_analytics as d',"d.accountID = t.$key AND d.userType = '$type' AND d.count = 0",'left');
        $builder->groupBy("t.$key");
        $query = $builder->get();
       //  echo $db->getLastQuery(); 
        return $query->getResultArray();
        //LEFT JOIN `tbl_analytics` as `a` ON `a`.`accountID` = `t`.`BID` AND `a`.`userType` = 'business' AND `count` = 1
        //SELECT b.*,COUNT(ad.id) as total from tbl_businessAccount as b LEFT JOIN tbl_activeDevices as ad ON ad.profileID = b.BID AND ad.userType = 'business' WHERE b.userID = 66 GROUP BY b.BID
    }
    public function getAnalyticsForStaff($userID,$BID)
    {
        $db = Services::db();
        $builder = $db->table("tbl_businessStaffAccount as t");
        $builder->select("t.*,COUNT(DISTINCT ad.id) as numberDevicesLinked,COUNT(DISTINCT a.id) as NFCTagScan,COUNT(DISTINCT d.id) as contactScan");
        $builder->where("t.userID",$userID);
        $builder->where("t.BID",$BID);
        $builder->where("t.isDelete",0);
        $builder->join('tbl_activeDevices as ad',"ad.profileID = t.SID AND ad.userType = 'staff' AND ad.status = 1",'left');
        $builder->join('tbl_analytics as a',"a.accountID = t.SID AND a.userType = 'staff' AND a.count = 1",'left');
        $builder->join('tbl_analytics as d',"d.accountID = t.SID AND d.userType = 'staff' AND d.count = 0",'left');
        $builder->groupBy("t.SID");
        $builder->orderBy("t.SID","desc");
        $query = $builder->get();
       // echo $db->getLastQuery(); 
        return $query->getResultArray();
        //SELECT b.*,COUNT(ad.id) as total from tbl_businessAccount as b LEFT JOIN tbl_activeDevices as ad ON ad.profileID = b.BID AND ad.userType = 'business' WHERE b.userID = 66 GROUP BY b.BID
    }
    
    //UPDATE tbl_users as u,tbl_businessAccount as b SET u.status = 2,b.status = 2 WHERE u.id = b.userID AND u.id = 61

    /*SELECT p.*,GROUP_CONCAT(c.colorName) as colors,m.image
        FROM `tbl_products` as p 
        LEFT JOIN `tbl_productColorImages` as i ON i.productID = p.id
        LEFT JOIN `tbl_productColorImages` as m ON m.productID = p.id AND m.colorID IS NULL
        LEFT JOIN `tbl_colors` as c ON c.id = i.colorID  
        GROUP BY p.id*/
    /*Stop Landing Panel*/
    
        
    public function getProductDetail1($id)
    {
        $db = Services::db();
        $builder = $db->table('tbl_products as p');
        $builder->where('p.id',$id);
        $builder->select("p.*,GROUP_CONCAT(c.colorName,'-',c.id) as colors,IF(`i`.`colorID`,`i`.`image`,`m`.`image`) as `image`,`i`.`colorID`,`c`.`colorName`,dt.typeName");
        $builder->join('tbl_productColorImages as i', 'i.productID = p.id AND i.colorID IS NOT NULL','left');
        $builder->join('tbl_productColorImages as m', 'm.productID = p.id AND m.colorID IS NULL','left');
        $builder->join('tbl_colors as c', 'c.id = i.colorID ','left');
        $builder->join('tbl_deviceTypes as dt', 'dt.id = p.deviceTypeID','left');
        $query = $builder->get();
        return $query->getRowArray();
    }
    
    public function searchAccountID($userID)
    {
        $db = Services::db();
        $sel = $db->query("select u.id,pid,bid,sid
        from tbl_users as u
        left join (
           select userID, group_concat(PID) as pid
           from tbl_privateAccount as p
           group by userID
        ) tbl_privateAccount  on u.id = tbl_privateAccount.userID
        left join (
           select userID, group_concat(BID) as bid
           from tbl_businessAccount as b
           group by userID
        ) tbl_businessAccount on u.id = tbl_businessAccount.userID
        left join (
           select userID, group_concat(SID) as sid
           from tbl_businessStaffAccount as s
           group by userID
        ) tbl_businessStaffAccount on u.id = tbl_businessStaffAccount.userID
        where u.id = $userID");
        return $sel->getRowArray();
        /*$db = Services::db();
        $builder = $db->table('tbl_users as u');
        $builder->where('u.id',$userID);
        $builder->select("u.id,GROUP_CONCAT(b.BID) as bid, GROUP_CONCAT(p.PID) as pid, GROUP_CONCAT(s.SID) as sid");
        $builder->join('tbl_privateAccount as p', 'p.userID = u.id','left');
        $builder->join('tbl_businessAccount as b', 'b.userID = u.id','left');
        $builder->join('tbl_businessStaffAccount as s', 's.userID = u.id ','left');
        $query = $builder->get();
        return $query->getRowArray();*/
    }
    public function getorderDetailLanding($orderID)
    {
        $db = Services::db();
        $builder = $db->table('tbl_orders as o');
        $builder->select("o.*,u.email as useremail,a.*,s.name as state");
        $builder->where("o.orderID",$orderID);
        $builder->join('tbl_users as u', 'u.id = o.userID AND u.isWeb = 1','left');
        $builder->join('tbl_userAddress as a', 'a.id = o.shippingAddressID','left');
        $builder->join('tbl_states as s', 's.id = a.stateID','left');
        $query = $builder->get();
        return $query->getRowArray();
    }
}
