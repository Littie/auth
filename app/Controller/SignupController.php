<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Interfaces\Response as ResponseInterface;
use App\Core\RedirectResponse;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\FormModel\RegistrationModel;
use App\Repository\DBUserRepository;
use App\Repository\UserRepositoryInterface;

/**
 * Class SignupController
 *
 * @package App\Controller
 */
class SignupController
{
    private UserRepositoryInterface $userRepository;

    public function __construct()
    {
        $this->userRepository = new DBUserRepository();
    }

    public function index(Request $request): ResponseInterface
    {
        $registrationModel = new RegistrationModel();
        $registrationModel->loadData($request->getBody());

        $registrationModel->validate();

        if ($registrationModel->hasErrors()) {
            return new Response(View::make('/register', [
                'errors' => $registrationModel->getErrors()
            ]));
        }

        $user = $this->userRepository->create($registrationModel);

        return (new RedirectResponse('/home'))->setCookie('token', $registrationModel->getPassword());
    }
}
