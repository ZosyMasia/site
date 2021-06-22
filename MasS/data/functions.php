<?
if (!defined('SCRIPT_MASIA')) {
    die('ERROR');
};

function v($q)
{
    echo '<pre>';
    print_r($q);
    echo '</pre>';
    exit();
}



// ------------------Функция работы с базой данных----------------
function adminupdate($pdo)
{
    $sql_1 = "UPDATE main SET title = :title,title_link = :title_link,state = :state WHERE id = :id";


    $sql_2 = "UPDATE review SET date = :date,tariff_plans = :tariff_plans,min = :min,referral_plans =:referral_plans,payment_sys = :payment_sys,type_of_pay = :type_of_pay,descript = :descript,our_contr = :our_contr 
 WHERE main_id = :id";

    $sth_1 = $pdo->prepare($sql_1);
    $sth_2 = $pdo->prepare($sql_2);



    $sth_1->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $sth_1->bindParam(':title_link', $_POST['title_link'], PDO::PARAM_STR);
    $sth_1->bindParam(':state', $_POST['state'], PDO::PARAM_INT);
    $sth_1->bindParam(':id', $_POST['id'], PDO::PARAM_INT);


    $sth_2->bindParam(':date', $_POST['date']);
    $sth_2->bindParam(':min', $_POST['min'], PDO::PARAM_INT);
    $sth_2->bindParam(':descript', $_POST['descript'], PDO::PARAM_STR);
    $sth_2->bindParam(':referral_plans', $_POST['referral_plans'], PDO::PARAM_STR);
    $sth_2->bindParam(':tariff_plans', $_POST['tariff_plans'], PDO::PARAM_STR);
    $sth_2->bindParam(':type_of_pay', $_POST['type_of_pay'], PDO::PARAM_STR);
    $sth_2->bindParam(':our_contr', $_POST['our_contr'], PDO::PARAM_INT);
    $sth_2->bindParam(':payment_sys', $_POST['payment_sys'], PDO::PARAM_STR);
    $sth_2->bindParam(':id', $_POST['id'], PDO::PARAM_INT);



    $sth_1->execute();
    $sth_2->execute();
}







function admininsert($pdo)
{

    $sql_1 = "INSERT INTO main SET title = :title,title_link = :title_link,state = :state";

    $sth_1 = $pdo->prepare($sql_1);

    $sth_1->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $sth_1->bindParam(':title_link', $_POST['title_link'], PDO::PARAM_STR);
    $sth_1->bindParam(':state', $_POST['state'], PDO::PARAM_INT);

    $sth_1->execute();

    // Получаем id вставленной записи
    $insert_id = $pdo->lastInsertId();


    if ($_FILES['picture']['size'] != 0) {
        $picture_name = images_tm();
        $sql_3 = "INSERT INTO images SET main_id = :main_id,img_name = :img_name";

        $sth_3 = $pdo->prepare($sql_3);

        $sth_3->bindParam(':img_name', $picture_name, PDO::PARAM_STR);
        $sth_3->bindParam(':main_id', $insert_id, PDO::PARAM_INT);

        $sth_3->execute();
    }



    $sql_2 = "INSERT INTO review SET date = :date,tariff_plans = :tariff_plans,min = :min,referral_plans =:referral_plans,payment_sys = :payment_sys,type_of_pay = :type_of_pay,descript = :descript,our_contr = :our_contr, main_id = :main_id";

    $sth_2 = $pdo->prepare($sql_2);

    $sth_2->bindParam(':date', $_POST['date']);
    $sth_2->bindParam(':min', $_POST['min'], PDO::PARAM_INT);
    $sth_2->bindParam(':descript', $_POST['descript'], PDO::PARAM_STR);
    $sth_2->bindParam(':referral_plans', $_POST['referral_plans'], PDO::PARAM_STR);
    $sth_2->bindParam(':tariff_plans', $_POST['tariff_plans'], PDO::PARAM_STR);
    $sth_2->bindParam(':type_of_pay', $_POST['type_of_pay'], PDO::PARAM_STR);
    $sth_2->bindParam(':our_contr', $_POST['our_contr'], PDO::PARAM_INT);
    $sth_2->bindParam(':payment_sys', $_POST['payment_sys'], PDO::PARAM_STR);
    $sth_2->bindParam(':main_id', $insert_id, PDO::PARAM_INT);

    $sth_2->execute();
}



