<?php
if (!defined('SCRIPT_MASIA')) {
    echo ('Выявлена попытка взлома!');
    exit();
} ?>
<main class="main">
    <div class="container">
        <div class="content">
            <nav class="menu menu-radius-left-rigth">
                <ul class="menu__list menu__list_flex">
                    <li><a href="/?st=2">Хайпы</a></li>
                    <li><a href="/?st=1">Игры</a></li>
                    <li><a href="/?st=0">Скамы</a></li>
                </ul>
            </nav>
            <div class="content__wrap">
                <?
                if (!isset($id)) {
                ?>
                    <?php
                    while ($main = $db->fetch($sql)) {
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
                                            <img src="./images/thumbs/<?= $main['img_name'] ?>" alt="" title="полное описание"></a>
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
                } else { ?>
                    <?
                    $statement = $pdo->prepare("SELECT m.title,m.title_link,m.state,m.views,r.*,i.img_name 
                    FROM main m LEFT JOIN review r ON m.id = r.main_id
                    LEFT JOIN images i ON m.id = i.main_id
                    WHERE m.id = :id LIMIT 1");
                    $statement->execute(array('id' => $id));
                    $main = $statement->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <?
                    $sth = $pdo->prepare("UPDATE `main` SET `views` = :view WHERE `id` = :id");
                    $sth->execute(array('view' => $main['views'] + 1, 'id' => $id));
                    ?>
                    <section class="review">
                        <div class="review__item">
                            <div class="review__title">
                                <h1 title="перейти на проект"><a href="<?= $main['title_link'] ?>" target="_blank" rel="noopener"><?= $main['title'] ?></a></h1>
                            </div>
                            <hr>
                            <div class="review__img">
                                <a href="<?= $main['title_link'] ?>" target="_blank" rel="noopener">
                                    <img src="./images/medium/<?= $main['img_name'] ?>" alt="<?= $main['title'] ?>">
                                </a>
                            </div>
                            <div class="review__state">
                                <div class="review__state_state">
                                    <p>статус: <span class="<?= $color ?>"><?= $state ?></span></p>
                                </div>
                                <div class="review__state_data">
                                    <p>Дата старта: <span> <?= date('d.m.Y', strtotime($main['date'])) ?></span> </p>
                                </div>
                            </div>
                            <hr>
                            <div class="review__tariff">
                                <h3>Тарифные планны:</h3>
                                <div class="review__tariff_box">
                                    <i>
                                        <pre><?= $main['tariff_plans'] ?></pre>
                                    </i>
                                </div>
                            </div>
                            <hr>
                            <div class="review__quote">
                                <section class="descript">
                                    <div class="descript__title">
                                        <p>мин.вклад:</p>
                                    </div>
                                    <div class="descript__item">
                                        <span class="font_weig_normal color_red">
                                            <pre><?= $main['min'] ?>$</pre>
                                        </span>
                                    </div>
                                </section>
                                <hr>
                                <section class="descript">
                                    <div class="descript__title">
                                        <p>реф.программа:</p>
                                    </div>
                                    <div class="descript__item">
                                        <span class="font_weig_normal color_red">
                                            <pre><?= $main['referral_plans'] ?></pre>
                                        </span>
                                    </div>
                                </section>
                                <hr>
                                <section class="descript">
                                    <div class="descript__title">
                                        <p>платежные системы: </p>
                                    </div>
                                    <div class="descript__item">
                                        <span class="font_weig_normal">
                                            <pre><?= $main['payment_sys'] ?></pre>
                                        </span>
                                    </div>
                                </section>
                                <hr>
                                <section class="descript">
                                    <div class="descript__title">
                                        <p>тип выплат:</p>
                                    </div>
                                    <div class="descript__item">
                                        <span class="font_weig_normal color_red"><?= $main['type_of_pay'] ?></span>
                                    </div>
                                </section>
                            </div>
                            <hr>
                            <div class="review__about">
                                <section class="descript">
                                    <div class="descript__title">
                                        <h3>О проекте:</h3>
                                    </div>
                                    <div class="descript__item">
                                        <i>
                                            <pre><?= $main['descript'] ?></pre>
                                        </i>
                                    </div>
                            </div>
                            <hr>
                            <div class="review__our">
                                <p>Наш вклад: <?= $main['our_contr'] ?>$</p>
                            </div>
                            <hr>
                            <div class="project-link">
                                <h1 title="перейти на проект"><a href="<?= $main['title_link'] ?>" target="_blank" rel="noopener">посмотреть / инвестировать</a></h1>
                            </div>
                        </div>
                    </section>
                <? } ?>
            </div>
        </div>
    </div>
</main>