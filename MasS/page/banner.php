<?php
if (!defined('SCRIPT_MASIA')) {
    echo ('Выявлена попытка взлома!');
    exit();
}
?>
<? $sql2 = $db->Query("SELECT * FROM banner LIMIT 2"); ?>
<main class="main">
    <div class="container">
        <p class="adminPanel">Админ панель</p>
        <div class="content">
            <nav class="menu menu-radius-left-rigth">
                <ul class="menu__list menu__list_flex">
                    <li><a href='<?= $admin_m ?>?id=0'>Новая запись</a></li>
                    <li><a href="<?= $admin_m ?>?st=2">Хайпы</a></li>
                    <li><a href='<?= $admin_m ?>?st=1'>Игры</a></li>
                    <li><a href='<?= $admin_m ?>?st=0'>Скамы</a></li>
                    <li><a href='<?= $admin_m ?>?page=banner'>Баннер</a></li>
                </ul>
            </nav>
            <div class="content__wrap">
                <?
                while ($banner = $db->fetch($sql2)) {
                    $show = 'disabled';
                    $button_show = 'enabled';
                ?>
                    <form id="banner_data" action="<?= $admin_m ?>?page=admin" method="POST" enctype="multipart/form-data">
                        <section class="admin_review">
                            <div class="admin_review__item">

                                <div class="admin_review__img mb10">
                                    <fieldset form="banner_data" title="рекламный банер">
                                        <input type="hidden" name="title_banner" value="<?= $banner['title_banner'] ?>">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                                        <legend>Выберите баннер GIF</legend>
                                        <input <?= $show ?> style="width: 100%;" type="file" name="banner">
                                        <label>Ссылка на рекламный проект
                                            <input placeholder="http://www" type="text" name="link_banner" value="<?= $banner['link_banner'] ?>">
                                        </label>
                                    </fieldset>
                                </div>
                            </div>

                        </section>



                        <div class="admin_review__button">

                            <button <?= $button_show ?> form="banner_data" name="banner_data" value="delete" type="submit">Удалить запись</button>
                            <button <?= $button_show ?> form="banner_data" name="banner_data" value="update" type="submit">Обновить запись</button>

                            <button <?= $show ?> form="banner_data" name="banner_data" value="newdate" type="submit">Новая запись</button>

                        </div>




                    </form>
                <? }
                $show = 'enabled';
                $button_show = 'disabled';
                ?>
            </div>
        </div>
    </div>
</main>