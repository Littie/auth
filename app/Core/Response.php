<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\Response as ResponseInterface;

/**
 * Class Response
 *
 * @package App\Core
 */
class Response implements ResponseInterface
{
    private View $view;
    private string $header = 'Content-Type:text/html; charset=UTF-8';

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function send(): void
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    private function sendHeaders(): void
    {
        \header($this->header, true, self::HTTP_OK);
    }

    private function sendContent(): void
    {
        echo $this->view->render();
    }
}
