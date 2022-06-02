<?php
echo (!empty($msg)?$msg:false);
?>
<form action="<?= _WEB_ROOT ?>/home/post_user" method="post">
    <div>
        <input type="text" name="fullname" placeholder="Họ tên..." value="<?php echo old('fullname'); ?>"/><br/>
        <?php echo form_error('fullname', '<span style="color:red">', '</span>'); ?>
    </div>
    <div>
        <input type="text" name="email" placeholder="Email..." value="<?php echo old('email'); ?>" /><br/>
        <?php echo form_error('email', '<span style="color:red">', '</span>'); ?>
    </div>
    <div>
        <input type="number" name="age" placeholder="Tuổi..." value="<?php echo old('age'); ?>" /><br/>
        <?php echo form_error('age', '<span style="color:red">', '</span>'); ?>
    </div>
    <div>
        <input type="password" name="password" placeholder="Mật khẩu..."/><br/>
        <?php echo form_error('password', '<span style="color:red">', '</span>'); ?>
    </div>
    <div>
        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu"/><br/>
        <?php echo form_error('confirm_password', '<span style="color:red">', '</span>'); ?>
    </div>
    <button type="submit">Gửi</button>
</form>