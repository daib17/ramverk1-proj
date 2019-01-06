<?php

namespace daib17\About;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* Controller for route 'about'.
*/
class AboutController implements ContainerInjectableInterface
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
    * About page.
    *
    * @return object as a response object
    */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");

        $page->add("daib17/about", []);

        return $page->render([
            "title" => "About",
        ]);
    }
}
