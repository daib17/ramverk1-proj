<?php

namespace daib17\Question;

use Anax\DatabaseActiveRecord\ActiveRecordModel;
use daib17\User\User;
use daib17\Answer\Answer;
use daib17\Comment\Comment;
use daib17\Tag\Tag;

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
    * Get user that created this question.
    *
    * @return User
    */
    public function getUser()
    {
        $user = new User();
        $user->setDb($this->db);
        $user->find("id", $this->userid);
        return $user;
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
    public function getAnswers()
    {
        $answer = new Answer();
        $answer->setDb($this->db);
        return $answer->findAllWhere("questionid = ?", $this->id);
    }


    /**
    * Get names of all tags as an array of strings.
    *
    * @return array of strings or null if no tags
    */
    public function getTags()
    {
        if ($this->tags != "") {
            return explode(",", trim($this->tags));
        }
        return null;
    }

    /**
    * Get question from given question id
    *
    * @param int $id question's
    *
    * @return Question object
    */
    public function getQuestionById($id)
    {
        $res = $this->findAllWhere("id = ?", $id);
        return (count($res) > 0) ? $res[0] : null;
    }


    /**
    * Get latest questions.
    *
    * @param int $limit amount of items
    *
    * @return Question array
    */
    public function getLatest($limit = 5)
    {
        $res = $this->db->connect()
                        ->select()
                        ->from("Question")
                        ->orderBy("created DESC")
                        ->limit($limit)
                        ->execute()
                        ->fetchAll();

        return $res;
    }
}
