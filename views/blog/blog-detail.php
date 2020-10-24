<?php include_once ROOT . '/views/layout/header-top.php' ?>

<section class="section-title">
    <div class="container">
        <h3 class="blog-detail__section-title title wow fadeInLeft" data-wow-duration="1.5s">Наша блог</h3>
    </div>
</section>

<section class="blog-detail">
    <div class="container">
        <div class="blog-detail__wrapper">
            <h4 class="section-subtitle"><?= $blogs['title']; ?></h4>
            <div class="blog-text__date"><?= $blogs['date_add']; ?> <span class="view"><?= $blogs['counter']; ?></span></div>
            <div class="blog-detail__wrapper-img">
                <img class="blog-detail__img" src="/public/images/blogs/<?= $blogs['img']; ?>" alt="<?= $blogs['img_alt']; ?>">
            </div>
            <div class="blog-detail__text">
                <?= $blogs['description']; ?>
            </div>
        </div>
        <div class="pagination__left button-back">
            <a onClick="history.back()">Назад</a>
        </div>
    </div>
</section>

<?php include_once ROOT . '/views/layout/footer.php' ?>