<?php


namespace App\Entity;


class User
{
    public const STATUS_ADMIN = "A";
    public const STATUS_USER = "B";
    public const STATUS_GUEST = "C";

    private $id;
    private $login;
    private $password;

    public $phone;
    public $email;
    public $bankCard;

    private $status;
    private $jwt;



    public function __construct()
    {
        $this->status = self::STATUS_USER;
    }

    public function verifyPassword($password)
    {
        return password_verify($this->password, $password);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }



    /**
     * @return mixed
     */
    public function getJwt()
    {
        return $this->jwt;
    }

    /**
     * @param mixed $jwt
     */
    public function setJwt($jwt): void
    {
        $this->jwt = $jwt;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBankCard()
    {
        return $this->bankCard;
    }

    /**
     * @param mixed $bankCard
     */
    public function setBankCard($bankCard): void
    {
        $this->bankCard = $bankCard;
    }
}