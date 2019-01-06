<?php

namespace daib17\User;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
* A database driven model using the Active Record design pattern.
*/
class User extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "User";


    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $acronym;
    public $name;
    public $email;
    public $password;
    public $gravatar;
    public $created;


    /**
    * Set the password.
    *
    * @param string $password the password to use.
    *
    * @return void
    */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }


    /**
    * Verify the acronym and the password, if successful the object contains
    * all details from the database row.
    *
    * @param string $acronym  acronym to check.
    * @param string $password the password to use.
    *
    * @return boolean true if acronym and password matches, else false.
    */
    public function verifyPassword($acronym, $password)
    {
        $this->find("acronym", $acronym);
        return password_verify($password, $this->password);
    }


    /**
    * Generate gravatar.
    */
    public function setGravatar() {
        $hash = md5(strtolower(trim($this->email)));
        $this->gravatar = "https://www.gravatar.com/avatar/" . $hash . "?d=retro";
    }


    /**
    * Generate acronym with first 4 characters from name + index.
    */
    public function setAcronym() {
        $i = 1;
        $base = strtolower(substr($this->name, 0, 4));
        $acronym = $base . $i;
        $res = $this->find("acronym", $acronym);
        if ($res) {
            do {
                $i++;
                $acronym = $base . $i;
                // Check availability
                $res = $this->find("acronym", $acronym);
            } while ($res);
        }
        $this->acronym = $acronym;
    }
}
