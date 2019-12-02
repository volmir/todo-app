<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="todo")
 */
class Todo
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /** 
     * @ORM\Column(type="string") 
     */
    protected $username;
    
    /** 
     * @ORM\Column(type="string") 
     */
    protected $email;   
    
    /** 
     * @ORM\Column(type="text") 
     */
    protected $description;    
    
    /** 
     * @ORM\Column(type="integer") 
     */
    protected $status;  
    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}