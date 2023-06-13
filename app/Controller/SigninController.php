<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Interfaces\Response as ResponseInterface;
use App\Core\RedirectResponse;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\FormModel\LoginModel;
use App\Repository\DBUserRepository;
use App\Repository\UserRepositoryInterface;

/**
 * Class SigninController
 *
 * @package App\Controller
 */
class SigninController
{
    private UserRepositoryInterface $userRepository;
    public function __construct()
    {
        $this->userRepository = new DBUserRepository();
    }

    public function index(Request $request): ResponseInterface
    {
        $loginModel = new LoginModel();
        $loginModel->loadData($request->getBody());

        $loginModel->validate();

        if ($loginModel->hasErrors()) {
            return new Response(View::make('/login', [
                'errors' => $loginModel->getErrors(),
            ]));
        }

        $user = $this->userRepository->findByEmail($loginModel->getEmail());

        if (null === $user || !\password_verify($loginModel->getPassword(), $user->getPassword())) {
            return new Response(View::make('/login', [
                'errors' => [
                    'password' => 'Incorrect email or password'
                ],
            ]));
        }

        return (new RedirectResponse('/home'))->setCookie('token', $user->getPassword());
    }
}
