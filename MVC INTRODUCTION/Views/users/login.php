<?php /** @var $model Models\RegisterViewModel */ ?>
<h1>LOGIN</h1>

<h3>Users: <?= $model->getAllUsers() ?>; Active users: <?= $model->getActiveUsers() ?></h3>
<form method="post">
    Username: <input type="text", name="username"><br/>
    Password: <input type="password", name="password"><br/>
    <input type="submit" name="submit" value="submit"><br/>
</form>
