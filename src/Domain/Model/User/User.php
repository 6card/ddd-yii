<?php

namespace App\Domain\Model\User;

class User
{
    private int $id;
    private string $email;
    private string $passwordHash;

    private function __construct(int $id, string $email, string $passwordHash)
    {
        $this->id = $id;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public static function reconstitute(int $id, string $email, string $passwordHash): self
    {
        return new self($id, $email, $passwordHash);
    }

    public function validatePassword(string $password): bool
    {
        return hash_equals($this->passwordHash, $this->hashFn($password));
    }

    private function setPassword(string $password): void
    {
        $this->passwordHash = $this->hashFn($password);
    }

    private function hashFn($password): string
    {
        return md5($password);
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPasswordHash(): string {
        return $this->passwordHash;
    }
}
