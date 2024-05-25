<?php

namespace Kernel\Http;

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
                $this->errors[$field] = "The $field field is invalid.";
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
                return !empty($this->data[$field]);
            case 'min':
                return strlen($this->data[$field]) >= (int)$ruleParam;
            case 'max':
                return strlen($this->data[$field]) <= (int)$ruleParam;
            default:
                return true;
        }
    }}