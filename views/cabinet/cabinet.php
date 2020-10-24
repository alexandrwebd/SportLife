<?php include_once ROOT . '/views/layout/adminHeaderTop.php' ?>

<?php
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<div class="row wrapper__admin">
    <div id="sidebar" class="column">
        <!-- <h5>Navigation</h5> -->
        <ul>
            <li><a href="/"><em class="fa fa-home"></em> Главная</a></li>
            <li><a href="/cabinet/edit"><em class="fa fa-pencil-square-o"></em>Редактировать данные</a></li>
            <li><a href="/"><em class="fa fa-warning"></em>Мой абонимент</a></li>
            <li><a href="/logout"><em class="fa fa-hand-o-up"></em>Выход</a></li>
    </div>
    <section id="main-content" class="column column-offset-20">
        <div class="row grid-responsive content__admin">
            <div class="column page-heading">
                <div class="large-card">
                    <h1>Кабинет</h1>
                    <h4>Привет <?= $_SESSION['user']['name'] ?> <?= $_SESSION['user']['surname'] ?></h4>
                    <p class="text-large">В личном кабинете вы можете изменять данные свого профиля и управлять абониментом.</p>
                    <p>Также здесь вы можете задать свой вопрос администрации клуба <em>вам с радостью помогут</em></p>
                    <a href="/cabinet/mail" class="button">Задать вопрос</a>
                </div>
            </div>
        </div>

        <?php include_once ROOT . '/views/layout/adminFooter.php' ?>
   