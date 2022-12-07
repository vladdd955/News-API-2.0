<?php



namespace App\Services;


session_start();


use App\Navigation;
use Doctrine\DBAL\Connection;





class RegisterService
{
    private Connection $connection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'news api',
            'user' => 'root',
            'password' => 'nishiki555',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        $this->connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    }

        public function execute(RegisterServiceRequest $request)
    {
         $emailCheck = $request->getEmail();
        $emailToData = $this->connection->executeQuery("SELECT email FROM users WHERE email = '$emailCheck' " )->rowCount();
        if($emailToData == 1){
            die;
        }
                $this->connection->insert(
                    "users",
                    [
                        "name"=>$request->getName(),
                        "email"=>$request->getEmail(),
                        "password"=>$request->getPassword(),
                    ]
                );
    }

    public function checkInLogin(): Navigation
    {
        $email =   $_POST['email'];
        $password = md5($_POST['password']);


        $result = $this->connection->executeQuery('SELECT  * FROM users WHERE email = ?', [$email]);
        $user = $result->fetchAssociative();


        if ($email == $user['email'] && $user['password'] == $password) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $user['id'];


            return new Navigation("/userPage");
        } else {
            return new Navigation("/");

        }
    }


}

