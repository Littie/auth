<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Class Request
 *
 * @package App\Core
 */
class Request
{
    public function getUri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getCookies(): array
    {
        $params = [];
        foreach ($_COOKIE as $key => $value) {
            $params[$key] = \filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $params;
    }

    public function getBody(): array
    {
        $params = [];

        foreach ($_POST as $key => $value) {
            $params[$key] = \filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $params;
    }
}
