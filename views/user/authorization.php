<?php include_once ROOT . '/views/layout/header-top.php' ?>

<?php
    if(isset($_SESSION['user'])){
        header('Location: /cabinet');
    }
?>

<div class="registration__form-wrapper">
    <form action="/authorization" method="POST" class="registration__form wow bounceInDown" id="authorization" data-wow-duration="1.5s" id="login">
        <h2 class="registration__form-title">Вход</h2>
        <?php
        if (isset($error_messages) && !empty($error_messages)) :
            foreach ($error_messages as $message) :
        ?>
                <p class="text-danger"><?= $message; ?></p>
        <?php
            endforeach;
        endif;
        ?>
        <?php if(isset($msg) && !empty($msg)) : ?>
            <p class="text-danger"><?= $msg; ?></p>
        <?php
        endif;
        ?>
        <input type="hidden" name="form_send" value="1">
        <div class="registration__form-group">
            <input type="text" class="registration__form-input" name="login" value="<?= getArrVal($_POST, 'login');?>" placeholder=" ">
            <label for="" class="registration__form-label">Логин</label>
        </div>
        <div class="registration__form-group">
            <input type="password" class="registration__form-input" name="password" value="<?= getArrVal($_POST, 'password');?>" placeholder=" ">
            <label for="" class="registration__form-label">Пароль</label>
        </div>
        <button type="submit" class="registration__form-btn btn" name="submit">Войти</button>
        <div class="registration__redirect">
            <a href="/recover" class="registration__form-link">Забыли пароль?</a>
            <a href="/registration" class="registration__form-link">Регистрация</a>
        </div>
    </form>
</div>

<?php include_once ROOT . '/views/layout/footer.php' ?>