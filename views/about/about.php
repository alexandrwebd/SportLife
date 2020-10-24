<?php include_once ROOT . '/views/layout/header-top.php' ?>

<section class="section-title">
    <div class="container">
        <h3 class="section__about-us-title title wow fadeInLeft" data-wow-duration="1.5s">О клубе</h3>
    </div>
</section>

<section class="about-us">
    <div class="container">
        <h4 class="contacts-title about-us__title"><?= $abouts[0]['title'] ?></h4>
        <p class="about-us__subtitle"><?= $abouts[0]['subtitle'] ?></p>
        <div class="about-us__inner">
            <div class="about-us__item-text">
                <h5 class="about-us__text-title"><?= $abouts[0]['about-title'] ?></h5>
                <?= $abouts[0]['about-description'] ?>
            </div>
            <div class="about-us__item-img about-us__img-1">
                <img src="public/images/<?= $abouts[0]['about-img'] ?>.jpg" alt="<?= $abouts[0]['about-img'] ?>" class="about-img_alt">
            </div>
        </div>
        <div class="about-us__inner">
            <div class="about-us__item-img about-us__img-2">
                <img src="public/images/<?= $abouts[1]['about-img'] ?>.jpg" alt="about us" class="<?= $abouts[1]['about-img'] ?>">
            </div>
            <div class="about-us__item-text">
                <h5 class="about-us__text-title"><?= $abouts[1]['about-title'] ?></h5>
                <p class="about-us__text">
                    <?= $abouts[1]['about-description'] ?>
                </p>
                <h5 class="about-us__text-title"><?= $abouts[2]['about-title'] ?></h5>
                <p class="about-us__text">
                    <?= $abouts[2]['about-description'] ?>
                </p>
            </div>
        </div>
        <h5 class="about-us__text-title"><?= $abouts[3]['about-title'] ?></h5>
        <?= $abouts[3]['about-description'] ?>
        <form class="about-us__form" id="review-form">
            <div class="about-us__form-link">
                <p>Оствьте свой коментарий:</p>
                <a href="/prices">Узнать цену</a>
            </div>
            <textarea class="about-us__input about-us__input-textarea" id="text-review" placeholder="Ваш коментарий" rows="7" cols="45"></textarea>
            <input class="about-us__input" type="text" id="name-review" placeholder="Ваше имя" required>
            <input class="about-us__input" type="email" id="email-review" placeholder="Ваш email" required>
            <?php if (User::isAuth()) { ?>
                <button class="about-us__btn btn" type="submit" id="send-review">Добавить коментарий</button>
            <?php } else { ?>
                <button class="about-us__btn btn" type="submit" id="send-review_disabled">Добавить коментарий</button>
            <?php } ?>
            <p class="review-message_text" id="review-disabled_text"></p>
        </form>
        <div class="pagination__left button-back">
            <a onClick="history.back()">Назад</a>
        </div>
    </div>
    <div class="about-us__bg  wow bounceInRight" data-wow-duration="1.5s"></div>
</section>

<?php include_once ROOT . '/views/layout/footer.php' ?>