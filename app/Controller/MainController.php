<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Response;
use App\Core\View;

/**
 * Class MainController
 *
 * @package App\Controller
 */
class MainController
{
    public function index(): Response
    {
        return new Response(View::make('/main'));
    }
}
