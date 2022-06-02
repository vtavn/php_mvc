<?php
class Request{
    private $__rules = [], $__messages = [], $__errors = [];
    public $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getMethod(){
         return strtolower($_SERVER['REQUEST_METHOD']);
     }

     public function isPost(){
         if ($this->getMethod()=='post'){
             return true;
         }
         return false;
     }

     public function isGet(){
         if ($this->getMethod()=='get'){
             return true;
         }
         return false;
     }

     public function getFields(){
         $dataField = [];
         if ($this->isGet()){
             if (!empty($_GET)){
                 foreach ($_GET as $key => $value){
                     if (is_array($value)){
                         $dataField[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                     }else{
                         $dataField[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                     }
                 }
             }
         }
         if ($this->isPost()){
             if (!empty($_POST)){
                 foreach ($_POST as $key => $value){
                     if (is_array($value)){
                         $dataField[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                     }else{
                         $dataField[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                     }             }
             }
         }
        return $dataField;
     }
    // set rules
    public function rules($rules=[]){
        $this->__rules = $rules;

    }

    //set message
    public function message($messages=[]){
        $this->__messages = $messages;
    }

    // run validate
    public function validate(){
        $this->__rules = array_filter($this->__rules);
        $checkValidate = true;
        if (!empty($this->__rules)){
            $dataField = $this->getFields();
            foreach ($this->__rules as $fieldName => $ruleItem){
                $ruleItemArr = explode('|', $ruleItem);
                foreach ($ruleItemArr as $rules){
                    $ruleName = null;
                    $ruleValue = null;

                    $rulesArr = explode(':', $rules);
                    $ruleName = reset($rulesArr);
                    if (count($rulesArr)>1){
                        $ruleValue = end($rulesArr);
                    }
                    if ($ruleName=='required'){
                        if (empty(trim($dataField[$fieldName]))){
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName=='min'){
                        if (strlen(trim($dataField[$fieldName]))<$ruleValue){
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName=='max'){
                        if (strlen(trim($dataField[$fieldName]))>$ruleValue){
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName=='email') {
                        if (!filter_var($dataField[$fieldName], FILTER_VALIDATE_EMAIL)) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName=='match'){
                        if (trim($dataField[$fieldName]) != trim($dataField[$ruleValue])){
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if ($ruleName=='unique'){
                        $tableName = null;
                        $fieldCheck = null;
                        if (!empty($rulesArr[1])){
                            $tableName = $rulesArr[1];
                        }
                        if (!empty($rulesArr[2])){
                            $fieldCheck = $rulesArr[2];
                        }

                        if (!empty($tableName) && !empty($fieldCheck)){
                            if (count($rulesArr)==3) {
                                $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataField[$fieldName]'")->rowCount();
                            }elseif(count($rulesArr)==4) {
                                if (!empty($rulesArr[3]) && preg_match('~.+?=.+?~is', $rulesArr[3])){
                                    $conditionWhere = $rulesArr[3];
                                    $conditionWhere = str_replace('=', '<>', $conditionWhere);
                                    $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataField[$fieldName]' AND $conditionWhere")->rowCount();
                                }
                            }
                            if (!empty($checkExist)){
                                $this->setErrors($fieldName, $ruleName);
                                $checkValidate = false;
                            }
                        }

                        // callback validate
                        if (preg_match('~^callback_(.+)~is', $ruleName, $callbackArr)){
                            if (!empty($callbackArr[1])){
                                $callbackName = $callbackArr[1];
                                $controller = App::$app->getCurrentController();
                                if (method_exists($controller, $callbackName)){
                                    $checkCallback = call_user_func_array([$controller, $callbackName], [trim($dataField[$fieldName])]);
                                    if (!$checkCallback){
                                        $this->setErrors($fieldName, $ruleName);
                                        $checkValidate = false;
                                    }
                                }
                            }
                        }


                    }
                }
            }
        }
        return $checkValidate;
    }

    //errors
    public function errors($fieldName=''){
        if (!empty($this->__errors)){
            if (empty($fieldName)) {
                $errorsArr = [];
                foreach ($this->__errors as $key=>$error){
                    $errorsArr[$key] = reset($error);
                }
                return $errorsArr;
            }
            return reset($this->__errors[$fieldName]);
        }
        return false;
    }

    //set errors
    public function setErrors($fieldName, $ruleName){
        $this->__errors[$fieldName][$ruleName] = $this->__messages[$fieldName.'.'.$ruleName];
    }
}
