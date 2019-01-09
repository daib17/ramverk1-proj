<?php

namespace daib17\Question;

use Anax\DatabaseActiveRecord\ActiveRecordModel;
use daib17\User\User;
use daib17\Answer\Answer;
use daib17\Comment\Comment;

/**
* A database driven model using the Active Record design pattern.
*/
class Question extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Question";


    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    * @var string $title title.
    * @var string $body body text.
    * @var string $tags tags.
    * @var string $userid user's id.
    * @var string $created date of creation.
    */
    public $id;
    public $title;
    public $body;
    public $tags;
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
        return $comment->findAllWhere("questionid = ?", $this->id);
    }


    /**
    * Get answers.
    *
    * @return Answer array
    */
    public function getAnswers() {
        $answer = new Answer();
        $answer->setDb($this->db);
        return $answer->findAllWhere("questionid = ?", $this->id);
    }
}
