<?php
declare(strict_types=1);

namespace App\Repository;

use App\FormModel\RegistrationModel;
use App\Model\User;

interface UserRepositoryInterface
{
    public function create(RegistrationModel $model): bool;

    public function findByEmail(string $email): ?User;

    public function findByToken(string $token): ?User;
}
