<?php

namespace daib17\Answer;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use daib17\Answer\HTMLForm\AddAnswerForm;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* Controller for route 'answer'.
*/
class AnswerController implements ContainerInjectableInterface
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
    * Handler to create answer
    */
    public function addAction($questionid) {
        // Check if user logged in
        if (!$this->session->get("userid")) {
            $this->response->redirect("")->send();
            exit;
        }

        $page = $this->di->get("page");

        $session = $this->di->get("session");
        $userid = $session->get("userid");

        $form = new AddAnswerForm($this->di, $questionid, $userid);
        $form->check();

        $page->add("daib17/answer/create", [
            "form" => $form->getHTML(),
            "questionid" => $questionid
        ]);

        return $page->render([
            "title" => "Add question",
        ]);
    }
}
