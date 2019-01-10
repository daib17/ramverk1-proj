<?php

namespace daib17\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use daib17\Question\Question;
use daib17\Tag\Tag;

/**
* Create question form.
*/
class AddQuestionForm extends FormModel
{
    /**
    * @var int $userid
    */
    private $userid;

    /**
    * Constructor injects with DI container.
    *
    * @param Psr\Container\ContainerInterface $di a service container
    * @param int $id question's id
    */
    public function __construct(ContainerInterface $di, $userid)
    {
        parent::__construct($di);
        $this->userid = $userid;
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Enter details"
            ],
            [
                "title" => [
                    "type"        => "text",
                    "validation" => ["not_empty"],
                ],

                "body" => [
                    "type"        => "textarea",
                    "validation" => ["not_empty"],
                ],

                "tags" => [
                    "type"        => "text",
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
    * Callback for submit-button which should return true if it could
    * carry out its work and false if something failed.
    *
    * @return boolean true if okey, false if something went wrong.
    */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $title = $this->form->value("title");
        $body = $this->form->value("body");
        $tags = $this->form->value("tags");
        $tags = trim(strtolower($tags));

        // Save question to database
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->title = $title;
        $question->body = $this->form->value("body");
        $question->tags = $tags;
        $question->userid = $this->userid;
        $question->save();

        // Save tags to database
        $tagArr = explode(",", trim($tags));

        foreach ($tagArr as $aTag) {
            if (strlen($aTag) > 0) {
                $tag = new Tag();
                $tag->setDb($this->di->get("dbqb"));
                $tag->name = $aTag;
                $tag->questionid = $question->id;
                $tag->save();
            }
        }

        // Increase post counter for user
        $user = $question->getUser();
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
        $this->di->get("response")->redirect("question")->send();
    }
}
