<?php
declare(strict_types=1);

namespace App\Repository;

use App\Core\Database;
use App\FormModel\LoginModel;
use App\FormModel\RegistrationModel;
use App\Model\User;

/**
 * Class DBUserRepository
 *
 * @package App\Repository
 */
class DBUserRepository implements UserRepositoryInterface
{
    private const TABLE_NAME = 'users';

    private Database $connection;

    public function __construct()
    {
        $this->connection = new Database();
    }

    public function create(RegistrationModel $model): bool
    {
        $data = [
            'first_name' => $model->getFirstName(),
            'last_name' => $model->getLastName(),
            'email' => $model->getEmail(),
            'phone' => $model->getPhone(),
            'password' => $model->getPassword()
        ];

        $this->connection->create(self::TABLE_NAME, $data);

        return true;
    }

    public function findByEmail(string $email): ?User
    {
        $result = $this->connection->selectWhereFirst(self::TABLE_NAME, 'email', $email);

        if (empty($result)) {
            return null;
        }

        return $this->makeUserModel($result);
    }

    public function findByToken(string $token): ?User
    {
        $result = $this->connection->selectWhereFirst(self::TABLE_NAME, 'password', $token);

        if (empty($result)) {
            return null;
        }

        return $this->makeUserModel($result);
    }

    private function makeUserModel(array $result): User
    {
        $user = new User();
        $user->setFirstName($result['first_name']);
        $user->setLastName($result['last_name']);
        $user->setEmail($result['email']);
        $user->setPhone($result['phone']);
        $user->setPassword($result['password']);

        return $user;
    }
}
