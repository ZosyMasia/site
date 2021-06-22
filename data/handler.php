<?php
if (!defined('SCRIPT_MASIA')) {
	echo ('Выявлена попытка взлома!');
	exit();
};
function v ($v) {
    ?>
    <div  style="width: 80%;margin:0 auto"><pre><?
        // var_dump($v);
        print_r($v);
    ?></pre></div><?
    exit;
};
// -----------------------------------------------------------
if (isset($_GET['st']) && $_GET['st'] <= 2) {
    $stat = $_GET['st'];
} else {
    $stat = 1;
}
// ----------------------------------------------------------------
$sql = $db->Query(" SELECT m.title,m.title_link,m.state,m.views,r.*,i.img_name 
                    FROM main m LEFT JOIN review r ON m.id = r.main_id 
                    LEFT JOIN images i ON m.id = i.main_id
                    WHERE state=?i ORDER BY id DESC LIMIT 8", $stat);

// ----------------------------------------------------------------
if (isset($_GET['id'])) 
    $id = $_GET['id'] * 1;
// ---------------------------------------------------------------
