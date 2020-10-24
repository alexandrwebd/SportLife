<?php include_once ROOT . '/views/layout/adminHeader.php' ?>

<div class="row">
    <section id="main-content" class="column column-offset-20">

        <!--Forms-->
        <h5 class="mt-2">Управление галереей</h5><a class="anchor" name="forms"></a>
        <div class="row grid-responsive content__admin">
            <div class="column ">
                <div class="card">
                    <div class="card-title">
                        <h4>Удалить изображение №<?= $id ?></h4>
                        <p class="text-large">Вы действительно хотите удалить это изображение?</p>
                    </div>

                    <div class="card-block">
                        <form action="" method="POST">
                            <fieldset>
                                <input type="hidden" name="form_send" value="1">
                                <div>
                                    <input class="button-primary" type="submit" name="submit" value="Удалить">
                                </div>
                                <a href="/admin/gallery/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Назад</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once ROOT . '/views/layout/adminFooter.php' ?>