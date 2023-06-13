<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Class Validator
 *
 * @package App\Core
 */
class Validator
{
    public function required(string $value): bool
    {
        return !empty($value);
    }
}
