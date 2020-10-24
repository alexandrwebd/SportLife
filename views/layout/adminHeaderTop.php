<?php
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700" rel="stylesheet">

    <!-- Template Styles -->
    <link rel="stylesheet" href="/public/css/font-awesome.min.css">

    <!-- CSS Reset -->
    <link rel="stylesheet" href="/public/css/normalize.css">

    <!-- Milligram CSS minified -->
    <link rel="stylesheet" href="/public/css/milligram.min.css">

    <!-- Main Styles -->
    <link rel="stylesheet" href="/public/css/styles.css">
    <style>
        /* .content__admin {
            min-height: calc(100vh - 180px);
        } */
        .credit {
            margin-top: 100px;

        }

        .admin__blogs-img {
            display: block;
            max-width: 70px;
            width: 100%;
        }

        .admin__blogs-img img {
            max-width: 100%;
            object-fit: cover;
        }

        /* .admin__title-blogs{
            max-height: 150px !important;
        } */
    </style>

    <!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
    <div class="navbar">
        <div class="row">
            <div class="column column-30 col-site-title"><a href="/" class="site-title float-left">SportLife</a></div>
            <!-- <div class="column column-40 col-search"><a href="#" class="search-btn fa fa-search"></a>
				<input type="text" name="" value="" placeholder="Search..." />
			</div> -->
            <div class="column column-30">
                <div class="user-section"><a href="#">
                        <?php if (isset($_SESSION['user']['profile_img'])) : ?>
                            <img src="/public/images/profile/<?= $_SESSION['user']['profile_img'] ?>" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
                        <?php else : ?>
                            <img src="http://via.placeholder.com/50x50" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
                        <?php endif; ?>
                        <div class="username">
                            <h4><?= $_SESSION['user']['name'] ?> <?= $_SESSION['user']['surname'] ?></h4>
                            <p><?= $_SESSION['user']['role'] ?></p>
                        </div>
                        <a style="color: #1363d1; margin: 10px 10px 0 0;" href="/logout">Выход</a>
                    </a></div>
            </div>
        </div>
    </div>
    <div class="row">