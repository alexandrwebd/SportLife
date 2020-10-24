<?php include_once ROOT . '/views/layout/header-top.php' ?>

<section class="section-title">
    <div class="container">
        <h3 class="section__contacts-title title wow fadeInLeft" data-wow-duration="1.5s">Наши контакты</h3>
    </div>
</section>

<section class="contacts">
    <div class="container">
        <h4 class="contacts-title contacts__phone"><?= $contacts['title-phone'] ?> <a class="contacts-link" href="tel:+380937459712"><?= $contacts['phone'] ?></a></h4>
        <h4 class="contacts-title contacts__email"><?= $contacts['title-email'] ?> <a class="contacts-link" href="mailto:sportlife.best@gmail.com"><?= $contacts['email'] ?></a></h4>
        <form class="contacts__form" id="popup-form">
            <h3 class="contacts-title contacts__form-title">Узнать цену</h3>
            <p class="contacts__form-subtitle">Напишите нам</p>
            <p class="text-danger" id="error_messages"></p>
            <label for="contacts__form-name" class="contacts__label contacts__label-name"></label>
            <input type="text" id="contacts__form-name" class="contacts__input contacts__input-name" placeholder="Ваше имя">
            <label for="contacts__form-email" class="contacts__label contacts__label-email"></label>
            <input type="email" id="contacts__form-email" class="contacts__input contacts__input-email" placeholder="Ваш E-mail" required>
            <label for="contacts__form-phone" class="contacts__label contacts__label-phone"></label>
            <input type="tel" id="contacts__form-phone" class="contacts__input contacts__input-phone" placeholder="Ваш телефон" required>
            <button type="submit" class="contacts__btn btn" id="sendContacts">Отправить</button>
        </form>
        <h4 class="contacts-title contacts__map-title"><?= $contacts['contacts-title'] ?></h4>
        <p class="contacts__map-adres"><?= $contacts['contacts-subtitle'] ?></p>
        <div class="contacts__map-frame">
            <iframe class="contacts__frame" src="<?= $contacts['contacts-map'] ?> ">
            </iframe>
        </div>
        <div class="pagination__left button-back">
            <a onClick="history.back()">Назад</a>
        </div>
    </div>
</section>

<?php include_once ROOT . '/views/layout/footer.php' ?>