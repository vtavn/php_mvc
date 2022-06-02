<?php
class Home extends Controller {

    public $province, $data;

    public function __construct()
    {
        $this->province = $this->model('HomeModel');
    }

    public function index(){
//        $data = $this->province->getList();

//        $data = $this->province->get();

//        foreach ($data as $item) {
//            echo $item['_name'].' - '.$item['_code'].'<br/>';
//        }
//        $data = $this->province->getListProvince();
//        $data2 = $this->province->getDetailProvince('Hà Nội');
//        echo '<pre>';
//        print_r($data);
//        print_r($data2);
//        echo '</pre>';
//
//        $data3 = $this->province->find(3);
//        print_r($data3);

        $dataInsert = [
            '_name' => 'Quảng Nam',
            '_code' => 'QN'
        ];
//        $id = $this->province->insertProvince($dataInsert);
//        echo $id;

        $data = $this->db->table('province')->get();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public function get_user(){
        $request = new Request();
        $data = $request->getFields();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        $this->render('users/add');
    }

    public function post_user(){
        $userId = 1;
        $request = new Request();
        if ($request->isPost()) {
            /*Set rules*/
            $request->rules([
                'fullname' => 'required|min:5|max:30',
                'email' => 'required|email|min:6|unique:users:email',
                'password' => 'required|min:3',
                'confirm_password' => 'required|match:password',
                'age' => 'required|callback_check_age'
            ]);

            /* set message*/

            $request->message([
                'fullname.required' => 'Họ và tên không được để trống',
                'fullname.min' => 'Họ tên phải lớn hơn 5 ký tự',
                'fullname.max' => 'Họ tên phải nhỏ hơn 30 ký tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Định dạng email không hợp lệ',
                'email.min' => 'Email phải lớn hơn 6 ký tự',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu phải lớn hơn 3 ký tự',
                'confirm_password.required' => 'Nhập lại mật khẩu không được để trống',
                'confirm_password.match' => 'Mật khẩu nhập lại không khớp',
                'age.required' => 'Tuổi không được để trống',
                'age.callback_check_age' => 'Tuổi phải lớn hơn 20'
            ]);

            $validate = $request->validate();
            if (!$validate) {
                $this->data['errors'] = $request->errors();
                $this->data['msg'] = 'Có lỗi xảy ra vui lòng thử lại.';
                $this->data['old'] = $request->getFields();
            }

            $this->render('users/add', $this->data);
        }else{
            $response = new Response();
            $response->redirect('home/get_user');
        }
    }
    public function check_age($age){
        if ($age>=20){
            return true;
        }
        return false;
    }
}