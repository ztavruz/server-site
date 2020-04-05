<?php

echo 123;

//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//
//require_once dirname(__DIR__) . "/vendor/autoload.php";
//
//use App\Controller\UserController;
//use App\Controller\FilesController;
//use App\Controller\TaskController;
//use App\Helper\Tester;
//use App\Repository\FileRepository;
//use App\Repository\TaskRepository;
//use App\Repository\UserRepository;
//use App\Service\User\UserService;
//use App\Service\File\FileService;
//use App\Service\Task\TaskService;
//use App\Storage\SessionStorage;
//use Engine\Container\Container;
//use Engine\Router\Router;
//use App\Database\Connection;
//
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Credentials: true");
//
//
//$router = new Router();
//$router->add("/signup",        UserController::class,  'signup', "C");
//$router->add("/login",         UserController::class,  "login");
//$router->add("/files/upload",  FilesController::class, "upload");
//$router->add("/files/display", FilesController::class, "display");
//$router->add("/task/create",   TaskController::class,  "create");
//$router->add("/task/list",     TaskController::class,  "list");
//
//
//$router->add("/tester/jwtencode",   Tester::class,  "jwtencode");
//$router->add("/tester/jwtdecode",   Tester::class,  "jwtdecode");
//$router->add("/tester/jwtverify",   Tester::class,  "jwtverify");
//
//$container = new Container();
//
////connect
//$container->set(Connection::class, function(Container $container){
//    return new Connection();
//});
//
////user
//$container->set(UserRepository::class, function (Container $container) {
//    return new UserRepository($container->get(Connection::class));
//});
//$container->set(UserService::class, function (Container $container) {
//    return new UserService($container->get(UserRepository::class),
//                           $container->get(SessionStorage::class));
//});
//$container->set(UserController::class, function (Container $container) {
//    return new UserController($container->get(UserService::class));
//});
//$container->set(SessionStorage::class, function(Container $container) {
//    return new SessionStorage();
//});
//
////files
//$container->set(FileRepository::class, function(Container $container){
//   return new FileRepository($container->get(Connection::class));
//});
//$container->set(FileService::class, function(Container $container){
//    return new FileService($container->get(FileRepository::class));
//});
//$container->set(FilesController::class, function(Container $container){
//    return new FilesController($container->get(FileService::class));
//});
//
////task
//$container->set(TaskRepository::class, function(Container $container){
//   return new TaskRepository($container->get(Connection::class));
//});
//$container->set(TaskService::class, function(Container $container){
//    return new TaskService($container->get(TaskRepository::class),
//                            $container->get(UserRepository::class),
//                             $container->get(FileRepository::class));
//});
//$container->set(TaskController::class, function(Container $container){
//    return new TaskController($container->get(TaskService::class));
//});
//
////tester
//$container->set(Tester::class, function(Container $container){
//    return new Tester();
//});
//
//
//$match = $router->match(preg_replace("#\?.*#", null, $_SERVER['REQUEST_URI']));
//
//$controller = $container->get($match["_controller"]);
//$method = $match['_method'];
//
//$response = $controller->$method();