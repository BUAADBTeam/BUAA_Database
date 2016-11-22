<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadm extends Model {
  

  function __construct()
  {
    parent::__construct();
  }

  //获取文件后缀名函数  
  private function fileext($filename)  
  {  
    return substr(strrchr($filename, '.'), 1);  
  }  
 //生成随机文件名函数      
  private function random($length)  
  {  
    $hash = 'CR-';  
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';  
    $max = strlen($chars) - 1;  
    mt_srand((double)microtime() * 1000000);  
    for($i = 0; $i < $length; $i++)  
    {  
        $hash .= $chars[mt_rand(0, $max)];  
    }  
    return $hash;  
  }   

  function upload($uploaddir) 
  {
    // $uploaddir = "./files/";//设置文件保存目录 注意包含/      
    $type=array("jpg","gif","bmp","jpeg","png");//设置允许上传文件的类型     
    // $patch="http://127.0.0.1/cr_downloadphp/upload/files/";//程序所在路径
    print_r($_FILES);
    $a=strtolower($this->fileext($_FILES['fileUp']['name']));  
   //判断文件类型  
    if(!in_array(strtolower($this->fileext($_FILES['fileUp']['name'])),$type))  {  
        // $text=implode(",",$type);  
        // echo "您只能上传以下类型文件: ",$text,"<br>";  
        return false;
    }  
   //生成目标文件的文件名      
   else{  
      $filename=explode(".",$_FILES['fileUp']['name']);  
      do  
      {  
          $filename[0]=$this->random(10); //设置随机数长度  
          $name=implode(".",$filename);  
          //$name1=$name.".Mcncc";  
          $uploadfile=$uploaddir.$name;  
      } while(file_exists($uploadfile));  
      if(move_uploaded_file($_FILES['fileUp']['tmp_name'],$uploadfile)){  
          return true;
          // if(is_uploaded_file($_FILES['fileUp']['tmp_name'])){  
              
          //   return true;
          // }  
          // else{  
          //   return false;
          // }  
      }  
   }    
  }

}
