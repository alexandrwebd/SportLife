<?php include_once ROOT . '/views/layout/header-top.php' ?>

<section class="section-title">
    <div class="container">
        <h3 class="section__prices-title title wow fadeInLeft" data-wow-duration="1.5s">Наши цены</h3>
    </div>
</section>

<section class="prices">
    <div class="container">
        <h4 class="contacts-title prices__title"><?= $prices[0]['title'] ?></h4>
        <p class="prices__subtitle"><?= $prices[0]['subtitle'] ?></p>
        <div class="prices__inner">

            <?php foreach ($prices as $price) : ?>
                <div class="prices__item">
                    <div class="prices__item-header">
                        <p><?= $price['card-duration'] ?></p>
                    </div>
                    <div class="prices__item-main">
                    <?= $price['card-times'] ?>
                        <span class="prices__main-line"></span>
                        <?= $price['card-stop'] ?>
                        <span class="prices__main-line"></span>
                        <?= $price['card-services'] ?>
                        <p class="prices__main-price"><?= $price['card-prices'] ?> грн</p>
                    </div>
                    <a href="#popup-form__prices" class="prices__btn btn prices-popup"><?= $price['card-btn'] ?></a>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="pagination__left button-back">
            <a onClick="history.back()">Назад</a>
        </div>
    </div>
    <div class="prices__bg wow bounceInRight" data-wow-duration="1.5s"></div>
</section>

<form class="contacts__form contacts__form-popup popup-prices" id="popup-form__prices" method="POST">
    <h3 class="contacts-title contacts__form-title">Заказать карту</h3>
    <p class="contacts__form-subtitle">Напишите нам</p>
    <p class="text-danger" id="error_messages"></p>
    <label for="contacts__form-name" class="contacts__label contacts__label-name"></label>
    <input type="text" id="contacts__form-name" class="contacts__input contacts__input-name" placeholder="Ваше имя">
    <label for="contacts__form-email" class="contacts__label contacts__label-email"></label>
    <input type="email" id="contacts__form-email" class="contacts__input contacts__input-email" placeholder="Ваш E-mail">
    <label for="contacts__form-phone" class="contacts__label contacts__label-phone"></label>
    <input type="tel" id="contacts__form-phone" class="contacts__input contacts__input-phone" placeholder="Ваш телефон">
    <label for="contacts__form-prices" class="contacts__label contacts__label-prices"></label>
    <input type="text" list="form-prices" id="contacts__form-prices" class="contacts__input contacts__input-prices" placeholder="Выберите карту">
    <datalist id="form-prices">
        <option value="Карта на 1 месяц / 500 грн">
        <option value="Карта на 3 месяца / 1200 грн">
        <option value="Карта на 6 месяцев / 2500 грн">
        <option value="Карта на 1 год / 4000 грн">
    </datalist>
    <button type="submit" class="contacts__btn btn" id="sendOrders">Отправить</button>
</form>

<?php include_once ROOT . '/views/layout/footer.php' ?>