<?php include_once ROOT . '/views/layout/header-top.php' ?>

<?php
    if(isset($_SESSION['user'])){
        header('Location: /cabinet');
    }
?>

<div class="registration__form-wrapper">
    <form action="/registration" method="POST" class="registration__form wow bounceInDown" id="registration" data-wow-duration="1.5s" id="registration">
        <h2 class="registration__form-title">Регистрация</h2>
        <?php
        if (isset($error_messages) && !empty($error_messages)) :
            foreach ($error_messages as $message) :
        ?>
                <p class="text-danger"><?= $message; ?></p>
        <?php
            endforeach;
        endif;
        ?>
        <?php
            if ( isset($_SESSION['message']) && !empty($_SESSION['message']) ){
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
        <input type="hidden" name="form_send" value="1">
        <div class="registration__form-group">
            <input type="text" class="registration__form-input" name="name" value="<?= getArrVal($_POST, 'name');?>" placeholder=" ">
            <label for="" class="registration__form-label">Имя</label>
        </div>
        <div class="registration__form-group">
            <input type="text" class="registration__form-input" name="surname" value="<?= getArrVal($_POST, 'surname');?>" placeholder=" ">
            <label for="" class="registration__form-label">Фамилия</label>
        </div>
        <div class="registration__form-group">
            <input type="text" class="registration__form-input" name="login" value="<?= getArrVal($_POST, 'login');?>" placeholder=" " required>
            <label for="" class="registration__form-label">Логин</label>
        </div>
        <div class="registration__form-group">
            <input type="email" class="registration__form-input" name="email" value="<?= getArrVal($_POST, 'email');?>" placeholder=" " required>
            <label for="" class="registration__form-label">Email</label>
        </div>
        <div class="registration__form-group">
            <input type="password" class="registration__form-input" name="password" value="<?= getArrVal($_POST, 'password');?>" placeholder=" " required>
            <label for="" class="registration__form-label">Пароль</label>
        </div>
        <button type="submit" class="registration__form-btn btn" name="submit">Зарегистрироваться</button>
        <div class="registration__redirect">
            <a href="/authorization" class="registration__form-link">Вход</a>
        </div>
    </form>
</div>

<?php include_once ROOT . '/views/layout/footer.php' ?>