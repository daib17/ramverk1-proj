<?php

namespace daib17\Question;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use daib17\Question\HTMLForm\AddQuestionForm;
use daib17\Question\Question;
use daib17\User\User;
use daib17\Tag\Tag;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* Controller for route 'questions'.
*/
class QuestionController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
    * @var $session session
    */
    private $session;
    private $response;


    /**
    * Initialize variables.
    */
    public function initialize() : void
    {
        $this->session = $this->di->get("session");
        $this->response = $this->di->get("response");
    }


    /**
    * Show all questions.
    *
    * @return object as a response object
    */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $user = new User();
        $user->setDb($this->di->get("dbqb"));

        $page->add("daib17/question/view-all", [
            "items" => $question->findAll(),
            "user" => $user
        ]);

        return $page->render([
            "title" => "List of questions",
        ]);
    }


    /**
    * Handler to read a question.
    *
    * @param integer $id the id to read.
    *
    * @return object as a response object
    */
    public function readActionGet($id) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $id);

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $question->userid);

        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));

        $page->add("daib17/question/read", [
            "db" => $this->di->get("dbqb"),
            "user" => $user,
            "question" => $question
        ]);

        return $page->render([
            "title" => "Question and answers",
        ]);
    }


    /**
    * Handler to add a new question.
    *
    * @param integer $userid
    *
    * @return object as a response object
    */
    public function addAction($userid) : object
    {
        // Check if user logged in
        if (!$this->session->get("userid")) {
            $this->response->redirect("")->send();
            exit;
        }

        $page = $this->di->get("page");

        $form = new AddQuestionForm($this->di, $userid);
        $form->check();

        $page->add("daib17/question/create", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Add question",
        ]);
    }
}
