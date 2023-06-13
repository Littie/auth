<?php
declare(strict_types=1);

namespace App\FormModel;

use App\Core\Validator;

/**
 * Class Model
 *
 * @package App\FormModel
 */
abstract class Model
{
    private Validator $validator;
    private array $errors = [];

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function loadData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (\property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract protected function rules(): array;

    public function validate(): void
    {

        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule => $message) {
                if (!$this->validator->{$rule}($value)) {
                    $this->errors[$attribute] = $message;
                }
            }
        }
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
