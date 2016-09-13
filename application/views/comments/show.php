<?php foreach($comments as $comment): ?>

    <div style="padding:10px; margin-bottom:10px; border-bottom:#999 1px dashed;">
        <strong><?php echo HTML::chars($comment['user']); ?></strong><br />
        <?php echo HTML::chars($comment['message']); ?>
    </div>

<?php endforeach; ?>

<?php
    if (isset($errors)) {
        foreach ($errors as $error => $message) {

            if ($error == 'user' && $message[0] == 'not_empty') {
                echo '<h2 style="color:red;">Поле "Ваше имя" - Обязательно!</h2>';
            }

            if ($error == 'user' && $message[0] == 'max_length') {
                echo '<h2 style="color:red;">У вас слишком длинное имя!</h2>';
            }

            if ($error == 'message' && $message[0] == 'not_empty') {
                echo '<h2 style="color:red;">Поле "Сообщение" - Обязательно!</h2>';
            }
        }
    }
?>


<form action="" method="post">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">N</span>
        <input  name="user" id="user" type="text" class="form-control" placeholder="Ваше имя" aria-describedby="basic-addon1">
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">M</span>
        <textarea  name="message" id="message" rows="5" class="form-control" placeholder="Сообщение" aria-describedby="basic-addon1"></textarea>
    </div>
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-default">Отправить</button>
        </div>
    </div>
</form>
