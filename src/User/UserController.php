<?php

namespace daib17\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use daib17\User\HTMLForm\LoginForm;
use daib17\User\HTMLForm\RegisterForm;

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


    // /**
    //  * Show all items.
    //  *
    //  * @return object as a response object
    //  */
    // public function indexActionGet() : object
    // {
    //     $page = $this->di->get("page");
    //     $book = new Book();
    //     $book->setDb($this->di->get("dbqb"));
    //
    //     $page->add("book/crud/view-all", [
    //         "items" => $book->findAll(),
    //     ]);
    //
    //     return $page->render([
    //         "title" => "A collection of items",
    //     ]);
    // }


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

        $page->add("daib17/login", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Log in",
        ]);
    }


    /**
    * Login successful.
    *
    * @return object as a response object
    */
    public function loginOkAction($acronym) : object
    {
        $this->session->set("user", $acronym);

        $page = $this->di->get("page");

        $page->add("daib17/login_ok", [
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
    public function logoutActionGet() : object
    {
        $page = $this->di->get("page");

        $this->session->delete("user");

        $page->add("daib17/logout", []);

        return $page->render([
            "title" => "Log out",
        ]);
    }


    /**
    * Show user list.
    *
    * @return object as a response object
    */
    public function listActionGet() : object
    {
        $page = $this->di->get("page");

        $page->add("daib17/allusers", []);

        return $page->render([
            "title" => "All users",
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

        $page->add("daib17/register", [
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

        $page->add("daib17/registration_ok", [
            "acronym" => $acronym
        ]);

        return $page->render([
            "title" => "Registration result",
        ]);
    }
}
