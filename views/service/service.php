<?php include_once ROOT . '/views/layout/header-top.php' ?>

<section class="section-title">
    <div class="container">
        <h3 class="section__prices-title title wow fadeInLeft" data-wow-duration="1.5s">Наши услуги</h3>
    </div>
</section>

<section class="service">
    <div class="container">
        <h4 class="contacts-title service__title"><?= $services[0]['title'] ?></h4>
        <p class="service__subtitle"><?= $services[0]['subtitle'] ?></p>
        <div class="service__inner">
            <?php foreach ($services as $service) : ?>
                <div class="service__item">
                    <div class="service__item-img">
                        <img src="/public/images/<?= $service['image']; ?>" alt="<?= $service['image_alt']; ?>">
                        <span class="service__img--active detail-page"><a href="/services-detail/<?= $service['id']; ?>" class="detail-link">Подробнее</a></span>
                    </div>
                    <div class="service__item-text">
                        <h5 class="service-text__title"><?= $service['name']; ?></h5>
                        <p class="service-text__text"><?= $service['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination__left button-back">
            <a onClick="history.back()">Назад</a>
        </div>
    </div>
</section>

<?php include_once ROOT . '/views/layout/footer.php' ?>