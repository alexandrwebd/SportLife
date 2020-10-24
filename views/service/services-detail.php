<?php include_once ROOT . '/views/layout/header-top.php' ?>

<section class="section-title">
    <div class="container">
        <h3 class="section__prices-title title wow fadeInLeft" data-wow-duration="1.5s">Наши услуги</h3>
    </div>
</section>

<section class="services-detail">
    <div class="container">
        <h4 class="section-subtitle services-detail__title"><?= $services['name']; ?></h4>
        <div class="services-detail__wrapper">
            <div class="services-detail__wrapper-text">
                <div class="services-detail__wrapper-img">
                    <img class="services-detail__img" src="/public/images/<?= $services['image']; ?>" alt="<?= $services['image_alt']; ?>">
                </div>
                <div class="services-detail__text"><?= $services['description_detail']; ?></div>
            </div>
            <div class="services-detail__group-content">
                <h4 class="services-detail__group-content-title">Детали</h4>
                <div class="services-detail__group-content-list">
                    <div class="services-detail__group-content-info">
                        <p class="services-detail__info-1">
                            Тип:
                        </p>
                        <span><?= $services['type']; ?></span>
                    </div>
                    <div class="services-detail__group-content-info">
                        <p class="services-detail__info-2">
                            Сложность:
                        </p>
                        <span><?= $services['level']; ?></span>
                    </div>
                </div>
                <a href="#popup-form" class="services-detail__btn btn popup__header-form">Записаться</a>
            </div>
        </div>
        <div class="pagination__left button-back">
            <a onClick="history.back()">Назад</a>
        </div>
    </div>
</section>

<?php include_once ROOT . '/views/layout/footer.php' ?>