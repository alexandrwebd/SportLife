<?php include_once ROOT . '/views/layout/adminHeader.php' ?>


<section id="main-content" class="column column-offset-20">
	<div class="row grid-responsive content__admin">
		<div class="column page-heading admin__title-blogs">
			<div class="large-card">
				<h4>Управление галереей</h4>
				<p class="text-large">В этом разделе осуществляеться упраление вашей галереей.</p>
				<p>Для добавления нового изображения нажмите кнопку,<em> для изменения смотрите ниже.</em></p>
				<a href="/admin/galleryAdd" class="button">Добавить изображение</a>
			</div>
		</div>
	</div>
	<?php
	if (isset($error_messages) && !empty($error_messages)) :
		foreach ($error_messages as $message) :
	?>
			<p class="text-danger"><?= $message; ?></p>
	<?php
		endforeach;
	endif;
	?>

	<h5>Список изображений</h5><a class="anchor" name="charts"></a>
	<div class="row grid-responsive content__admin">
		<div class="column">
			<table class="admin__blogs-table">
				<tr>
					<th class="table-id">ID изображения</th>
					<th>Изображение</th>
					<th>Alt изображения</th>
					<th></th>
					<th></th>
				</tr>
				<?php foreach ($images as $image) : ?>
					<tr>
						<td><?= $image['id']; ?></td>
						<td class="admin__blogs-img"><img src="/public/images/gallery/<?= $image['images']; ?>" alt=""></td>
						<td><?= $image['images_alt']; ?></td>
						<td><a href="/admin/galleryEdit/image-<?= $image['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square"></i></a></td>
						<td><a href="/admin/galleryDelete/image-<?= $image['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
	<a href="/admin/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Назад</a>


	<?php include_once ROOT . '/views/layout/adminFooter.php' ?>