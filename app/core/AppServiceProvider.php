<?php
class AppServiceProvider extends ServiceProvider {
    public function boot(){
        $arr = $this->db->table('users')->where('id', '=', 1)->first();
        $data['userInfo'] = $arr;
        $data['copyright'] = 'Copyright &copy; 2022';
        View::share($data);
    }
}