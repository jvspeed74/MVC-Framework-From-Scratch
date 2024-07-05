<?php

namespace PhpWebFramework\models\dto;

/**
 * Class User
 *
 * Data Transfer Object for the Users Table
 */
class User
{
    private ?string $userID = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;
    private ?string $userName = null;
    private ?string $password = null;
    private string $roleID = '0';  // Default role (No privileges)
    
    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    
    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }
    
    /**
     * @return string|null
     */
    public function getUserID(): ?string
    {
        return $this->userID;
    }
    
    /**
     * @param string|null $userID
     */
    public function setUserID(?string $userID): void
    {
        $this->userID = $userID;
    }
    
    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    
    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }
    
    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
    
    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }
    
    /**
     * @param string|null $userName
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }
    
    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
    
    /**
     * @return string|null
     */
    public function getRoleID(): ?string
    {
        return $this->roleID;
    }
    
    /**
     * @param string|null $roleID
     */
    public function setRoleID(?string $roleID): void
    {
        $this->roleID = $roleID;
    }
}
