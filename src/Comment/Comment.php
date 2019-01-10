<?php

namespace daib17\Comment;

use Anax\DatabaseActiveRecord\ActiveRecordModel;
use daib17\User\User;

/**
* A database driven model using the Active Record design pattern.
*/
class Comment extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Comment";


    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    * @var string $body body text.
    * @var string $questionid questions's id.
    * @var string $answerid questions's id.
    * @var string $userid user's id.
    * @var string $created date of creation.
    */
    public $id;
    public $body;
    public $questionid;
    public $answerid;
    public $userid;
    public $created;


    /**
    * Get user that created this comment.
    *
    * @return User
    */
    public function getUser() {
        $user = new User();
        $user->setDb($this->db);
        $user->find("id", $this->userid);
        return $user;
    }
}
