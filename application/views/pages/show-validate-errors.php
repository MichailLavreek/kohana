<?php
//if (isset($errors)) {
//    var_dump($errors);
//}
//if (isset($_POST)) {
//    var_dump($_POST);
//}


if (isset($errors)) {
    foreach ($errors as $error => $message) {

        if ($error == 'name' && $message[0] == 'not_empty') {
            echo '<h2>Поле "Имя" - Обязательно!</h2>';
        }

        if ($error == 'user' && $message[0] == 'not_empty') {
            echo '<h2>Поле "Имя" - Обязательно!</h2>';
        }

        if ($error == 'name' && $message[0] == 'max_length') {
            echo '<h2>У пользователя слишком длинное имя!</h2>';
        }

        if ($error == 'user' && $message[0] == 'max_length') {
            echo '<h2>Слишком длинное имя!</h2>';
        }

        if ($error == 'name' && $message[0] == 'alpha_numeric') {
            echo '<h2>Имя должно состоять только из литинских букв и цифр!</h2>';
        }

        if ($error == 'email' && $message[0] == 'not_empty') {
            echo '<h2>Поле "email" - обязательно!</h2>';
        }

        if ($error == 'email' && $message[0] == 'email') {
            echo '<h2>Поле "email" - некорректно!</h2>';
        }

        if ($error == 'email' && $message[0] == 'max_length') {
            echo '<h2>Поле "email" - слишком длинный email!</h2>';
        }

        if ($error == 'pass' && $message[0] == 'not_empty') {
            echo '<h2>Вы не ввели пароль!</h2>';
        }

        if ($error == 'pass' && $message[0] == 'min-length') {
            echo '<h2>Пароль должен быть минимум 8 символов</h2>';
        }

        if ($error == 'pass' && $message[0] == 'max-length') {
            echo '<h2>Пароль должен быть не более 100 символов</h2>';
        }

        if ($error == 'pass2' && $message[0] == 'matches') {
            echo '<h2>Введенные пароли - разные!</h2>';
        }

        if ($error == 'pass2' && $message[0] == 'not_empty') {
            echo '<h2>Вы не ввели пароль во втором поле!</h2>';
        }

        if ($error == 'name' && $message[0] == 'matches') {
            echo '<h2>Пользователь с таким именем уже существует!</h2>';
        }

        if ($error == 'title' && $message[0] == 'not_empty') {
            echo '<h2>Заголовок отсутствует!</h2>';
        }

        if ($error == 'message' && $message[0] == 'not_empty') {
            echo '<h2>Поле "Сообщение" - Обязательно!</h2>';
        }

        if ($error == 'message' && $message[0] == 'max_length') {
            echo '<h2>Поле "Сообщение" - Слишком много текста!</h2>';
        }

        if ($error == 'title' && $message[0] == 'max_length') {
            echo '<h2>Поле "Сообщение" - Слишком много текста!</h2>';
        }
    }
}
