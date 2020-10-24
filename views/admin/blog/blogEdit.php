<?php include_once ROOT . '/views/layout/adminHeader.php' ?>

	<section id="main-content" class="column column-offset-20">

		<!--Forms-->
		<h5 class="mt-2">Статьи</h5><a class="anchor" name="forms"></a>
		<div class="row grid-responsive content__admin">
			<div class="column">
				<div class="card">
					<div class="card-title">
						<h3>Изменить статью</h3>
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
						<form action="/admin/blogEdit/blog-<?= $blog['id'] ?>" method="POST" enctype="multipart/form-data">
							<fieldset>
								<input type="hidden" name="formSend" value="placeAdd">
								<label for="nameField">Заголовок:</label>
								<input type="text" name="title" placeholder="Добавьте заголовок" id="nameField" value="<?= $blog['title']; ?>">
								<label for="text">Текст статьи:</label>
								<textarea rows="10" cols="45" name="description" placeholder="Добавьте текст статьи"><?= $blog['description']; ?></textarea>
								<label for="image">Изображение:</label>
								<img src="<?= Blog::getImage($blog['id']); ?>" width="100px" alt="">
								<input type="file" name="image" placeholder="Добавьте изображение" <?= $blog['img']; ?>>
								<label for="image_alt">Alt изображения:</label>
								<input type="text" name="img_alt" placeholder="Добавьте alt изображения" value="<?= $blog['img_alt']; ?>">
								<div>
									<input class="button-primary" type="submit" name="submit" value="Изменить">
								</div>
								<a href="/admin/blogs/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Назад</a>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php include_once ROOT . '/views/layout/adminFooter.php' ?>