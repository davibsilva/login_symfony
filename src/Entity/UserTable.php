<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserTableRepository")
 */
class UserTable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $twoFactor;

    /**
     * @ORM\Column(type="integer")
     */
    public $teoFactorCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTwoFactor(): ?bool
    {
        return $this->twoFactor;
    }

    public function setTwoFactor(bool $twoFactor): self
    {
        $this->twoFactor = $twoFactor;

        return $this;
    }

    public function getTeoFactorCode(): ?int
    {
        return $this->teoFactorCode;
    }

    public function setTeoFactorCode(?int $teoFactorCode): self
    {
        $this->teoFactorCode = $teoFactorCode;

        return $this;
    }
}
