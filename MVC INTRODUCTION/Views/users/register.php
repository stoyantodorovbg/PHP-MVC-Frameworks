<?php /** @var $model Models\RegisterViewModel */ ?>
<h1>Register</h1>

<h3>Users: <?= $model->getAllUsers() ?>; Active users: <?= $model->getActiveUsers() ?></h3>
<form method="post" action="registerProcess">
    Username: <input type="text", name="username"><br/>
    Password: <input type="password", name="password"><br/>
    Confirm password: <input type="confirm_password", name="password"><br/>
    Name: <input type="text" name="name"><br/>
    <input type="submit" value="submit"><br/>
</form>
