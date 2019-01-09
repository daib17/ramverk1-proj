<?php

namespace daib17\Question;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use daib17\Question\Question;
use daib17\Answer\Answer;
use daib17\User\User;
use daib17\Comment\Comment;

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
    * Show all questions.
    *
    * @return object as a response object
    */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $page->add("daib17/question/view-all", [
            "items" => $question->findAll(),
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

        $page->add("daib17/question/read", [
            "db" => $this->di->get("dbqb"),
            "user" => $user,
            "question" => $question,
        ]);

        return $page->render([
            "title" => "Question and answers",
        ]);
    }
}
