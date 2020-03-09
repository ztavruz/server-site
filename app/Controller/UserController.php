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
        $this->jsonData = json_decode(file_get_contents("php://input"), true);
        $this->jsonPost = json_decode($_POST["user"], true);
    }

    public function signup()
    {
        $dto = new SignupDto();
        $data = $this->jsonPost;

        $dto->email = $data['login'];
        $dto->bankCard = $data['bankCard'];
        $dto->phone = $data['phone'];
        $dto->password = $data['password'];
        $dto->login = $data['login'];

        $user = $this->userService->signup($dto);



        $response = json_encode([
            'id' => $user->getId(),
            'login' => $user->getLogin(),
            'status' => $user->getStatus(),
            'jwt' => $user->getJwt()
        ]);

//        return $response;
        var_dump($response);
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

//        return $response;
        var_dump($response);
    }
}