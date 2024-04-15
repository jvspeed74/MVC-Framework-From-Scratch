<?php
/**
 * File: User.php
 * Created By: Jalen Vaughn
 * Date: 4/14/2024
 * Description: Data transfer object for a User.
 */


class User {
    private string $userID;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $userName;
    private string $password;
    private string $roleID;
    
    /**
     * @return string
     */
    public function getFirstName(): string {
        return $this->firstName;
    }
    
    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }
    
    /**
     * @return string
     */
    public function getLastName(): string {
        return $this->lastName;
    }
    
    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }
    
    /**
     * @return string
     */
    public function getUserName(): string {
        return $this->userName;
    }
    
    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void {
        $this->userName = $userName;
    }
    
    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }
    
    /**
     * @param string $email
     */
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    
    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }
    
    /**
     * @param string $password
     */
    public function setPassword(string $password): void {
        $this->password = $password;
    }
    
    /**
     * @return string
     */
    public function getRoleID(): string {
        return $this->roleID;
    }
    
    /**
     * @param string $roleID
     */
    public function setRoleID(string $roleID): void {
        $this->roleID = $roleID;
    }
    
    /**
     * @return string
     */
    public function getUserID(): string {
        return $this->userID;
    }
    
    /**
     * @param string $userID
     */
    public function setUserID(string $userID): void {
        $this->userID = $userID;
    }
}
