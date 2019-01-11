<?php

namespace daib17\Answer\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use daib17\Question\Question;
use daib17\Answer\Answer;

/**
* Answer form.
*/
class AddAnswerForm extends FormModel
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
                "title" => [
                    "type"        => "text",
                    "readonly" => true,
                    "value" => $question->title,
                ],

                "answer" => [
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
    * @param integer $id get details on user with id.
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
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->body = $this->form->value("answer");
        $answer->questionid = $this->questionid;
        $answer->userid = $this->userid;
        $answer->save();

        // Increase post counter for user
        $user = $answer->getUser();
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
