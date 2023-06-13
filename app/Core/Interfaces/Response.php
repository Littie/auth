<?php
declare(strict_types=1);

namespace App\Core\Interfaces;

interface Response
{
    public const HTTP_OK = 200;
    public const HTTP_FOUND = 302;

    public function send(): void;
}
