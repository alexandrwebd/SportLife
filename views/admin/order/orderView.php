<?php include_once ROOT . '/views/layout/adminHeader.php' ?>

	<section id="main-content" class="column column-offset-20">
		<div class="row grid-responsive content__admin">
			<div class="column page-heading admin__title-blogs">
				<div class="large-card">
					<h4>Управление заказами</h4>
					<p class="text-large">В этом разделе осуществляеться упраление заказами услуг.</p>
					<!-- <p>Для добавления новой статьи нажмите кнопку,<em> для изменения смотрите ниже.</em></p>
					<a href="/admin/blogAdd" class="button">Добавить статью</a> -->
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

		<h5>Информация о заказе</h5><a class="anchor" name="charts"></a>
		<div class="row grid-responsive">
			<table>
				<tr>
                    <td>Номер заказа</td>
                    <td><?= $order['$id']; ?></td>
                </tr>
				<tr>
                    <td>Имя клиента</td>
                    <td><?= $order['user_name']; ?></td>
                </tr>
				<tr>
                    <td>Телефон клиента</td>
                    <td><?= $order['user_phone']; ?></td>
                </tr>
				<tr>
                    <td>Комментарий клиента</td>
                    <td><?= $order['user_comment']; ?></td>
                </tr>
                    
                <?php if($order['user_id'] != 0): ?>
                <tr>
                    <td>ID клиента</td>
                    <td><?= $order['user_id']; ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td>Статус заказа</td>
                    <td><?= Order::getStatusText($order['status']); ?></td>
                </tr>
                <tr>
                    <td>Дата заказа</td>
                    <td><?= $order['date']; ?></td>
                </tr>
			</table>
		</div>
        
        <div class="row grid-responsive content__admin">
			<div class="column page-heading admin__title-blogs">
				<div class="large-card">
					<h4>Заказ</h4>
				</div>
			</div>
		</div>
        <table>
				<tr>
					<th>ID абонимента</th>
					<th>Название</th>
                    <th>Цена</th>
				</tr>
				<?php foreach ($card as $card) : ?>
					<tr>
						<td><?= $card['id']; ?></td>
						<td><?= $card['name']; ?></td>
						<td><?= $card['price']; ?></td>
						<td><a href="/admin/blogEdit/blog-<?= $blogs['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square"></i></a></td>
						<td><a href="/admin/blogDelete/blog-<?= $blogs['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
					</tr>
				<?php endforeach; ?>
            </table>
            
            <a href="/admin/orders/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Назад</a>
		<!--Widgets-->
		<h5 class="mt-2">Widgets</h5><a class="anchor" name="widgets"></a>
		<div class="row grid-responsive mt-1">
			<div class="column">
				<div class="card">
					<div class="card-title">
						<h2 class="float-left">Notifications</h2>
						<div class="badge background-primary float-right">36</div>
						<div class="clearfix"></div>
					</div>
					<div class="card-block">
						<div class="mt-1">
							<img src="http://via.placeholder.com/45x45" alt="profile photo" class="circle float-left profile-photo" width="45" height="auto">
							<div class="float-left ml-1">
								<p class="m-0"><strong>Jane Donovan</strong> <span class="text-muted">uploaded a new photo</span></p>
								<p class="text-small text-muted">30 minutes ago</p>
							</div>
							<div class="clearfix"></div>
							<hr class="m-0 mb-2" />
						</div>
						<div class="mt-1">
							<img src="http://via.placeholder.com/45x45" alt="profile photo" class="circle float-left profile-photo" width="45" height="auto">
							<div class="float-left ml-1">
								<p class="m-0"><strong>Sam Davidson</strong> <span class="text-muted">just replied to your message</span></p>
								<p class="text-small text-muted">12 hours ago</p>
							</div>
							<div class="clearfix"></div>
							<hr class="m-0 mb-2" />
						</div>
						<div class="mt-1">
							<img src="http://via.placeholder.com/45x45" alt="profile photo" class="circle float-left profile-photo" width="45" height="auto">
							<div class="float-left ml-1">
								<p class="m-0"><strong>Kelly Johnson</strong> <span class="text-muted">changed her status</span></p>
								<p class="text-small text-muted">2 days ago</p>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="column">
				<div class="card">
					<div class="card-title">
						<h2 class="float-left">Projects</h2>
						<div class="badge float-right">3 In Progress</div>
						<!--<div class="badge background-success float-right mr-1">5 Complete</div>-->
						<div class="clearfix"></div>
					</div>
					<div class="card-block progress-bars">
						<h5 class="float-left mt-1">Project Title</h5>
						<p class="float-right text-small text-muted mt-1">25%</p>
						<div class="clearfix"></div>
						<div class="progress-bar">
							<div class="progress background-primary" style="width: 25%;"></div>
						</div>
						<h5 class="float-left mt-1">Project Title</h5>
						<p class="float-right text-small text-muted mt-1">50%</p>
						<div class="clearfix"></div>
						<div class="progress-bar">
							<div class="progress background-primary" style="width: 50%;"></div>
						</div>
						<h5 class="float-left mt-1">Project Title</h5>
						<p class="float-right text-small text-muted mt-1">75%</p>
						<div class="clearfix"></div>
						<div class="progress-bar">
							<div class="progress background-primary" style="width: 75%;"></div>
						</div>
						<h5 class="float-left mt-1">Project Title</h5>
						<p class="float-right text-small text-muted mt-1">100%</p>
						<div class="clearfix"></div>
						<div class="progress-bar">
							<div class="progress background-primary" style="width: 100%;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Forms-->
		<h5 class="mt-2">Статьи</h5><a class="anchor" name="forms"></a>
		<div class="row grid-responsive">
			<div class="column ">
				<div class="card">
					<div class="card-title">
						<h3>Добавить статью</h3>
					</div>
					<div class="card-block">
						<form action="/admin/blogAdd" method="POST" enctype="multipart/form-data">
							<fieldset>
								<input type="hidden" name="formSend" value="placeAdd">
								<label for="nameField">Заголовок</label>
								<input type="text" name="head" placeholder="Добавьте заголовок" id="nameField">
								<label for="ageRangeField">Age Range</label>
								<select id="ageRangeField">
									<option value="0-13">0-13</option>
									<option value="14-17">14-17</option>
									<option value="18-23">18-23</option>
									<option value="24+">24+</option>
								</select>
								<label for="commentField">Comment</label>
								<textarea placeholder="Hi Jane…" id="commentField"></textarea>
								<div class="float-right">
									<input type="checkbox" id="confirmField">
									<label class="label-inline" for="confirmField">Send a copy to yourself</label>
								</div>
								<input class="button-primary" type="submit" value="Send">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!--Alerts-->
		<h5 class="mt-2">Alerts</h5><a class="anchor" name="alerts"></a>
		<div class="row grid-responsive">
			<div class="column">
				<div class="alert background-success"><em class="fa fa-thumbs-up"></em> Yay! Everything looks good</div>
				<div class="alert background-warning"><em class="fa fa-warning"></em> Are you sure you want to do that?</div>
				<div class="alert background-danger"><em class="fa fa-times-circle"></em> Oops, something went really wrong</div>
				<div class="alert"><em class="fa fa-bullhorn"></em> This is a generic alert without any defined background color</div>
			</div>
		</div>

		<!--Buttons-->
		<h5 class="mt-2">Buttons</h5><a class="anchor" name="buttons"></a>
		<div class="row grid-responsive">
			<div class="column">
				<!-- Default Button -->
				<a class="button" href="#">Default Button</a>

				<!-- Outlined Button -->
				<button class="button button-outline">Outlined Button</button>

				<!-- Clear Button -->
				<input class="button button-clear" type="submit" value="Clear Button">
			</div>
		</div>

		<!--Tables-->
		<h5 class="mt-2">Tables</h5><a class="anchor" name="tables"></a>
		<div class="row grid-responsive">
			<div class="column ">
				<div class="card">
					<div class="card-title">
						<h3>Current Members</h3>
					</div>
					<div class="card-block">
						<table>
							<thead>
								<tr>
									<th>Name</th>
									<th>Role</th>
									<th>Age</th>
									<th>Location</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Jane Donovan</td>
									<td>UI Developer</td>
									<td>23</td>
									<td>Philadelphia, PA</td>
								</tr>
								<tr>
									<td>Jonathan Smith</td>
									<td>Designer</td>
									<td>30</td>
									<td>London, UK</td>
								</tr>
								<tr>
									<td>Kelly Johnson</td>
									<td>UX Developer</td>
									<td>25</td>
									<td>Los Angeles, CA</td>
								</tr>
								<tr>
									<td>Sam Davidson</td>
									<td>Programmer</td>
									<td>28</td>
									<td>Philadelphia, PA</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>


		<?php include_once ROOT . '/views/layout/adminFooter.php' ?>