<?php include_once ROOT . '/views/layout/header-top.php' ?>

<section class="section-title">
  <div class="container">
    <h3 class="team-title title wow fadeInLeft" data-wow-duration="1.5s">Наша команда</h3>
  </div>
</section>

<section class="team">
  <div class="container">
    <div class="team-card__inner">
      <?php foreach ($trainers as $trainer) : ?>
        <a href="<?= $trainer['images_src']; ?>" class="team-card__item">
          <div class="team-card__item-img">
            <img src="public/images/trainer/<?= $trainer['images']; ?>" alt="<?= $trainer['images_alt']; ?>">
          </div>
          <div class="team-card__item-text">
            <h5 class="team-text__title"><?= $trainer['name']; ?></h5>
            <p class="team-text__text"><?= $trainer['description']; ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
    <a href="https://www.instagram.com/legkiifitness/?hl=ru" style="color: #000;">Ссылка на инстаграм</a>
    <div class="pagination__left button-back">
      <a onClick="history.back()">Назад</a>
    </div>
  </div>
</section>

<?php include_once ROOT . '/views/layout/footer.php' ?>