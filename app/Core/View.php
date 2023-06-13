<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Class View
 *
 * @package App\Core
 */
class View
{
    private string $path;
    private string $view;
    private array $data;

    public function __construct(string $view, array $data = [])
    {
        $this->path = BASE_DIR . '/views/';
        $this->view = $view;
        $this->data = $data;
    }

    public static function make($view, $data = []): self
    {
        return new View($view, $data);
    }

    public function render(): string
    {
        foreach ($this->data as $key => $value) {
//            \print_r($$key = $value); die;
            $$key = $value;
        }

        \ob_start();

        include_once $this->path . $this->view . '.php';

        return \ob_get_clean();
    }
}
