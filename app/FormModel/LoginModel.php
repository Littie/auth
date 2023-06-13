<?php
declare(strict_types=1);

namespace App\FormModel;

/**
 * Class LoginModel
 *
 * @package App\FormModel
 */
class LoginModel extends Model
{
    protected string $email;
    protected string $password;

    protected function rules(): array
    {
        return [
            'email' => ['required' => 'Email is required'],
            'password' => ['required' => 'Password is required']
        ];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
