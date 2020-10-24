<?php include_once ROOT . '/views/layout/adminHeader.php' ?>

	<section id="main-content" class="column column-offset-20">

		<!--Forms-->
		<h5 class="mt-2">Галерея</h5><a class="anchor" name="forms"></a>
		<div class="row grid-responsive content__admin">
			<div class="column">
				<div class="card">
					<div class="card-title">
						<h3>Добавить изображение</h3>
					</div>
					<div class="card-block">
						<?php
						if (isset($error_messages) && !empty($error_messages)) :
							foreach ($error_messages as $message) :
						?>
								<p class="text-danger"><?= $message; ?></p>
						<?php
							endforeach;
                        endif;
                        ?>

						<form action="/admin/galleryAdd" method="POST" enctype="multipart/form-data">
							<fieldset>
								<input type="hidden" name="formSend" value="imageAdd">
								<label for="image">Изображение:</label>
								<input type="file" name="image" placeholder="Добавьте изображение">
								<label for="image_alt">Alt изображения:</label>
								<input type="text" name="img_alt" placeholder="Добавьте alt изображения">
								<div>
									<input class="button-primary" type="submit" name="submit" value="Добавить">
								</div>
								<a href="/admin/gallery/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Назад</a>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php include_once ROOT . '/views/layout/adminFooter.php' ?>