function admindelete($pdo)
{

    delete_photo($_POST['id']);

    $sth_1 = $pdo->prepare("DELETE FROM `main` WHERE `id` = :id");
    $sth_1->execute(array('id' => $_POST['id']));
    $sth_2 = $pdo->prepare("DELETE FROM `review` WHERE `main_id` = :id");
    $sth_2->execute(array('id' => $_POST['id']));
    $sth_3 = $pdo->prepare("DELETE FROM `images` WHERE `main_id` = :id");
    $sth_3->execute(array('id' => $_POST['id']));
}

// --------------Удаление фото с сервера------------------
function delete_photo($id)
{
    global $pdo;
    $sth = $pdo->Query("SELECT img_name FROM images WHERE main_id = " . $id . "")->fetch();

    $dir_1 = '../img/thumbs/';
    $dir_2 = '../img/medium/';

    function del($del, $sth)
    {

        $dir = scandir($del);

        foreach ($dir as $value) {
            if ($value == $sth['img_name']) {
                if (!unlink($del . $sth['img_name'])) die('Что-то пошло не так!');
            }
        }
    }

    del($dir_1, $sth);
    del($dir_2, $sth);
}
// -----------------------Функции для банера---------------------
function banner_insert($pdo) {
    if( isset($_POST['link_banner']) && !empty($_POST['link_banner'])){
        $link_banner=$_POST['link_banner'];
    }else{
        $link_banner='http://';
    }
    
    if ($_FILES['banner']['size'] != 0) {
         $types = array('image/gif');
        if (!in_array($_FILES['banner']['type'], $types))
            die('<p>Запрещённый тип файла. <a href="?">Попробовать другой файл?</a></p>');
        //если имя файла пустое 
        if ($_FILES['banner']['name'] == '')
            echo ('Файл не выбран!');
        //если размер файла превышает 1 Мб
        elseif ($_FILES['banner']['size'] > 1048576)
            echo ('Размер файла превышает 1 Мб!');
        else {
            // копируем файл из временной директории

            $name  = time() . '-' . mt_rand().'.'.pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);

            copy($_FILES['banner']['tmp_name'], '../img/banner/' . $name);
        }
    }
    $sql = "INSERT INTO banner SET title_banner = :title_banner,link_banner = :link_banner";
            $sth = $pdo->prepare($sql);
            $sth->bindParam(':title_banner', $name, PDO::PARAM_STR);
            $sth->bindParam(':link_banner', $link_banner, PDO::PARAM_STR);
            $sth->execute();
}


function banner_delete($pdo) {
    if(unlink('../img/banner/'.$_POST['title_banner'])){
    $sth = $pdo->prepare("DELETE FROM `banner` WHERE `title_banner` = :title_banner");
    $sth->execute(array('title_banner' => $_POST['title_banner']));
    }
}

function banner_update($pdo){

    $sth = $pdo->prepare("UPDATE banner SET link_banner = :link_banner WHERE  title_banner = :title_banner");
    $sth->execute(array('link_banner' => $_POST['link_banner'],'title_banner'=>$_POST['title_banner']));
}






// Пути загрузки файлов   
$tmp_path = '../images/tmp/';

