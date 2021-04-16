<?php

namespace Source\Utils;

class Session {
    private static ?self $instance = null;

    public static function getInstance () {
        if (! self::$instance)
            return self::$instance = new self;
        
        return self::$instance;
    }

    public function pull (string $name) {
        if ($this->has($name)) {
            $value = $this->get($name);
            $this->remove($name);
            return $value;
        }

        return null;
    }

    public function has (string $name) {
        return $_SESSION[$name] !== null;
    }

    public function get (string $name) {
        return $_SESSION[$name];
    }

    public function set (string $name, $value) {
        return $_SESSION[$name] = $value;
    }

    public function put (array $values) {
        foreach ($values as $name => $value) {
            $this->set($name, $value);
        }
    }

    public function remove (string $name): self {
        unset($_SESSION[$name]);
        return $this;
    }
}