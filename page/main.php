<div class="content">
    <div class="container">
    <?php
        while ($main = $db->fetch($sql)) {
            if ($main['state']) {
                $_state = 'Платит';
                $bg_state = 'bg_green';
            } else {
                $_state = 'Скам';
                $bg_state = 'bg_red';
            } ?>
            <section class="section">
                <div class="block border <?= $bg_state ?>">
                    <div class="block__title">
                        <h3><?= $main['title'] ?></h3>
                    </div>
                    <div class="block__main">
                        <div class="block__img">
                            <a href="/?page=main_&id=<?= $main['id'] ?>">
                                <img src="./img/thumbs/<?= $main['img_name'] ?>" alt="" title="полное описание"></a>
                        </div>
                        <div class="block__desc">
                            <p class="block__desc_title"><?= $main['descript'] ?></p>
                        </div>
                        <div class="block__our">
                            <p>Наш вклад: <?= $main['our_contr'] ?>$</p>
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