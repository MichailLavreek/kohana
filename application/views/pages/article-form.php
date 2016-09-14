<?php include __DIR__ . '/show-validate-errors.php'; ?>

<form action="" method="post">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">N</span>
        <input  name="user" value="<?php if(isset($_POST['user'])){echo Arr::get($_POST, 'user');}?>" id="user" type="text" class="form-control" placeholder="Ваше имя" aria-describedby="basic-addon1">
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">T</span>
        <input name="title" type="text" value="<?php if(isset($_POST['title'])){echo Arr::get($_POST, 'title');}?>" id="title" class="form-control" placeholder="Заголовок новости" aria-describedby="basic-addon1">
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">M</span>
        <textarea  name="message" id="message" rows="5" class="form-control" placeholder="Сообщение" aria-describedby="basic-addon1"><?php if(isset($_POST['message'])){echo Arr::get($_POST, 'message');} ?></textarea>
    </div>
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-default">Отправить</button>
        </div>
    </div>
</form>