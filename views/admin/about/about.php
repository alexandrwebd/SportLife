<?php include_once ROOT . '/views/layout/adminHeader.php' ?>

<section id="main-content" class="column column-offset-20">

    <h5 class="mt-2">Страница О Нас</h5><a class="anchor" name="forms"></a>
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
                    <h3>Изменить страницу</h3>
                </div>
               
                <div class="card-block">
                    <form action="/admin/about/edit-<?= $abouts[0]['id'] ?>" method="POST"  enctype="multipart/form-data">
                        <fieldset>
                            <input type="hidden" name="formSend" value="mainAboutAdd">
                            
                            <label for="nameField">Изменить заголовок страницы:</label>
                            <textarea rows="10" cols="45" name="title" placeholder="Добавьте заголовок"><?= $abouts[0]['title']; ?></textarea>
                            <label for="nameField">Изменить подзаголовок страницы:</label>
                            <textarea rows="10" cols="45" name="subtitle" placeholder="Добавьте заголовок"><?= $abouts[0]['subtitle']; ?></textarea>
                           
                            <label for="nameField">Изменить параграф:</label>
                            <textarea rows="10" cols="45" name="about-title" placeholder="Добавьте заголовок"><?= $abouts[0]['about-title']; ?></textarea>
                            <label for="nameField">Изменить описание параграфа:</label>
                            <textarea rows="10" cols="45" name="about-description" placeholder="Добавьте заголовок"><?= $abouts[0]['about-description']; ?></textarea>
                           
                            <label for="image">Изменить изображение:</label>
                            <img src="<?= About::getImage($abouts[0]['about-img']); ?>" width="100px" alt="">
                            <input type="file" name="about-img" placeholder="Добавьте изображение" <?= $abouts[0]['about-img']; ?>>
                            <label for="nameField">Изменить alt изображения:</label>
                            <textarea rows="10" cols="45" name="about-img_alt" placeholder="Добавьте заголовок"><?= $abouts[0]['about-img_alt']; ?></textarea>

                            <label for="nameField">Изменить заголовок параграфа:</label>
                            <textarea rows="10" cols="45" name="about-title-two" placeholder="Добавьте заголовок"><?= $abouts[1]['about-title']; ?></textarea>
                            <label for="nameField">Изменить описание параграфа:</label>
                            <textarea rows="10" cols="45" name="about-description-two" placeholder="Добавьте заголовок"><?= $abouts[1]['about-description']; ?></textarea>
                           
                            <label for="image">Изменить изображение:</label>
                            <img src="<?= About::getImage($abouts[1]['about-img']); ?>" width="100px" alt="">
                            <input type="file" name="about-img-2" placeholder="Добавьте изображение" <?= $abouts[1]['about-img']; ?>>
                            <label for="nameField">Изменить alt изображения:</label>
                            <textarea rows="10" cols="45" name="about-img_alt-two" placeholder="Добавьте заголовок"><?= $abouts[1]['about-img_alt']; ?></textarea>

                            <label for="nameField">Изменить заголовок параграфа:</label>
                            <textarea rows="10" cols="45" name="about-title-three" placeholder="Добавьте заголовок"><?= $abouts[2]['about-title']; ?></textarea>
                            <label for="nameField">Изменить описание параграфа:</label>
                            <textarea rows="10" cols="45" name="about-description-three" placeholder="Добавьте заголовок"><?= $abouts[2]['about-description']; ?></textarea>
                            
                            <div>
                                <input class="button-primary" type="submit" name="submitMainAbout" value="Изменить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <a href="/admin/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Назад</a>
    <?php include_once ROOT . '/views/layout/adminFooter.php' ?>