<?php

namespace daib17\Answer;

use Anax\DatabaseActiveRecord\ActiveRecordModel;
use daib17\User\User;
use daib17\Comment\Comment;

/**
* A database driven model using the Active Record design pattern.
*/
class Answer extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Answer";


    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    * @var string $body body text.
    * @var string $questionid questions's id.
    * @var string $userid user's id.
    * @var string $created date of creation.
    */
    public $id;
    public $body;
    public $questionid;
    public $userid;
    public $created;


    /**
    * Get user.
    *
    * @return User
    */
    public function getUser() {
        $user = new User();
        $user->setDb($this->db);
        $res =  $user->findAllWhere("id = ?", $this->userid);
        return (count($res) > 0) ? $res[0] : null;
    }


    /**
    * Get comments.
    *
    * @return Comment array
    */
    public function getComments()
    {
        $comment = new Comment();
        $comment->setDb($this->db);
        return $comment->findAllWhere("answerid = ?", $this->id);
    }
}
