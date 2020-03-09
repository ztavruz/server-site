<?php


namespace App\Repository;

use App\Database\Connection;
use App\Entity\User;
use App\Helper\PropertyObject;
use App\Security\Token\Token;
use RedBeanPHP\R as R;

class UserRepository
{
    private $connect;
    private $tableName;
    private $jwt;

    public function __construct(Connection $connection)
    {
        $this->connect = new $connection;
        $this->tableName = "users";
        $this->jwt = new Token();
    }

    public function create(User $user)
    {
        $data = $this->findOneBy("login", $user->getLogin());
        $password = $user->getPassword();


        if($data == null){
            $table = R::dispense($this->tableName);
            $table->login = $user->getLogin();
            $table->password = password_hash($password, PASSWORD_DEFAULT);
            $table->email = $user->getEmail();
            $table->phone = $user->getPhone();
            $table->bank_card = $user->getBankCard();
            $table->status = $user->getStatus();        //задается по умолчанию
            $table->jwt   =  null;
            R::store($table);

            $bean = $this->findOneBy("login", $user->getLogin());
            $payload = [
                "id" => $bean["id"],
                "login" => $bean["login"],
                "status" => $bean["status"]
            ];

            $bean->jwt = $this->jwt->encode($payload, 36000);
            R::store($bean);

            $user = $this->findOneBy("login", $user->getLogin());
            $user = $this->convertToObject($user);
            return $user;

        }else{
            throw new \LogicException("Пользователь с таким логином уже зарегистрирован!");
        }

    }

    public function login(User $user)
    {
        $data = R::findOne($this->tableName, "login = :login", ["login" => $user->getLogin()]);


        if($data)
        {

            $verify = $user->verifyPassword($data['password']);

            if($verify){

                $bean = R::findOne($this->tableName, "login = :login", ["login" => $user->getLogin()]);

                $payload = [
                    "id" => $bean["id"],
                    "login" => $bean["login"],
                    "status" => $bean["status"]
                ];

                $bean->jwt = $this->jwt->encode($payload, 36000);
                R::store($bean);

                $user = $this->findOneBy("login", $user->getLogin());

                return $user;

            }else{
                throw new \LogicException("Пароли не совпадают!");
            }
        }else{
            throw new \LogicException("Пользователь с таким логином не найден");
        }

    }


    public function findOneBy($field, $value , $typeData = "object")
    {

        $data = R::findOne ($this->tableName, "{$field} = ?", array($value));
        if($data)
        {
            return $data;
        }else{
            return null;
        }


    }

    public function convertToObject($data)
    {
        $user = new User();

        $user->setId($data["id"]);
        $user->setLogin($data["login"]);
        $user->setPassword($data["password"]);
        $user->setStatus($data["status"]);
        $user->setJwt($data["jwt"]);

        return $user;
    }










    //---------------OLD_CODE------------------//

    public function getAll($typeDate = "")
    {
        if($typeDate == "")
        {
            $data = R::getAll("SELECT * FROM $this->tableName ");
        }else{
            $bind = [];
            $type = "";
            foreach($typeDate as $key => $value)
            {
                $bind[$key] = $value;
                $type = $key;
            }


            $data = R::getAll("SELECT * FROM `{$this->tableName}` WHERE  `{$type}` = :{$type}  ", $bind );
        }

        return $data;
    }

    public function getOne($keyValue)
    {
        $item = null;
        $bind = $keyValue;
        foreach ($bind as $key => $keyValue) {
            $item = R::findOne ($this->tableName, "{$key} = ?", array($keyValue));
        }

        return $item;
    }

    public function delete($id)
    {

        $deleted = R::load($this->tableName, $id);
        R::trash($deleted);
    }


    public function deleteOne($pole, $value)
    {

        $books = R::find("{$this->tableName}", " '{$pole}' = ?", [$value]);

    }

    public function update($id, $pole, $newValue)
    {
        $table = R::load($this->tableName, $id);
        $table->$pole = $newValue;
    }

    //ready
    public function getCount($typeDate = "")
    {
//        var_dump($typeDate);
        if($typeDate == "")
        {
            $data = R::count($this->tableName);
        }else{
            $type = '';
            $val = '';
            foreach($typeDate as $key => $value)
            {
                $type = $key;
                $val = $value;
            }


            $data = R::count($this->tableName,"{$type} = ?" , array($val) );
        }

        return $data;
    }
}