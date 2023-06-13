<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\Response as ResponseInterface;

/**
 * Class Application
 *
 * @package App\Core
 */
class Application
{
    private Router $router;

    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run(): ResponseInterface
    {
        return $this->router->resolve();
    }
}
