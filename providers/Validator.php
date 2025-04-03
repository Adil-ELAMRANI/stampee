<?php
namespace App\Providers;

class Validator {
    private $errors = [];
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null) {
        $this->key = $key;
        $this->value = $value;
        $this->name = $name ?? ucfirst($key);
        return $this;
    }

    public function required() {
        if (empty($this->value)) {
            $this->errors[$this->key] = "$this->name is required.";
        }
        return $this;
    }

    public function max($length) {
        if (strlen($this->value) > $length) {
            $this->errors[$this->key] = "$this->name must be less than $length characters.";
        }
        return $this;
    }

    public function min($length) {
        if (strlen($this->value) < $length) {
            $this->errors[$this->key] = "$this->name must be at least $length characters.";
        }
        return $this;
    }

    public function email() {
        if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->key] = "Invalid $this->name format.";
        }
        return $this;
    }

    public function unique($model) {
        $class = 'App\\Models\\' . $model;
        $instance = new $class;
        if ($instance->unique($this->key, $this->value)) {
            $this->errors[$this->key] = "$this->name must be unique.";
        }
        return $this;
    }

    public function isSuccess() {
        return empty($this->errors);
    }

    public function numeric() {
        if (!is_numeric($this->value)) {
            $this->errors[$this->key] = "$this->name doit être un nombre.";
        }
        return $this;
    } 

    public function getErrors() {
        return $this->errors;
    }

    public function int() {
        if (!filter_var($this->value, FILTER_VALIDATE_INT)) {
            $this->errors[$this->key] = "$this->name doit être un entier.";
        }
        return $this;
    }
    
}
