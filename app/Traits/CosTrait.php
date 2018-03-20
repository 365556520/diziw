<?php
namespace App\Traits;

use Qcloud\Cos\Client;
/**
 * 腾讯COS存储
 * User: 小强
 * Date: 2018/3/20
 * Time: 8:59
 * 说明：
 */
trait CosTrait{
    //获取cos连接对象
   public function getCosClient(){
       /*    #这里请填写cos-autoloader.php该文件所在的相对路径这个地方说是需要但是目前没导入也没问题
        require(public_path().'/backend/myvebdors/cos-php-sdk-v5-master/cos-autoloader.php');*/
       $cosClient = new Client(
           array(
               'region' => 'ap-beijing',
               'credentials'=> array(
                   'appId' => '1251899486',
                   'secretId' => 'AKIDKYhkbIPLfnnaBb6obDielplkcIm32GED',
                   'secretKey' => 'ylLn370jIjx1v23sUxFLEwRmvDM7lFXd'
               )
           )
       );
       return $cosClient;
   }
   //上传文件
    public function upCosClient(){
        $cosClient = $this->getCosClient();
        //上传文件
        try {
            $result = $cosClient->putObject(array(
                //bucket的命名规则为{name}-{appid} ，此处填写的存储桶名称必须为此格式
                'Bucket' => 'testbucket-125000000',
                'Key' => '11.txt',
                'Body' => 'Hello World!'));
            print_r($result);
        } catch (\Exception $e) {
            echo "$e\n";
        }
#分块上
    }

}