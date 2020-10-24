<?php include_once ROOT . '/views/layout/adminHeader.php' ?>


<section id="main-content" class="column column-offset-20">
	<div class="row grid-responsive content__admin">
		<div class="column page-heading admin__title-blogs">
			<div class="large-card">
				<h4>Управление блогом</h4>
				<p class="text-large">В этом разделе осуществляеться упраление вашим блогом со статьями.</p>
				<p>Для добавления новой статьи нажмите кнопку,<em> для изменения смотрите ниже.</em></p>
				<a href="/admin/blogAdd" class="button">Добавить статью</a>
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

	<h5>Список блогов</h5><a class="anchor" name="charts"></a>
	<div class="row grid-responsive content__admin">
		<div class="column">
			<table class="admin__blogs-table">
				<tr>
					<th class="table-id">ID статьи</th>
					<th>Изображение статьи</th>
					<th>Заголовок статьи</th>
					<th></th>
					<th></th>
				</tr>
				<?php foreach ($blogsList as $blogs) : ?>
					<tr>
						<td><?= $blogs['id']; ?></td>
						<td class="admin__blogs-img"><img src="/public/images/blogs/<?= $blogs['img']; ?>" alt=""></td>
						<td><?= $blogs['title']; ?></td>
						<td><a href="/admin/blogEdit/blog-<?= $blogs['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square"></i></a></td>
						<td><a href="/admin/blogDelete/blog-<?= $blogs['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
	<a href="/admin/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Назад</a>


	<?php include_once ROOT . '/views/layout/adminFooter.php' ?>