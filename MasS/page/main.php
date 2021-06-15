<?php
if (!defined('SCRIPT_MASIA')) {
    echo ('Выявлена попытка взлома!');
    exit();
}
?>
<?
if (isset($_GET['stat']) && $_GET['stat'] <= 2) {
    $stat = $_GET['stat'];
} else {
    $stat = 2;
}
?>
<main class="main">
    <div class="container">
        <p class="adminPanel">Админ панель</p>
        <div class="content">   
            <nav class="menu menu-radius-left-rigth">
                <ul class="menu__list menu__list_flex">
                    <li><a href='<?= $admin_m ?>?page=admin_'>Новая запись</a></li>
                    <li><a href="<?= $admin_m ?>?stat=2">Новые</a></li>
                    <li><a href='<?= $admin_m ?>?stat=1'>Платят</a></li>
                    <li><a href='<?= $admin_m ?>?stat=0'>Скамы</a></li>
                    <li><a href='<?= $admin_m ?>?page=baner'>Баннер</a></li>
                </ul>
            </nav>
            <div class="content__wrap">
                <?php
                $sql = $db->Query(" SELECT m.*,r.main_id,r.descript,r.our_contr,i.img_name 
        FROM main m LEFT JOIN review r ON m.id = r.main_id 
        LEFT JOIN images i ON m.id = i.main_id
        WHERE state=?i ORDER BY id DESC LIMIT 8", $stat);
                while ($main = $db->fetch($sql)) {
                ?>
                    <?
                    if ($main['state']) {
                        $_state = 'Платит';
                    } else {
                        $_state = 'Скам';
                    } ?>
                    <section class="section">
                            <div class="block br">
                                <div class="block__title">
                                    <h3><?= $main['title'] ?></h3>
                                </div>
                                <div class="block__main">
                                    <div class="block__img">
                                        <a href="/?id=<?= $main['id'] ?>">
                                            <img src="../images/thumbs/<?= $main['img_name'] ?>" alt="" title="полное описание"></a>
                                    </div>
                                    <div class="block__desc">
                                        <p class="block__desc_title"><?= $main['descript'] ?></p>
                                    </div>
                                </div>
                                <div class="block__footer">
                                    <div class="block__fooret_state"><?= $_state ?></div>
                                    <div class="block__fooret_eye">
                                        <i class="icon-eye"><?= $main['views'] ?></i>
                                    </div>
                                </div>
                            </div>
                        </section>
                <? } ?>
            </div>
        </div>
    </div>
</main>