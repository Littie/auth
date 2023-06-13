<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\RedirectResponse;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Repository\DBUserRepository;
use App\Repository\UserRepositoryInterface;
use App\Core\Interfaces\Response as ResponseInterface;

/**
 * Class HomeController
 *
 * @package App\Controller
 */
class HomeController
{
    private UserRepositoryInterface $userRepository;

    public function __construct()
    {
        $this->userRepository = new DBUserRepository();
    }

    public function index(Request $request): ResponseInterface
    {
        $cookies = $request->getCookies();

        if (isset($cookies['token'])) {
            $user = $this->userRepository->findByToken($cookies['token']);

            if (null !== $user) {
                return new Response(View::make('home'));
            }
        }

        return new RedirectResponse('/');
    }
}
