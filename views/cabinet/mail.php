<?php include_once ROOT . '/views/layout/adminHeaderTop.php' ?>

<?php
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<div class="row">
    <div id="sidebar" class="column">
        <!-- <h5>Navigation</h5> -->
        <ul>
            <li><a href="/"><em class="fa fa-home"></em> Главная</a></li>
            <li><a href="/cabinet/edit"><em class="fa fa-pencil-square-o"></em>Редактировать данные</a></li>
            <li><a href="/"><em class="fa fa-warning"></em>Мой абонимент</a></li>
            <li><a href="/logout"><em class="fa fa-hand-o-up"></em>Выход</a></li>
    </div>
    <section id="main-content" class="column column-offset-20">

        <!--Forms-->
        <h5 class="mt-2">Форма обратной связи</h5><a class="anchor" name="forms"></a>
        <div class="row grid-responsive content__admin">
            <div class="column ">
                <div class="card">
                    <div class="card-title">
                        <h3>Чем мы можем вам помочь?</h3>
                    </div>
                    <?php if (isset($success)) : ?>
                        <p>Спасибо, ваше сообщение успешно отправлено!</p>
                    <?php else : ?>
                        <?php
                        if (isset($error_messages) && !empty($error_messages)) :
                            foreach ($error_messages as $message) :
                        ?>
                                <p class="text-danger"><?= $message; ?></p>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    <?php endif; ?>

                    <p class="text-large">Задайте свой вопрос</p>
                    <div class="card-block">
                        <form action="/cabinet/mail" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <input type="hidden" name="form_send" value="1">
                                <!-- <label for="image">Ваше имя</label>
                                <input type="text" name="name" placeholder="Введите имя"> -->
                                <label for="image">Ваше сообщение</label>
                                <textarea name="text" placeholder="Ведите сообщение" rows="7" cols="45"></textarea>
                                <div>
                                    <input class="button-primary" type="submit" name="submit" value="Отправить">
                                </div>
                                <a style="color: #1363d1; " href="/cabinet">Назад</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once ROOT . '/views/layout/adminFooter.php' ?>