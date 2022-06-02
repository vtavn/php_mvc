<?php
    echo (!empty($msg)?$msg:false);
    HtmlHelper::formOpen('post', _WEB_ROOT.'/home/post_user');
    HtmlHelper::input('<div>', form_error('fullname', '<span style="color:red">', '</span>').'</div>', 'text', 'fullname', 'fullname', '', 'Họ tên', old('fullname'));
    HtmlHelper::input('<div>', form_error('email', '<span style="color:red">', '</span>').'</div>', 'text', 'email', 'email', '', 'Email', old('email'));
    HtmlHelper::input('<div>', form_error('age', '<span style="color:red">', '</span>').'</div>', 'text', 'age', 'age', '', 'Tuổi', old('age'));
    HtmlHelper::input('<div>', form_error('password', '<span style="color:red">', '</span>').'</div>', 'password', 'password', 'password', '', 'Mật khẩu');
    HtmlHelper::input('<div>', form_error('confirm_password', '<span style="color:red">', '</span>').'</div>', 'password', 'confirm_password', 'confirm_password', '', 'Nhập lại mật khẩu');
    HtmlHelper::submit('Đăng ký');
    HtmlHelper::formClose();
    ?>