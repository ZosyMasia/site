<? 
define('SCRIPT_MASIA',__DIR__);

include(__DIR__.'/data/ini.php');

$page = $_GET['page']; 

include(__DIR__.'/page/header.php'); 
 
include(__DIR__.'/page/main.php'); 

include(__DIR__.'/page/footer.php'); 