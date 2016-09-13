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
            echo '<h2 style="color:red;">Поле "Имя" - Обязательно!</h2>';
        }

        if ($error == 'name' && $message[0] == 'max_length') {
            echo '<h2 style="color:red;">У пользователя слишком длинное имя!</h2>';
        }

        if ($error == 'name' && $message[0] == 'alpha_numeric') {
            echo '<h2 style="color:red;">Имя должно состоять только из литинских букв и цифр!</h2>';
        }

        if ($error == 'email' && $message[0] == 'email') {
            echo '<h2 style="color:red;">Поле "email" - некорректно!</h2>';
        }

        if ($error == 'pass' && $message[0] == 'min-length') {
            echo '<h2 style="color:red;">Пароль должен быть минимум 8 символов</h2>';
        }

        if ($error == 'pass2' && $message[0] == 'matches') {
            echo '<h2 style="color:red;">Введенные пароли - разные!</h2>';
        }

        if ($error == 'name' && $message[0] == 'matches') {
            echo '<h2 style="color:red;">Пользователь с таким именем уже существует!</h2>';
        }
    }
}
