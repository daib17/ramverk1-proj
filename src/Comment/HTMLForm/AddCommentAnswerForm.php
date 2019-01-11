<?php

namespace daib17\Comment\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use daib17\Answer\Answer;
use daib17\Comment\Comment;

/**
* Comment form.
*/
class AddCommentAnswerForm extends FormModel
{
    /**
    * @var int $questionid
    * @var int $userid
    */
    private $questionid;
    private $answerid;
    private $userid;


    /**
    * Constructor injects with DI container.
    *
    * @param Psr\Container\ContainerInterface $di a service container
    * @param int $id question's id
    */
    public function __construct(ContainerInterface $di, $questionid, $answerid, $userid)
    {
        parent::__construct($di);
        $this->questionid = $questionid;
        $this->answerid = $answerid;
        $this->userid = $userid;

        $answer = $this->getAnswerDetails($answerid);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Enter details"
            ],
            [
                "answer" => [
                    "type"        => "textarea",
                    "readonly" => true,
                    "value" => $answer->body,
                ],

                "comment" => [
                    "type"        => "textarea",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Submit",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }


    /**
    * Get details on answer to load form with.
    *
    * @param integer $id answer's id.
    *
    * @return Answer
    */
    public function getAnswerDetails($id) : object
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->find("id", $id);
        return $answer;
    }


    /**
    * Callback for submit-button which should return true if it could
    * carry out its work and false if something failed.
    *
    * @return boolean true if okey, false if something went wrong.
    */
    public function callbackSubmit()
    {
        // Save question to database
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->body = $this->form->value("comment");
        $comment->answerid = $this->answerid;
        $comment->userid = $this->userid;
        $comment->save();

        // Increase post counter for user
        $user = $comment->getUser();
        $user->posts++;
        $user->save();

        return true;
    }


    /**
    * Callback what to do if the form was successfully submitted, this
    * happen when the submit callback method returns true. This method
    * can/should be implemented by the subclass for a different behaviour.
    */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("question/read/$this->questionid")->send();
    }
}
