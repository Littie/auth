<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;

/**
 * Class FormController
 *
 * @package App\Controller
 */
class LoginController
{
    public function index(Request $request): Response
    {
        return new Response(View::make('login'));
    }
}
