<?php

namespace App\UseCases\Auth\DataTransferObjects;

class BackendLoginData
{
    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly bool $remember
    ) {
    }

    /**
     * @param array{username:string,password:string,remember?:bool} $attributes
     */
    public static function fromArray(array $attributes): self
    {
        return new self(
            username: $attributes['username'],
            password: $attributes['password'],
            remember: (bool) ($attributes['remember'] ?? false),
        );
    }
}
