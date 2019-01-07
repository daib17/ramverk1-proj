<?php

namespace daib17\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use daib17\User\User;

/**
* Update user account form.
*/
class UpdateForm extends FormModel
{
    /**
    * Constructor injects with DI container.
    *
    * @param Psr\Container\ContainerInterface $di a service container
    */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getUserDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->id,
                ],
                "name" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->name,
                ],

                "email" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->email,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }


    /**
    * Get details on user to load form with.
    *
    * @param integer $id get details on user with id.
    *
    * @return User
    */
    public function getUserDetails($id) : object
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $id);
        return $user;
    }


    /**
    * Callback for submit-button which should return true if it could
    * carry out its work and false if something failed.
    *
    * @return bool true if okey, false if something went wrong.
    */
    public function callbackSubmit() : bool
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $this->form->value("id"));
        $user->name = $this->form->value("name");
        $user->email = $this->form->value("email");
        $user->save();
        $this->form->addOutput("Details updated.");
        return true;
    }
}
