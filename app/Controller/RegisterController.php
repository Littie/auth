<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Interfaces\Response as ResponseInterface;
use App\Core\RedirectResponse;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Service\AuthService;

/**
 * Class RegisterController
 *
 * @package App\Controller
 */
class RegisterController
{
    public function index(Request $request): ResponseInterface
    {
        $authService = new AuthService($request);

        if ($authService->isAuthorized()) {
            return new RedirectResponse('/home');
        }

        return new Response(View::make('register'));
    }
}
