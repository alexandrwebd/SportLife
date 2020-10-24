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
        <h5 class="mt-2">Данные пользователя</h5><a class="anchor" name="forms"></a>
        <div class="row grid-responsive content__admin">
            <div class="column ">
                <div class="card">
                    <div class="card-title">
                        <h3>Редактирование данных</h3>
                    </div>
                    <?php if (isset($error_messages) && empty($error_messages)) : ?>
                        <p>Данные отредактированы!</p>
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

                    <p class="text-large">Добавьте изображение профиля</p>
                    <div class="card-block">
                        <form action="/cabinet/add" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <input type="hidden" name="form_send" value="1">
                                <label for="image">Добавить изображение:</label>
								<input type="file" name="image" placeholder="Изменить зображение">
                                <div>
                                    <div class="float-right">
                                        <input type="checkbox" id="confirmField">
                                        <label class="label-inline" for="confirmField">Сделать копию</label>
                                    </div>
                                    <input class="button-primary" type="submit" name="submit" value="Добавить">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <p class="text-large">Отредактировать данные профиля</p>
                    <div class="card-block">
                        <form action="/cabinet/edit" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <input type="hidden" name="form_send" value="1">
                                <label for="nameField">Логин:</label>
                                <input type="text" name="login" id="nameField" value="<?= $login; ?>">
                                <label for="nameField">Пароль:</label>
                                <input type="password" name="password" id="nameField" value="<?= $password; ?>">
                                <label for="image">Изменить зображение профиля:</label>
                                <img src="<?= User::getImage($userId); ?>" width="100px" alt="">
								<input type="file" name="image" placeholder="Изменить зображение">
                                <div>
                                    <div class="float-right">
                                        <input type="checkbox" id="confirmField">
                                        <label class="label-inline" for="confirmField">Сделать копию</label>
                                    </div>
                                    <input class="button-primary" type="submit" name="submit" value="Сохранить">
                                </div>
                                <a style="color: #1363d1; " href="/cabinet">Назад</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once ROOT . '/views/layout/adminFooter.php' ?>