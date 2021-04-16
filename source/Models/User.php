<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class User extends Model {
    public function __construct () {
        parent::__construct("users", self::getAttributes());
    }

    public static function getAttributes (): array {
        return [
            "first_name",
            "last_name",
            "email",
            "password",
        ];
    }

    public static function validate ($data = null): ?string {
        $password = $data['password'];
        $password_confirmation = $data['password_confirmation'];
        $email = $data['email'];

        if (self::dataIsEmpty($data)) 
            return 'Fill all the data before send it';

        if (self::emailIsInvalid($email))
            return 'Email is invalid.';

        if (self::emailExists($email))
            return 'Emails already exists';

        if (self::passwordsAreInvalid($password, $password_confirmation))
            return 'Passwords doesn\'t match.';

        return null;
    }

    public function validateBeforeSave (): ?string {
        if (self::isEmpty($this->first_name))
            return 'First Name was not filled';

        if (self::isEmpty($this->last_name))
            return 'First Name was not filled';

        return null;
    }

    public static function passwordsAreInvalid ($pass, $pass_confirm): bool {
        return $pass != $pass_confirm;
    }

    public static function emailIsInvalid ($email): bool {
        return ! filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function emailExists ($email): bool {
        return (new self())->find("email = :e", "e=$email")->fetch() ? true : false;
    }

    public static function dataIsEmpty (array $data): bool {
        foreach (self::getAttributes() as $attr_name) {
            if (self::isEmpty($data[$attr_name]))
                return true;
        }

        return false;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function fullName() {
        return $this->first_name . " " . $this->last_name;
    }

    public static function isEmpty (string $firstName) {
        return is_null($firstName) || empty($firstName);
    }
}