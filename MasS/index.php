<?
define('SCRIPT_MASIA',__DIR__); 
include(__DIR__.'/data/ini.php');

$page = $_GET['page']; 

include('page/header.php'); 
if(isset($page)){ 
if(file_exists(__DIR__."/page/".$page.".php")){ 
include(__DIR__."/page/".$page.'.php'); 
}else{ 
include(__DIR__.'/page/404.php'); 
} 
}else{ 
include(__DIR__.'/page/main.php'); 
}
include('page/footer.php'); 