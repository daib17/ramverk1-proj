<?php

namespace daib17\Home;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use daib17\Question\Question;

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
    * Home page.
    *
    * @return object as a response object
    */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $page->add("daib17/home", [
            "questions" => $question->findAll()
        ]);

        return $page->render([
            "title" => "Home",
        ]);
    }
}
