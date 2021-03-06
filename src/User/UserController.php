<?php

namespace daib17\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use daib17\User\User;
use daib17\Question\Question;
use daib17\Answer\Answer;
use daib17\Comment\Comment;
use daib17\User\HTMLForm\LoginForm;
use daib17\User\HTMLForm\RegisterForm;
use daib17\User\HTMLForm\UpdateForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* Controller for route 'user'.
*/
class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
    * @var $session session
    */
    private $session;


    /**
    * Initialize variables.
    */
    public function initialize() : void
    {
        $this->session = $this->di->get("session");
    }


    /**
    * Show all items.
    *
    * @return object as a response object
    */
    public function listActionGet() : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));

        $page->add("daib17/user/allusers", [
            "items" => $user->findAll(),
        ]);

        return $page->render([
            "title" => "A list of users",
        ]);
    }


    /**
    * Handler show one user.
    *
    * @param int $id user's id
    *
    * @return object as a response object
    */
    public function viewActionGet($id) : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $id);

        // Get questions for user
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        // Get answers
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));

        // Get answers
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));

        $page->add("daib17/user/view", [
            "user" => $user,
            "question" => $question,
            "answer" => $answer,
            "comment" => $comment
        ]);

        return $page->render([
            "title" => "A list of users",
        ]);
    }


    /**
    * Log in.
    *
    * @return object as a response object
    */
    public function loginAction() : object
    {
        $page = $this->di->get("page");

        $form = new LoginForm($this->di);
        $form->check();

        $page->add("daib17/user/login", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Log in",
        ]);
    }


    /**
    * Login successful.
    *
    * @param string $acronym user's acronym
    *
    * @return object as a response object
    */
    public function loginOkAction($acronym) : object
    {
        // Get user's id
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $id = $user->getId($acronym);

        // Set session variables
        $this->session->set("userid", $id);
        $this->session->set("acronym", $acronym);

        $page = $this->di->get("page");

        $page->add("daib17/user/login_ok", [
            "acronym" => $acronym
        ]);

        return $page->render([
            "title" => "Login result",
        ]);
    }


    /**
    * Log out.
    *
    * @return object as a response object
    */
    public function logoutActionGet($acronym) : object
    {
        $page = $this->di->get("page");

        $this->session->delete("userid");
        $this->session->delete("acronym");

        $page->add("daib17/user/logout", [
            "acronym" => $acronym
        ]);

        return $page->render([
            "title" => "Log out",
        ]);
    }


    /**
    * Register.
    *
    * @return object as a response object
    */
    public function registerAction() : object
    {
        $page = $this->di->get("page");
        $form = new RegisterForm($this->di);
        $form->check();

        $page->add("daib17/user/register", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Register user",
        ]);
    }


    /**
    * Registration successful.
    *
    * @return object as a response object
    */
    public function registerOkAction($acronym) : object
    {
        $page = $this->di->get("page");

        $page->add("daib17/user/registration_ok", [
            "acronym" => $acronym
        ]);

        return $page->render([
            "title" => "Registration result",
        ]);
    }


    /**
    * Update user account.
    *
    * @param int $id the id to update.
    *
    * @return object as a response object
    */
    public function updateAction($id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("daib17/user/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update user account",
        ]);
    }
}
