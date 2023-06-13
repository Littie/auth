<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\Response as ResponseInterface;

/**
 * Class RedirectResponse
 *
 * @package App\Core
 */
class RedirectResponse implements ResponseInterface
{
    private string $to = '/';

    public function __construct(string $to)
    {
        $this->to = $to;
    }

    public function setCookie(string $name, string $value): self
    {
        setcookie($name, $value);

        return $this;
    }

    public function deleteCookie(string $name): self
    {
        setcookie($name, '', time()-3600);

        return $this;
    }

    public function send(): void
    {
        $this->sendHeaders();
    }

    private function sendHeaders(): void
    {
        \header("Location:$this->to", true, self::HTTP_FOUND);
    }
}
