<?php

namespace daib17\Home;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use daib17\Question\Question;
use daib17\Tag\Tag;
use daib17\User\User;

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
        $questionArr = $question->getLatest();

        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $tagArr = $tag->getPopular();

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $userArr = $user->getMoreActive();

        $page->add("daib17/home", [
            "questions" => $questionArr,
            "tags" => $tagArr,
            "users" => $userArr
        ]);

        return $page->render([
            "title" => "Home",
        ]);
    }
}
