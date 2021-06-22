<?php
if (!defined('SCRIPT_MASIA')) {
	echo ('Выявлена попытка взлома!');
	exit();
};
// -----------------------------------------------------------
if (isset($_GET['st']) && $_GET['st'] <= 2) {
    $stat = $_GET['st'] * 1;
} else {
    $stat = 1;
}
// ----------------------------------------------------------------
if (isset($_GET['id'])) 
    $id = $_GET['id'] * 1;
// ----------------------------------------------------------------

$sql = $db->Query(" SELECT m.title,m.title_link,m.state,m.views,r.*,i.img_name 
                    FROM main m LEFT JOIN review r ON m.id = r.main_id 
                    LEFT JOIN images i ON m.id = i.main_id
                    WHERE state=?i ORDER BY id DESC LIMIT 8", $stat);


// ---------------------------------------------------------------

// $banner = $db->Query("SELECT * FROM banner");

// ---------------------------------------------------------------


unset($_error);
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (isset($_POST['button_data']) && !empty($_POST['button_data'])){ 
		$button_data = sf($_POST['button_data']);
		switch ($button_data) {
			case 'delete':
				admindelete($pdo);
				break;
			case 'update':
				
				adminupdate($pdo);
				break;
			case 'newdate':
				admininsert($pdo);
				break;
		}
	}
	// ---------------
	if (isset($_POST['banner_data']) && !empty($_POST['banner_data'])){ 
		$banner_data = sf($_POST['banner_data']);
		switch ($banner_data) {
			case 'delete':
				banner_delete($pdo);
				break;
			case 'update':
				banner_update($pdo);
				break;
			case 'newdate':
				banner_insert($pdo);
				
		}
	}



	header('Location:'.$_SERVER['PHP_SELF']);
	exit();
}