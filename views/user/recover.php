<?php include_once ROOT . '/views/layout/header-top.php' ?>

<div class="registration__form-wrapper">
    <form action="/recover" method="POST" class="registration__form wow bounceInDown" id="recover" data-wow-duration="1.5s" id="login">
        <h2 class="registration__form-title">Востановление пароля</h2>
        <?php
        if (isset($message) && !empty($message)) :
        ?>
            <p class="text-danger"><?= $message; ?></p>
        <?php endif; ?>
        <input type="hidden" name="form_send" value="1">
        <div class="registration__form-group">
            <input type="email" class="registration__form-input" name="email" placeholder=" " maxlength="100" required>
            <label for="" class="registration__form-label">Введите свой email</label>
        </div>
        <button type="submit" class="registration__form-btn btn" name="submit">Отправить</button>
        <div class="registration__redirect">
            <a href="/registration" class="registration__form-link">Регистрация</a>
        </div>
    </form>
</div>

<?php include_once ROOT . '/views/layout/footer.php' ?>