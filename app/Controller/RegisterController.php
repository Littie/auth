<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Response;
use App\Core\View;

/**
 * Class RegisterController
 *
 * @package App\Controller
 */
class RegisterController
{
    public function index(): Response
    {
        return new Response(View::make('register'));
    }
}
