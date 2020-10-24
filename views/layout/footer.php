<footer class="footer">
  <div class="container">
    <div class="footer__wrapper">
      <div class="footer__info">
        <div class="footer__info-logo">
          <a class="logo__link" href="#">
            <img class="logo__img" src="/public/images/footer-logo.png" alt="SportLife">
          </a>
        </div>
        <p class="footer__info-text">
          Фитнес клуб премиум класса, расположен
          в самом центре Чернигова по адресу
          ул. Пятницкая 72, рядом с ТРЦ “Мегацентр”,
          общая площадь 2500 м2.
        </p>
        <div class="footer__info-social">
          Мы в соцсетях:
          <a href="https://www.facebook.com/4aechka/" class="footer__social-facebook footer-social"></a>
          <a href="#" class="footer__social-instagram footer-social"></a>
          <a href="#" class="footer__social-telegram footer-social"></a>
          <a href="#" class="footer__social-viber footer-social"></a>
        </div>
        <form class="footer__info-form" id="form-mailing" method="POST">
          <label for="footer-form" class="footer__form-label" id="footer-message">Подпишитесь на разсылку</label>
          <div class="footer__form-group">
            <input type="email" class="footer-form" id="footer-form" placeholder="Введите Email..." required>
            <button type="submit" class="footer-btn" id="btn-mailing">Подписаться</button>
          </div>
        </form>
      </div>
      <div class="footer__blog">
        <h5 class="footer__blog-title">Блоги</h5>
        <div class="footer__blog-inner">

          <?php foreach ($footer_blogs as $footer_blog) : ?>
            <a href="/blog-detail/<?= $footer_blog['id']; ?>" class="footer__blog-item">
              <div class="footer__blog-img">
                <img src="/public/images/blogs/<?= $footer_blog['img']; ?>" alt="<?= $footer_blog['img_alt']; ?>">
              </div>
              <p class="footer__blog-text">
                <?= $footer_blog['title']; ?>
              </p>
            </a>
          <?php endforeach; ?>

        </div>
      </div>
      <div class="footer__instagram">
        <h5 class="footer__instagram-title">Instagram</h5>
        <div class="zoom-gallery footer__instagram-inner">

          <?php foreach ($footer_images as $footer_image) : ?>
            <a href="/public/images/gallery/<?= $footer_image['images']; ?>" class="footer__instagram-item">
              <img src="/public/images/gallery/<?= $footer_image['images']; ?>" alt="<?= $footer_image['images_alt']; ?>">
            </a>
          <?php endforeach; ?>

        </div>
        <a href="/gallery" class="footer__instagram-subtitle"> Много красивых фотографий</a>
      </div>
    </div>
    <p class="footer-copyright wow fadeInUp">&copy; Фитнес-клуб "<a class="footer-link" href="https://sport-life.fun">SportLife</a>", 2020</p>
  </div>
</footer>

<form class="contacts__form contacts__form-popup" id="popup-form" method="POST">
  <h3 class="contacts-title contacts__form-title">Узнать цену</h3>
  <p class="contacts__form-subtitle">Напишите нам</p>
  <p class="text-danger" id="error_messages"></p>
  <input type="hidden" name="form_send" value="1">
  <label for="contacts__form-name" class="contacts__label contacts__label-name"></label>
  <input type="text" id="contacts__form-name" class="contacts__input contacts__input-name" placeholder="Ваше имя">
  <label for="contacts__form-email" class="contacts__label contacts__label-email"></label>
  <input type="email" id="contacts__form-email" class="contacts__input contacts__input-email" placeholder="Ваш E-mail" required>
  <label for="contacts__form-phone" class="contacts__label contacts__label-phone"></label>
  <input type="tel" id="contacts__form-phone" class="contacts__input contacts__input-phone" placeholder="Ваш телефон" required>
  <button class="contacts__btn btn" id="sendContacts">Отправить</button>
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
<?php if (isset($page)  == 'gallery') {
  echo '<script src="/public/js/app.js"></script>';
  echo '<script src="/public/js/pagination.js"></script>';
} ?>
<?php if (isset($page) == 'main') {
  echo '<script src="/public/js/training-time.js"></script>';
} ?>
<script src="/public/js/libs.min.js"></script>
<script src="/public/js/form.js"></script>
<script src="/public/js/main.js"></script>
</body>

</html>