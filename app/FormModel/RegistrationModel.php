<?php
declare(strict_types=1);

namespace App\FormModel;

/**
 * Class RegistrationModel
 *
 * @package App\FormModel
 */
class RegistrationModel extends Model
{
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected string $phone;
    protected string $password;

    protected function rules(): array
    {
        return [
            'email' => ['required' => 'Email is required'],
            'password' => ['required' => 'Password is required']
        ];
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPassword(): string
    {
        return \password_hash($this->password, PASSWORD_DEFAULT);
    }
}
