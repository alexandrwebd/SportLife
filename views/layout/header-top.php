<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if (isset($title)) echo $title ?></title>
    <meta name="description" content="<?php if (isset($description)) echo $description ?>" />
    <link rel="icon" type="image/png" sizes="192x192" href="/public/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Oswald:300,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/fonts.css">
    <link rel="stylesheet" href="/public/css/style.min.css">
    <script type='application/ld+json'>
        <?php if (isset($razmetca)) echo $razmetca ?>
    </script>
</head>

<body>
    <header class="header">
        <div class="header__top" id="header__top">
            <div class="container">
                <div class="header__top-inner">
                    <div class="logo">
                        <a class="logo__link" href="/">
                            <img class="logo__img" src="/public/images/logo.png" alt="SportLife">
                        </a>
                    </div>
                    <div class="header__burger">
                        <span></span>
                    </div>
                    <nav class="menu">
                        <ul class="menu__list">
                            <li class="menu__list-item">
                                <a class="menu__link" href="/about">О клубе</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__link" href="/service">Услуги</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__link" href="/prices">Цены</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__link" href="/team">Команда</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__link" href="/gallery">Галерея</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__link" href="/blog">Блог</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__link" href="/contacts">Контакты</a>
                            </li>
                            <li class="menu__list-item header__phone">
                                <a class="header__phone-link" href="tel:80935433112">0462 610 540</a>
                            </li>
                            <li class="menu__list-item header__registration header__admin">
                                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
                                    <?php if ($_SESSION['user']['is_admin'] == 1) : ?>
                                        <a class="header__registration-link admin-popup" href="/admin">Админпанель</a>
                                        <span>/</span>
                                        <a class="header__registration-link login-popup" " href="/logout">Выход </a> <?php elseif ($_SESSION['user']['is_admin'] == 0) : ?> <a class="header__registration-link admin-popup" href="/cabinet">Кабинет</a>
                                        <span>/</span>
                                        <a class="header__registration-link login-popup" " href="/logout">Выход </a> </li> <li class="menu__list-item header__registration">
                                        <?php endif; ?> <?php else : ?>
                            </li>
                            <li class="menu__list-item header__registration">
                                <a class="header__registration-link registration-popup" href="/registration">Регистрация</a>
                                <span>/</span>
                                <a class="header__registration-link login-popup" href="/authorization">Войти</a>

                            <?php endif; ?>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>