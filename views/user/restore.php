<?php include_once ROOT . '/views/layout/header-top.php' ?>

<div class="registration__form-wrapper">
    <form action="/restore/<?=$result['id']?>" method="POST" class="registration__form wow bounceInDown" data-wow-duration="1.5s" id="login">
        <h2 class="registration__form-title">Создание нового пароля</h2>
        <?php
        if (isset($message) && !empty($message)) :
        ?>
            <p class="text-danger"><?= $message; ?></p>
        <?php endif; ?>
        <input type="hidden" name="restore_user_id" value="<?=$result['id']?>">
        <div class="registration__form-group">
            <input type="password" class="registration__form-input" name="new_password" placeholder=" " maxlength="100" required>
            <label for="" class="registration__form-label">Введите новый пароль</label>
        </div>
        <div class="registration__form-group">
            <input type="password" class="registration__form-input" name="password" placeholder=" " maxlength="100" required>
            <label for="" class="registration__form-label">Подтвердите пароль</label>
        </div>
        <button type="submit" class="registration__form-btn btn" name="submit">Отправить</button>
        <div class="registration__redirect">
            <a href="/registration" class="registration__form-link">Регистрация</a>
            <a href="/authorization" class="registration__form-link">Вход</a>
        </div>
    </form>
</div>

<?php include_once ROOT . '/views/layout/footer.php' ?>