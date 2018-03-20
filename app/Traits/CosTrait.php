<?php
namespace App\Traits;


/**
 * 腾讯COS存储
 * User: 小强
 * Date: 2018/3/20
 * Time: 8:59
 * 说明：
 */
trait CosTrait{
   public function __construct(){
       #这里请填写cos-autoloader.php该文件所在的相对路径
       require(public_path().'/backend/myvebdors/cos-php-sdk-v5-master/cos-autoloader.php');
           $cosClient = new Qcloud\Cos\Client(array('region' => getenv('COS_REGION'),
                   'credentials'=> array(
                       'secretId'    => getenv('COS_KEY'),
                       'secretKey' => getenv('COS_SECRET')
                   )
               )
           );
   }
}