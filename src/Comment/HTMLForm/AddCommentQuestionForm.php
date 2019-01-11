<?php

namespace daib17\Comment\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use daib17\Question\Question;
use daib17\Comment\Comment;

/**
* Comment form.
*/
class AddCommentQuestionForm extends FormModel
{
    /**
    * @var int $questionid
    * @var int $userid
    */
    private $questionid;
    private $userid;


    /**
    * Constructor injects with DI container.
    *
    * @param Psr\Container\ContainerInterface $di a service container
    * @param int $id question's id
    */
    public function __construct(ContainerInterface $di, $questionid, $userid)
    {
        parent::__construct($di);
        $this->questionid = $questionid;
        $this->userid = $userid;
        $question = $this->getQuestionDetails($questionid);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Enter details"
            ],
            [
                "question" => [
                    "type"        => "textarea",
                    "readonly" => true,
                    "value" => $question->body,
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
    * Get details on question to load form with.
    *
    * @param integer $id question's id.
    *
    * @return Question
    */
    public function getQuestionDetails($id) : object
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $id);
        return $question;
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
        $comment->questionid = $this->questionid;
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
