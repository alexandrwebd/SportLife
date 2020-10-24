<?php include_once ROOT . '/views/layout/adminHeader.php' ?>

<section id="main-content" class="column column-offset-20">

    <h5 class="mt-2">Главная страница</h5><a class="anchor" name="forms"></a>
    <div class="row grid-responsive content__admin">
        <div class="column">
            <?php
            if (isset($error_messages) && !empty($error_messages)) :
                foreach ($error_messages as $message) :
            ?>
                    <p class="text-danger"><?= $message; ?></p>
            <?php
                endforeach;
            endif;
            ?>
            <div class="card">
                <div class="card-title">
                    <h3>Изменить заголовок шапки сайта</h3>
                </div>
                <div class="card-block">

                    <form action="/admin/main-page/edit-<?= $main_page['id'] ?>" method="POST">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainTitleAdd">
                            <label for="nameField">Главный заголовок:</label>
                            <textarea rows="10" cols="45" name="main-title" placeholder="Добавьте главный заголовок"><?= $main_page['call_to_action_h1']; ?></textarea>
                            <label for="text">Подзаголовок:</label>
                            <textarea rows="10" cols="45" name="main-subtitle" placeholder="Добавьте подзаголовок"><?= $main_page['call_to_action_h3']; ?></textarea>
                            <div>
                                <input class="button-primary" type="submit" name="submitMainTitle" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <h3>Изменить секцию о нас</h3>
                </div>
                <div class="card-block">
                    <form action="/admin/main-page/edit-<?= $main_page['id'] ?>" method="POST">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainAboutAdd">
                            <label for="nameField">Изменить заголовок:</label>
                            <textarea rows="10" cols="45" name="main_about_title" placeholder="Добавьте главный заголовок"><?= $main_page['main_about_title']; ?></textarea>
                            <label for="text">Изменить подзаголовок:</label>
                            <textarea rows="10" cols="45" name="main_about_subtitle" placeholder="Добавьте подзаголовок"><?= $main_page['main_about_subtitle']; ?></textarea>
                            <label for="text">Изменить описание:</label>
                            <textarea rows="10" cols="45" name="main_about_description" placeholder="Добавьте описание"><?= $main_page['main_about_description']; ?></textarea>
                            <div>
                                <input class="button-primary" type="submit" name="submitMainAbout" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <h3>Изменить секцию преимущества</h3>
                </div>
                <div class="card-block">
                    <form action="/admin/main-page/edit-<?= $main_page['id'] ?>" method="POST">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainAdvantagesAdd">
                            <label for="nameField">Преимущество 1:</label>
                            <textarea rows="10" cols="45" name="main_advantages-1" placeholder="Добавьте преимущество"><?= $main_advantages[0]['advantages']; ?></textarea>
                            <label for="text">Преимущество 2:</label>
                            <textarea rows="10" cols="45" name="main_advantages-2" placeholder="Добавьте преимущество"><?= $main_advantages[1]['advantages']; ?></textarea>
                            <label for="text">Преимущество 3:</label>
                            <textarea rows="10" cols="45" name="main_advantages-3" placeholder="Добавьте преимущество"><?= $main_advantages[2]['advantages']; ?></textarea>
                            <label for="text">Преимущество 4:</label>
                            <textarea rows="10" cols="45" name="main_advantages-4" placeholder="Добавьте преимущество"><?= $main_advantages[3]['advantages']; ?></textarea>
                            <div>
                                <input class="button-primary" type="submit" name="submitMainAdvantages" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <h3>Изменить заголовок секции услуги</h3>
                </div>
                <div class="card-block">

                    <form action="/admin/main-page/edit-<?= $main_page['id'] ?>" method="POST">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainServicesAdd">
                            <label for="nameField">Изменить заголовок:</label>
                            <textarea rows="10" cols="45" name="main_services-title" placeholder="Добавьте заголовок"><?= $main_page['services_title']; ?></textarea>
                            <label for="text">Изменить подзаголовок:</label>
                            <textarea rows="10" cols="45" name="main_services-description" placeholder="Добавьте подзаголовок"><?= $main_page['services_description']; ?></textarea>
                            <div>
                                <input class="button-primary" type="submit" name="submitMainServices" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <h3>Изменить заголовок и фото секции треннер</h3>
                </div>
                <div class="card-block">

                    <form action="/admin/main-page/edit-<?= $main_page['id'] ?>" method="POST"  enctype="multipart/form-data">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainTrainerAdd">
                            <label for="nameField">Изменить заголовок:</label>
                            <textarea rows="10" cols="45" name="trainer_title" placeholder="Добавьте заголовок"><?= $main_page['trainer_title']; ?></textarea>
                            <label for="image">Изображение:</label>
                            <img src="<?= Main::getImage($main_page['trainer_images']); ?>" width="100px" alt="">
                            <input type="file" name="trainer_images" placeholder="Добавьте изображение" <?= $main_page['trainer_images']; ?>>
                            <div>
                                <input class="button-primary" type="submit" name="submitMainTrainer" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <h3>Изменить расписание тренеровок</h3>
                </div>
                <div class="card-block">

                    <form action="/admin/main-page/edit-<?= $main_page['id'] ?>" method="POST">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainScheduleAdd">
                            <label for="nameField">Изменить заголовок:</label>
                            <textarea rows="10" cols="45" name="schedule_title" placeholder="Добавьте заголовок"><?= $main_page['schedule_title']; ?></textarea>
                            <div>
                                <input class="button-primary" type="submit" name="submitMainSchedule" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <h3>Изменить заголовок секции отзывы</h3>
                </div>
                <div class="card-block">

                    <form action="/admin/main-page/edit-<?= $main_page['id'] ?>" method="POST">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainReviewsAdd">
                            <label for="nameField">Изменить заголовок:</label>
                            <textarea rows="10" cols="45" name="reviews_title" placeholder="Добавьте заголовок"><?= $main_page['reviews_title']; ?></textarea>
                            <div>
                                <input class="button-primary" type="submit" name="submitMainReviews" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <h3>Изменить секцию коммуникация</h3>
                </div>
                <div class="card-block">
                    <form action="/admin/main-page/edit-<?= $main_page['id'] ?>" method="POST"  enctype="multipart/form-data">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainСommunicationAdd">
                            <label for="nameField">Изменить заголовок формы:</label>
                            <textarea rows="10" cols="45" name="baner_form_title" placeholder="Добавьте заголовок"><?= $main_page['baner_form_title']; ?></textarea>
                            <label for="nameField">Изменить подзаголовок:</label>
                            <textarea rows="10" cols="45" name="baner_form_subtitle" placeholder="Добавьте заголовок"><?= $main_page['baner_form_subtitle']; ?></textarea>
                            <label for="image">Изменить изображение:</label>
                            <img src="<?= Main::getImage($main_page['baner_form_images']); ?>" width="100px" alt="">
                            <input type="file" name="baner_form_images" placeholder="Добавьте изображение" <?= $main_page['baner_form_images']; ?>>
                            <label for="nameField">Изменить заголовок контактов:</label>
                            <textarea rows="10" cols="45" name="contacts_form_phone" placeholder="Добавьте заголовок"><?= $main_page['contacts_form_phone']; ?></textarea>
                            <label for="nameField">Изменить подзаголовок:</label>
                            <textarea rows="10" cols="45" name="contacts_form_subtitle" placeholder="Добавьте заголовок"><?= $main_page['contacts_form_subtitle']; ?></textarea>
                            <label for="image">Изменить изображение:</label>
                            <img src="<?= Main::getImage($main_page['contacts_form_images']); ?>" width="100px" alt="">
                            <input type="file" name="contacts_form_images" placeholder="Добавьте изображение" <?= $main_page['contacts_form_images']; ?>>
                            <div>
                                <input class="button-primary" type="submit" name="submitMainСommunication" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <a href="/admin/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Назад</a>
    <?php include_once ROOT . '/views/layout/adminFooter.php' ?>