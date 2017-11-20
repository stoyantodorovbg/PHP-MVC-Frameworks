<?php /** @var \Core\Views\ViewsInterface $this */?>

<h1>Register</h1>

<form method="post" action="<?=$this->url('users', 'registerProcess')?>">
    username: <input type="text" name="username"><br/>
    password: <input type="password" name="password"><br/>
    confirm password: <input type="password" name="confirmPassword"><br/>
    <input type="submit" name="registerUser" value="register">
</form>
