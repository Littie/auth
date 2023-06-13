<?php
declare(strict_types=1);

namespace App\Service;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Repository\DBUserRepository;
use App\Repository\UserRepositoryInterface;

/**
 * Class AuthService
 *
 * @package App\Service
 */
class AuthService
{
    private Request $request;
    private UserRepositoryInterface $userRepository;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->userRepository = new DBUserRepository();
    }

    public function isAuthorized(): bool
    {
        $cookies = $this->request->getCookies();

        if (isset($cookies['token'])) {
            $user = $this->userRepository->findByToken($cookies['token']);

            return (null !== $user);
        }

        return false;
    }
}
