<?php


namespace App\Controller;


use App\Service\User\UserService;
use App\Service\User\LoginDto;
use App\Service\User\SignupDto;

class UserController
{
    private $userService;
    private $jsonData;
    private $jsonPost;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
//        $this->jsonData = json_decode(file_get_contents("php://input"), true);
        $this->jsonPost = json_decode($_POST["user"], true);
    }

    public function signup()
    {
        $dto = new SignupDto();
        $data = $this->jsonPost;

        $dto->email = $data['email'];
        $dto->password = $data['password'];
        $dto->name = $data['name'];

        $user = $this->userService->signup($dto);

        $response = [
          "id" => $user->getId(),
          "name" => $user->getName(),
          "email" => $user->getEmail(),
          "status" => $user->getStatus(),
          "jwt" => $user->getJwt(),
        ];

        echo json_encode($response);
    }

    public function login()
    {
        $dto = new LoginDto();
        $data = $this->jsonPost;

        $dto->login = $data['login'];
        $dto->password = $data['password'];

        $user = $this->userService->login($dto);

        $response = json_encode([

            "jwt" => $user->getJwt()
        ]);


    }
}