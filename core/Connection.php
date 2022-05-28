<?php
class Connection
{
    private static $instance = null, $conn = null;

    private function __construct($config)
    {

        //connect
        try {
            $dsn = 'mysql:dbname='.$config['db'].';host='.$config['host'];

            $option = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            $con = new PDO($dsn, $config['user'], $config['pass'], $option);

            self::$conn = $con;

        } catch (Exception $exception){
            $msg = $exception->getMessage();

            if (preg_match('/Access denied for user/', $msg)){
                App::$app->loadError('database', ['msg' => 'Lỗi kết nối cơ sở dữ liệu.']);
                die();
            }

            if (preg_match('/Unknown database/', $msg)){
                App::$app->loadError('database', ['msg' => 'Không tìm thấy cơ sở dữ liệu.']);
                die();
            }
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null)
        {
            $connection = new Connection($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}