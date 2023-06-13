<?php
declare(strict_types=1);

namespace App\Core;

use \App\Core\Interfaces\Response as ResponseInterface;

/**
 * Class Router
 *
 * @package App\Core
 */
class Router
{
    private Request $request;
    protected array $routes = [];

    public function __construct(Request $request)
    {
        require_once '../routes/web.php';

        $this->request = $request;
    }

    public function get(string $path, string $action): void
    {
        $this->addRoute('GET', $path, $action);
    }

    public function post(string $path, string $action): void
    {
        $this->addRoute('POST', $path, $action);
    }

    public function resolve(): ResponseInterface
    {
        [$controller, $action] = $this->resolveAction();

        $controller = new $controller();

        return \call_user_func_array([$controller, $action], [new Request()]);
    }

    public function addRoute(string $method, string $uri, string $action): void
    {
        $this->routes[$method][$uri] = $action;
    }

    private function resolveAction(): array
    {
        $uri = $this->request->getUri();
        $method = $this->request->getMethod();

        $path = $this->routes[$method][$uri] ?? null;

        if (null === $path) {
            throw new \Exception('Page not found');
        }

        return \explode('@', $path);
    }
}
