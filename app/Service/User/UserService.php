<?php

namespace App\Service\User;


use App\Entity\User;
use App\Repository\UserRepository;
use App\Security\Token\Token;
use App\Storage\SessionStorage;

class UserService
{
    private $repository;
    /**
     * @var SessionStorage
     */
    private $jwt;

    public function __construct(UserRepository $repository, SessionStorage $storage)
    {
        $this->repository = $repository;
        $this->jwt = new Token();
    }

    //testable
    public function signup(SignupDto $dto): User
    {
        $user = new User();
        $user->setLogin($dto->login);
        $user->setPassword($dto->password);
        $user->setEmail($dto->email);
        $user->setPhone($dto->phone);
        $user->setBankCard($dto->bankCard);

        $user = $this->repository->create($user);

        return $user;
    }

    public function login(LoginDto $dto)
    {
        $user = new User();
        $user->setLogin($dto->login);
        $user->setPassword($dto->password);

        $user = $this->repository->login($user);

        if ($user != null) {
            return $user;
        }

        if (!$user) {
            throw new \DomainException("Пользователь с таким логином не найден!(User not found) ");

        }
    }


}