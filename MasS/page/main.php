<?php
if (!defined('SCRIPT_MASIA')) {
    echo ('Выявлена попытка взлома!');
    exit();
}
?>
<?
if (isset($_GET['st']) && $_GET['st'] <= 2) {
    $stat = $_GET['st'] * 1;
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
                    <li><a href='<?= $admin_m ?>?id=0'>Новая запись</a></li>
                    <li><a href="<?= $admin_m ?>?st=2">Хайпы</a></li>
                    <li><a href='<?= $admin_m ?>?st=1'>Игры</a></li>
                    <li><a href='<?= $admin_m ?>?st=0'>Скамы</a></li>
                    <li><a href='<?= $admin_m ?>?page=banner'>Баннер</a></li>
                </ul>
            </nav>
            <div class="content__wrap">
            <? if (!isset($id)) { ?>
                <?php while ($main = $db->fetch($sql)) {?>
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
                                        <a href="<?= $admin_m ?>/?id=<?= $main['id'] ?>">
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
                <? } 
            } else {?>

<? 
        if (isset($_GET['id']) && $id != 0) {
            $id = $_GET['id']*1;
            $main = $pdo->Query("SELECT m.*,r.* FROM main m JOIN review r ON m.id = r.main_id WHERE m.id = " . $id . "")->fetch();
        }
        ?>
        <form id="data" method="POST" enctype="multipart/form-data">
            <input form="data" type="hidden" name="id" value="<?= $main['main_id'] ?>">
            <section class="admin_review">
                <div class="admin_review__item">
                    <div class="admin_review__title mb10">
                        <fieldset form="data" title="Введите название проэкта и реф. ссылку">
                            <legend>Введите название проэкта и реф. ссылку</legend>
                            <label>Название
                                <input type="text" name="title" value="<?= $main['title'] ?>">
                            </label>
                            <label>Ссылка на проект
                                <input type="text" name="title_link" value="<?= $main['title_link'] ?>">
                            </label>
                        </fieldset>
                    </div>
<?if(!$id){?>
                    <div class="admin_review__img mb10">
                        <fieldset form="data" title="скрин сайта">
                            <legend>Выберите скрин сайта</legend>
                            <input style="width: 100%;" type="file" name="picture">
                            <p style="color: red;font-size: 1.2rem;text-align: center;margin-top: 10px;">Скин сайта, после загрузки, изменить нельзя !!!</p>
                        </fieldset>
                    </div>
<?}?>
                    <div class="admin_review__state_state mb10">
                        <fieldset form="data" title="статус сайта">
                            <legend>Выберите статус сайта</legend>
                            <label style="justify-content: space-around;">
                                <? if ($main['state'] == '2') { ?>
                                    <p><input type="radio" name="state" checked value="2">Новый</p>
                                    <p><input type="radio" name="state" value="1">Платит</p>
                                    <p><input type="radio" name="state" value="0">Скам</p>
                                <? } elseif ($main['state'] == '1') { ?>
                                    <p><input type="radio" name="state" value="2">Новый</p>
                                    <p><input type="radio" name="state" checked value="1">Платит</p>
                                    <p><input type="radio" name="state" value="0">Скам</p>
                                <? } elseif ($main['state'] == '0') { ?>
                                    <p><input type="radio" name="state" value="2">Новый</p>
                                    <p><input type="radio" name="state" value="1">Платит</p>
                                    <p><input type="radio" name="state" checked value="0">Скам</p>
                                <? }else{ ?>
                                    <p><input type="radio" name="state" value="2">Новый</p>
                                    <p><input type="radio" name="state" value="1">Платит</p>
                                    <p><input type="radio" name="state" value="0">Скам</p>
                                <?}?>
                            </label>
                        </fieldset>
                    </div>
                    <div class="admin_review__state_data mb10">
                        <fieldset form="data" title="дата старта">
                            <legend>Выберите дату старта сайта</legend>
                            <label>Дата старта:
                                <input type="date" name="date" value="<?= $main['date'] ?>">
                            </label>
                        </fieldset>
                    </div>
                    <div class="admin_review__tariff mb10">
                        <fieldset form="data" title="тарифные планны">
                            <legend>Напишите тарифные планны сайта</legend>
                            <label>Тарифные планны:
                                <textarea wrap="soft" name="tariff_plans"><?= $main['tariff_plans'] ?></textarea>
                            </label>
                        </fieldset>
                    </div>
                    <fieldset form="data" title="минимальный вклад">
                        <legend>Введите минимальный вклад на сайте</legend>
                        <label class="mb10">Минимальный вклад:
                            <input type="number" name="min" value="<?= $main['min'] ?>">
                            $
                        </label>
                    </fieldset>
                    <fieldset form="data" title="реферальная программа">
                        <legend>Напишите реферальную программу на сайте</legend>
                        <label class="mb10">Реферальная программа:
                            <textarea wrap="soft" type="text" name="referral_plans"><?= $main['referral_plans'] ?></textarea>
                        </label>
                    </fieldset>
                    <fieldset form="data" title="платежные системы">
                        <legend>Выберите платежные системы на сайте</legend>
                        <label class="mb10">платежные системы:
                            <input type="text" name="payment_sys" value="<?= $main['payment_sys'] ?>">
                        </label>
                    </fieldset>
                    <fieldset form="data" title="тип выплат сайта">
                        <legend>Напишите тип выплат на сайте</legend>
                        <label class="mb10">тип выплат:
                            <input placeholder="вручную" type="text" name="type_of_pay" value="<?= $main['type_of_pay'] ?>">
                        </label>
                    </fieldset>
                    <div class="review__about">
                        <fieldset form="data" title="описание сайта">
                            <legend>Напишите описание сайте</legend>
                            <label>Описание:
                                <textarea wrap="soft" name="descript"><?= $main['descript'] ?></textarea>
                            </label>
                        </fieldset>
                    </div>
                    <fieldset form="data" title="Наш вклад на сайте">
                        <legend>Напишите наш вклад на сайте</legend>
                        <label class="mb10">Наш вклад:
                            <input type="number" name="our_contr" value="<?= $main['our_contr'] ?>">$
                        </label>
                    </fieldset>
                </div>
           
            </section>


            <div class="admin_review__button">
                <? if ($id != 0) { ?>
                    <button form="data" name="button_data" value="delete" type="submit">Удалить запись</button>
                    <button form="data" name="button_data" value="update" type="submit">Обновить запись</button>
                <? } else { ?>
                    <button form="data" name="button_data" value="newdate" type="submit">Новая запись</button>
                <? } ?>
            </div>




        </form>



            <?}?>
            </div>
        </div>
    </div>
</main>