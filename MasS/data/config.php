<?php
$host = 'localhost'; //хост базы данных
$db = 'test1'; // Имя базы данных
$user = 'root'; // Логин пользователя от базы данных
$pass = ''; // Пароль от базы данных
$charset = 'UTF8';//Кодировка файлов
$admin_m = '/MasS';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC );

$pdo = new PDO($dsn, $user, $pass, $opt);
$pdo->exec("set names utf8");
$db = new SafeMySQL(array('user' => $user, 'pass' => $pass, 'db' => $db, 'charset' => 'utf8'));

//НАСТРОЙКА ПРОЕКТА
$ssl_connect="http";//Ваше соединение http или https (Для реф ссылок и баннера)
$itworks=1; //Режим работы сайта. 1 - сайт работает, 0 - регистрация закрыта
$sitename="Masia"; //Название проекта
$adminmail="hyip.std@gmail.com"; //Почта администрации
$vkgrup="https://vk.com/hyip_studio"; //Вк группа
$telega="#"; //Телеграм
$str_otziv="https://vk.com/topic-174979789_39410637"; //Ссылка на страницу с отзывами
$datastarta='January 11, 2019'; //Дата старта (Писать строго в этом формате)
$banner="/hs468.png"; //Ссылка на баннер проекта
$koshelek_admina=''; //Кошелек админа (Сюда будут капать админские)
$adminsecretcode='111'; //Пароль от админки (Менять обязательно)

?>
