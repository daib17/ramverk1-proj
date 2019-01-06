<?php

namespace daib17\Home;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* Home controller.
*/
class HomeController implements ContainerInjectableInterface
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
    * Home page.
    *
    * @return object as a response object
    */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");

        $page->add("daib17/home", []);

        return $page->render([
            "title" => "Home",
        ]);
    }
}
