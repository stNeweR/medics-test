<?php

namespace Kernel\Http;

use App\Database\Database;

class Validator
{

    protected $data;
    protected $errors;

    public function validate(array $rules, mixed $data)
    {
        $this->data = $data;

        foreach ($rules as $field => $ruleList) {
            $this->validateField($field, $ruleList);
         }

        return $this->errors ? ['errors'=> $this->errors] : $data;
    }

    protected function validateField(string $field, array $rules)
    {
        foreach ($rules as $rule) {
            if (!$this->validateRule($field, $rule)) {
//                $this->errors[$field] = "The $field field is invalid.";
                return;
            }
        }
    }

    protected function validateRule(string $field, string $rule): bool
    {
        $parts = explode(':', $rule);
        $ruleName = $parts[0];
        $ruleParam = $parts[1] ?? null;

        switch ($ruleName) {
            case 'required':
                if (empty($this->data[$field])) {
                    $this->errors[$field] = "Вы не задали поле: $field";
                    return false;
                }
                return true;
            case 'min':
                if (strlen($this->data[$field]) < (int)$ruleParam) {
                    $this->errors[$field] = "Поле $field должно быть длиннее $ruleParam";
                    return false;
                }
                return true;
            case 'max':
                if (strlen($this->data[$field]) > (int)$ruleParam) {
                    $this->errors[$field] = "Поле $field должно быть короче $ruleParam";
                    return false;
                }
                return true;
            case 'personPhone':
                $pattern = "/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/";
                if (!preg_match($pattern, $this->data[$field])) {
                    $this->errors[$field] = "Телефон должен быть вот такого формата +7 (777) 777-77-77";
                    return false;
                }
                return true;
            case 'departmentPhone':
                $pattern = "/^\d{3}-\d{2}-\d{2}$/";
                if (!preg_match($pattern, $this->data[$field])) {
                    $this->errors[$field] = "Телефон должен быть вот такого формата 777-77-77";
                    return false;
                }
                return true;
            case 'unique':
                $value = $this->data[$field];
                $table = $ruleParam;
                $db = new Database();
                $phones = $db->get($table, [$field =>  $value]);

                if (empty($phones)) {
                    return true;
                }

                $this->errors[$field] = "Поле $field не уникальное";
                return false;
            default:
                return true;
        }
    }
}