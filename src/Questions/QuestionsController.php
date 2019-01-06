<?php

namespace daib17\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* Controller for route 'questions'.
*/
class QuestionsController implements ContainerInjectableInterface
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
    * Questions page.
    *
    * @return object as a response object
    */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");

        $page->add("daib17/questions", []);

        return $page->render([
            "title" => "Questions",
        ]);
    }
}
