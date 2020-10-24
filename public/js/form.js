
$(document).ready(function () {

    // форма записи на бесплатную тренировку
    $('#sendMail').click(function (event) {
        event.preventDefault();
        // получаем значения с формы и удаляем пробелы
        let email = $('#form-email').val().trim();
        let date = $('#form-date').val().trim();
        let name = $('#form-name').val().trim();
        let phone = $('#form-phone').val().trim();

        // проверяем на пустоту
        if (email == "") {
            $('#error_messages').text('Введите email');
            return false;
        } else if (name == "") {
            $('#error_messages').text('Введите имя');
            return false;
        } else if (date == "") {
            $('#error_messages').text('Введите дату');
            return false;
        } else if (phone == "") {
            $('#error_messages').text('Введите телефон');
            return false;
        } else {
            // если ошибок нету удаляем текст с ошибками
            $('#error_messages').text("");
        }

        $.ajax({
            url: '/email/form',
            type: 'POST',
            cache: false,
            data: { 'name': name, 'email': email, 'date': date, 'phone': phone },
            dataType: 'html',
            beforeSend: function () {
                // делаю кнопку не активной до получения данных с сервера
                $('#sendMail').prop('disable', true);
            },
            success: function (data) {

                if (data == 'error_email') {  // если мыло не прошло проверку регуляркой
                    $('#error_messages').html('Введите коректный email.');
                } else if (data == 'error_phone') {  // если телефон не прошло проверку регуляркой
                    $('#error_messages').html('Введите коректный телефон.');
                } else {
                    if (!data) {
                        // если возникли ошибки во время отправки на почту
                        $('#error_messages').html('Ошибки при получении ответа с сервера, сообщение не отправлено');
                    } else {
                        // очищаю форму
                        $('#mail-form').trigger('reset');
                        // делаю кнопку активной
                        $('#sendMail').prop('disable', false);
                        // вывожу сообщение успех
                        $('#error_messages').css({ color: '#000' }).html('Спасибо, ваша заявка принята. Мы свяжемся с вами.');
                        // очищаю сообщение через 3 сек
                        setTimeout(function () { $('#error_messages').empty(); }, 3000);
                    }
                }
            }
        });
    });

    // попап форма узнать цену
    $("#sendContacts").click(function (event) {
        event.preventDefault();

        // собираем значения с полей удаляем пробелы
        let email = $('#contacts__form-email').val().trim();
        let name = $('#contacts__form-name').val().trim();
        let phone = $('#contacts__form-phone').val().trim();

        if (email == "") {
            $('#error_messages').text('Введите email');
            return false;
        } else if (name == "") {
            $('#error_messages').text('Введите имя');
            return false;
        } else if (phone == "") {
            $('#error_messages').text('Введите телефон');
            return false;
        } else {
            // если ошибок нету удаляем текст с ошибками
            $('#error_messages').text("");
        }
        $.ajax({
            url: '/email',
            type: 'POST',
            cache: false,
            data: { 'name': name, 'email': email, 'phone': phone },
            dataType: "html",
            beforeSend: function () {
                // делаю кнопку не активной
                $('#sendContacts').prop('disable', true);
            },
            success: function (data) {
                if (data == 'error_email') {
                    $('#error_messages').html('Введите коректный email.');
                } else if (data == 'error_phone') {
                    $('#error_messages').html('Введите коректный телефон.');
                } else {
                    if (!data) {
                        $('#error_messages').html('Ошибки при получении ответа с сервера, сообщение не отправлено');
                    } else {
                        // обнуляюполя формы
                        $('#popup-form').trigger('reset');
                        // делаю кнопку активной
                        $('#sendContacts').prop('disable', false);
                        // вывожу сообщение об успехе
                        $('#error_messages').css({ color: '#000' }).html('Спасибо, ваша заявка принята. Мы свяжемся с вами.');
                        // закрываю попап окно через 3 сек
                        setTimeout(function () {
                            $('#error_messages').empty();
                            $.magnificPopup.close();
                        }, 3000);
                    }
                }
            }
        });
    });


    // попап форма рассылки
    $("#btn-mailing").click(function (event) {
        event.preventDefault();

        // собираем значения с полей удаляем пробелы
        let email = $('#footer-form').val().trim();

        if (email == "") {
            $('#error_messages').text('Введите email');
            return false;
        } else {
            // если ошибок нету удаляем текст с ошибками
            $('#error_messages').text("");
        }
        $.ajax({
            url: '/email/mailing',
            type: 'POST',
            cache: false,
            data: { 'email': email },
            dataType: "html",
            beforeSend: function () {
                $('#form-mailing').prop('disable', true);
            },
            success: function (data) {
                // если с сервера пришол успех почта добавлена в бд
                if (data == 'success') {
                    $('#form-mailing').trigger('reset');
                    $('#btn-mailing').prop('disable', false);
                    $('#footer-message').css({ color: '#bab9ba' }).html('Спасибо, ваша заявка на рассылку прийнята.');
                    setTimeout(function () {
                        // скрываю сообщение, возвращаю прежнее
                        $('#footer-message').empty().text("Подпишитесь на разсылку");
                    }, 3000);
                } else {
                    // вывожу сообщение ошибки с сервера
                    $('#footer-message').css({ color: '#cc3535' }).html(data);
                    setTimeout(function () {
                        // скрываю сообщение, возвращаю прежнее
                        $('#footer-message').css({ color: '#bab9ba' }).empty().text("Подпишитесь на разсылку");
                    }, 3000);
                }
            }
        });
    });

    // форма заказать карту (orders)
    $("#sendOrders").click(function (event) {
        event.preventDefault();

        // собираем значения с полей удаляем пробелы
        let email = $('#contacts__form-email').val().trim();
        let name = $('#contacts__form-name').val().trim();
        let phone = $('#contacts__form-phone').val().trim();
        let prices = $('#contacts__form-prices').val().trim();

        if (email == "") {
            $('#error_messages').text('Введите email');
            return false;
        } else if (name == "") {
            $('#error_messages').text('Введите имя');
            return false;
        } else if (phone == "") {
            $('#error_messages').text('Введите телефон');
            return false;
        } else if (prices == "") {
            $('#error_messages').text('Выберите карту');
            return false;
        } else {
            // если ошибок нету удаляем текст с ошибками
            $('#error_messages').text("");
        }
        $.ajax({
            url: '/email/orders',
            type: 'POST',
            cache: false,
            data: { 'name': name, 'email': email, 'phone': phone, 'prices': prices },
            dataType: "html",
            beforeSend: function () {
                $('#sendOrders').prop('disable', true);
            },
            success: function (data) {
                if (data == 'error_email') {
                    $('#error_messages').html('Введите коректный email.');
                } else if (data == 'error_phone') {
                    $('#error_messages').html('Введите коректный телефон.');
                } else {
                    if (!data) {
                        $('#error_messages').html('Ошибки при получении ответа с сервера, сообщение не отправлено');
                    } else {
                        $('#popup-form__prices').trigger('reset');
                        $('#sendOrders').prop('disable', false);
                        $('#error_messages').css({ color: '#000' }).html('Спасибо, ваша заявка принята. Мы свяжемся с вами.');
                        setTimeout(function () { $.magnificPopup.close(); }, 3000);

                    }
                }
            }
        });
    });

    //Добавить отзыв
    $('#send-review').click(function (event) {
        event.preventDefault();

        // собираем значения с полей удаляем пробелы
        let email = $('#email-review').val().trim();
        let name = $('#name-review').val().trim();
        let text = $('#text-review').val().trim();

        $.ajax({
            url: '/review/add',
            type: 'POST',
            cache: false,
            data: { 'name': name, 'email': email, 'text': text },
            dataType: "html",
            beforeSend: function () {
                $('#send-review').prop('disable', true);
            },
            success: function (data) {
                if (data == 'success') {
                    $('#review-form').trigger('reset');
                    $('#send-review').prop('disable', false);
                    $('#review-disabled_text').html('Спасибо. Ваш отзыв скоро появиться на сайте.');
                    return false;
                } else {
                    $('#review-disabled_text').html('Извините но по техническим причинам мы не смогли прийнять ваш отзыв.');
                    return false;
                }
            },
            error: function () {
                $('#review-disabled_text').html('Извините но по техническим причинам мы не смогли прийнять ваш отзыв.');
            }
        });

    });




    // регсстрация
    // $('#registration').submit(function (event) {
    //     event.preventDefault();

    //     $.ajax({
    //         type: $(this).attr('method'),
    //         url: '/registration',
    //         data: $(this).serialize(),
    //         dataType: "html",
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function (result) {
    //             // alert('Форма отправлена');
    //         },

    //     }).done(function() {
    //         window.location = "/authorization?msg=Регистрация прошла успешно";
    //     });
    //     return false;
    // });

    // авторизация
    // $('#authorization').submit(function (event) {
    //     event.preventDefault();

    //     $.ajax({
    //         type: $(this).attr('method'),
    //         url: $(this).attr('action'),
    //         data: $(this).serialize(),
    //         dataType: "html",
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function (result) {

    //         }, 
    //     }).done(function() {
    //         window.location = "/";
    //     });
    //     return false;
    // });

    // подтверждение пароля
    // $('#recover').submit(function (event) {
    //     event.preventDefault();

    //     $.ajax({
    //         type: $(this).attr('method'),
    //         url: $(this).attr('action'),
    //         data: $(this).serialize(),
    //         dataType: "html",
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function (result) {

    //         }, 
    //     }).done(function() {
    //         window.location = "/recover";
    //     });
    //     return false;
    // });

    // $("form").submit(function(event) {
    //     event.preventDefault();
    //     $data = $(this).serialize();
    //     if(!$(this).attr("action")) { var $url = document.location.href; } else { var $url = $(this).attr("action"); }
    //     if(!$(this).attr("method")) { var $method = "post"; } else { var $method = $(this).attr("method"); }
    //     $.ajax({
    //       url: $url,
    //       type: $method,
    //       data: $data, 
    //       dataType: "json",
    //       success: function(data){ 

    //       }
    //     });
    //   });





});