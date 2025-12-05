<?php 

class User {
    private int $id;
    private string $name;
    private string $email;
    private string $role;
    private string $registration_date;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }


    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function getRegistration_date()
    {
        return $this->registration_date;
    }

    public function setRegistration_date($registration_date)
    {
        $this->registration_date = $registration_date;

        return $this;
    }

    public function __construct(){}

}


?>