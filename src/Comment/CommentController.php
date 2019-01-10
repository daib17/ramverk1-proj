<?php

namespace daib17\Comment;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use daib17\Comment\HTMLForm\AddCommentQuestionForm;
use daib17\Comment\HTMLForm\AddCommentAnswerForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* Controller for route 'comment'.
*/
class CommentController implements ContainerInjectableInterface
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
    * Handler comment to question.
    */
    public function addtoquestionAction($questionid)
    {
        // Check if user logged in
        if (!$this->session->get("userid")) {
            $this->response->redirect("")->send();
            exit;
        }

        $page = $this->di->get("page");

        $session = $this->di->get("session");
        $userid = $session->get("userid");

        $form = new AddCommentQuestionForm($this->di, $questionid, $userid);
        $form->check();

        $page->add("daib17/comment/create", [
            "form" => $form->getHTML(),
            "questionid" => $questionid
        ]);

        return $page->render([
            "title" => "Add question",
        ]);
    }


    /**
    * Handler comment to answer.
    */
    public function addtoanswerAction($questionid, $answerid)
    {
        // Check if user logged in
        if (!$this->session->get("userid")) {
            $this->response->redirect("")->send();
            exit;
        }

        $page = $this->di->get("page");

        $session = $this->di->get("session");
        $userid = $session->get("userid");

        $form = new AddCommentAnswerForm($this->di, $questionid, $answerid, $userid);
        $form->check();

        $page->add("daib17/comment/create", [
            "form" => $form->getHTML(),
            "questionid" => $questionid
        ]);

        return $page->render([
            "title" => "Add question",
        ]);
    }
}