function images_tm()
{
    global $tmp_path;

    // Массив допустимых значений типа файла
    $types = array('image/gif', 'image/png', 'image/jpeg');
    // Максимальный размер файла
    $size = 4096000;

    // Обработка запроса
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Проверяем тип файла
        if (!in_array($_FILES['picture']['type'], $types))
            die('<p>Запрещённый тип файла. <a href="?">Попробовать другой файл?</a></p>');

        // Проверяем размер файла
        if ($_FILES['picture']['size'] > $size)
            die('<p>Слишком большой размер файла. <a href="?">Попробовать другой файл?</a></p>');

        // Функция изменения размера
        // Изменяет размер изображения в зависимости от type:
        // type = 1 - эскиз
        //  type = 2 - большое изображение
        // rotate - поворот на количество градусов (желательно использовать значение 90, 180, 270)
        // quality - качество изображения (по умолчанию 75%)
        function resize($file, $type = 1, $rotate = null, $quality = null)
        {
            global $tmp_path;

            // Ограничение по ширине в пикселях
            $max_thumb_size = 200;
            $max_size = 800;

            // Качество изображения по умолчанию
            if ($quality == null)
                $quality = 100;

            // Cоздаём исходное изображение на основе исходного файла
            if ($file['type'] == 'image/jpeg')
                $source = imagecreatefromjpeg($file['tmp_name']);
            elseif ($file['type'] == 'image/png')
                $source = imagecreatefrompng($file['tmp_name']);
            elseif ($file['type'] == 'image/gif')
                $source = imagecreatefromgif($file['tmp_name']);
            else
                return false;

            // Поворачиваем изображение
            if ($rotate != null)
                $src = imagerotate($source, $rotate, 0);
            else
                $src = $source;

            // Определяем ширину и высоту изображения
            $w_src = imagesx($src);
            $h_src = imagesy($src);

            // В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
            if ($type == 1)
                $w = $max_thumb_size;
            elseif ($type == 2)
                $w = $max_size;


            // Если ширина больше заданной
            if ($w_src > $w) {
                // Вычисление пропорций
                $ratio = $w_src / $w;
                $w_dest = round($w_src / $ratio);
                $h_dest = round($h_src / $ratio);

                // Создаём пустую картинку
                $dest = imagecreatetruecolor($w_dest, $h_dest);

                // Копируем старое изображение в новое с изменением параметров
                imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

                // Вывод картинки и очистка памяти
                imagejpeg($dest, $tmp_path . $file['name'], $quality);
                imagedestroy($dest);
                imagedestroy($src);

                return $file['name'];
            } else {
                // Вывод картинки и очистка памяти
                imagejpeg($src, $tmp_path . $file['name'], $quality);
                imagedestroy($src);

                return $file['name'];
            }
        }

        $name = resize($_FILES['picture'], 2);

        $file_name = time() . '-' . mt_rand().'.'.pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

        // Загрузка файла и вывод сообщения
        if (!copy($tmp_path . $name, '../images/medium/' . $file_name)) {
            echo '<p>Что-то пошло не так.</p>';
        } else {
            $name = resize($_FILES['picture'], 1);
            copy($tmp_path . $name, '../images/thumbs/' . $file_name);
        }

        // Удаляем временный файл
        unlink($tmp_path . $name);
    }
    return $file_name;
}



function sf($str)
{
    return strip_tags(htmlspecialchars($str));
}

function clean($var)
{
    $replace = array(
        '"' => '',
        "'" => '',
        '`' => '',
        '{' => '',
        '}' => '',
        '<' => '',
        '>' => '',
        '%' => '',
        '$' => '',
        '\\' => '',
        '+' => '',
        '-' => '',
        '*' => '',
        '№' => '',
        '#' => '',
        '@' => '',
        '!' => '',
        '&' => '',
        '^' => '',
        ':' => '',
        ';' => '',
        '(' => '',
        ')' => '',
        '.' => '',
        '\0' => '',
        '%00' => ''
    );

    return @htmlspecialchars(str_replace(array_keys($replace), array_values($replace), trim($var)));
    unset($var, $replace);
}
