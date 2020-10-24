<?php include_once ROOT . '/views/layout/header-top.php'?>

<section class="section-title">
        <div class="container">
            <h3 class="section__blog-title title wow fadeInLeft" data-wow-duration="1.5s">Наш блог</h3>
        </div>
    </section>

    <section class="blog">
        <div class="container">
            <div class="blog-card__inner">
         
            <?php foreach ($result as $res) : ?>
                <div class="blog-card__item card__item">
                    <div class="blog-card__item-img">
                        <img src="/public/images/blogs/<?= $res['img']; ?>" alt="<?= $res['img_alt']; ?>">
                        <span class="detail-page"><a href="/blog-detail/<?= $res['id']; ?>" class="detail-link">Подробнее</a></span>
                    </div>
                    <div class="blog-card__item-text">
                        <h5 class="blog-text__title"><?= $res['title']; ?></h5>
                        <div class="blog-text__date"><?= $res['date_add']; ?> <span class="view"><?= $res['counter']; ?></span></div>
                    </div>
                </div>

            <?php endforeach; ?>

            </div>
            
           <?= $output; ?>
           
        </div>
    </section>

    <?php include_once ROOT . '/views/layout/footer.php'?>