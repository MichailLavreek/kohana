<h3>Это главная страница</h3>
<h4>Регистрация нового пользователя</h4>

<?php include __DIR__ . '/show-validate-errors.php'; ?>

<form action="" method="post">

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">N</span>
        <input  name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" id="user" type="text" class="form-control" placeholder="Имя пользователя" aria-describedby="basic-addon1">
    </div>

    <div class="input-group">
        <span class="input-group-addon sm" id="basic-addon1">@</span>
        <input  name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" id="email" type="text" class="form-control" placeholder="Email пользователя" aria-describedby="basic-addon1">
    </div>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">P</span>
        <input type="text" name="pass" id="pass" class="form-control" placeholder="Пароль" aria-describedby="basic-addon1">
    </div>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">P</span>
        <input type="text" name="pass2" id="pass2" class="form-control" placeholder="Повторите пароль" aria-describedby="basic-addon1">
    </div>

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-default">Создать пользователя</button>
        </div>
    </div>

</form>

<h4>Пользователи: </h4>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Пользователи</div>

    <!-- Table -->
    <table class="table">
        <tr>
            <td>ИД</td>
            <td>Имя</td>
            <td>Email</td>
            <td>Статус</td>
            <td>Удалить</td>
        </tr>
        <?php if (isset($users)) : ?>
            <?php foreach ($users as $user) : ?>

                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td>
                        <?php echo $user['status'] ?>
                        <a href="<?php URL::site() ?>change-status-user/<?php echo $user['id'] ?>">Заблокировать/расблокировать</a>
                    </td>
                    <td><a href="<?php URL::site() ?>delete-user/<?php echo $user['id'] ?>">удалить</a></td>
                </tr>

            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>



