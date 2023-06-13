<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\RedirectResponse;

/**
 * Class LogoutController
 *
 * @package App\Controller
 */
class LogoutController
{
    public function index(): RedirectResponse
    {
        return (new RedirectResponse('/'))->deleteCookie('token');
    }
}
