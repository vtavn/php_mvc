<?php
echo (!empty($msg)?$msg:false);
?>
<form action="<?= _WEB_ROOT ?>/home/post_user" method="post">
    <div>
        <input type="text" name="fullname" placeholder="Họ tên..." value="<?php echo !empty($old['fullname'])?$old['fullname']:false;?>"/><br/>
        <?php echo (!empty($errors) && array_key_exists('fullname', $errors))?'<span style="color:red">'.$errors['fullname'].'</span>':false; ?>
    </div>
    <div>
        <input type="text" name="email" placeholder="Email..." value="<?php echo !empty($old['email'])?$old['email']:false;?>" /><br/>
        <?php echo (!empty($errors) && array_key_exists('email', $errors))?'<span style="color:red">'.$errors['email'].'</span>':false; ?>
    </div>
    <div>
        <input type="number" name="age" placeholder="Tuổi..." value="<?php echo !empty($old['age'])?$old['age']:false;?>" /><br/>
        <?php echo (!empty($errors) && array_key_exists('age', $errors))?'<span style="color:red">'.$errors['age'].'</span>':false; ?>
    </div>
    <div>
        <input type="password" name="password" placeholder="Mật khẩu..."/><br/>
        <?php echo (!empty($errors) && array_key_exists('password', $errors))?'<span style="color:red">'.$errors['password'].'</span>':false; ?>
    </div>
    <div>
        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu"/><br/>
        <?php echo (!empty($errors) && array_key_exists('confirm_password', $errors))?'<span style="color:red">'.$errors['confirm_password'].'</span>':false; ?>
    </div>
    <button type="submit">Gửi</button>
</form>