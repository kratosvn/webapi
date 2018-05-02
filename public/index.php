<?php

require_once '../Controller/UserApiController.php';
use WebApi\Controller\UserApiController;

define('GET_METHOD', 'GET');
define('POST_METHOD', 'POST');

main();

function authenticate()
{
    //Todo:: check session or jwt token login of user
    return true;
}

function main()
{
    if (authenticate()) {
        $method = $_SERVER['REQUEST_METHOD'];
        $userApiController = new UserApiController();

        switch ($method) {
            case GET_METHOD:
                $userApiController->get();
                break;

            case POST_METHOD:
                $userApiController->update();
                break;
            default:
                //method not allowed
                http_response_code(405);
                die;
        }
    }

    //Unauthorized
    http_response_code(401);
}
