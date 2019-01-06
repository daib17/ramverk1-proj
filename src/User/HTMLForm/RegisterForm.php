<?php

namespace daib17\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use daib17\User\User;

/**
* User registration form.
*/
class RegisterForm extends FormModel
{
    /**
    * @var $acronym generated acronym for registered user
    */
    private $acronym;

    /**
    * Constructor injects with DI container.
    *
    * @param Psr\Container\ContainerInterface $di a service container
    */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Enter details",
            ],
            [
                "name" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "email" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "password" => [
                    "type" => "password",
                    "validation" => ["not_empty"],
                ],

                "password-repeat" => [
                    "type" => "password",
                    "validation" => ["match" => "password"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Register",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }


    /**
    * Callback for submit-button which should return true if it could
    * carry out its work and false if something failed.
    *
    * @return bool true if okey, false if something went wrong.
    */
    public function callbackSubmit() : bool
    {
        // Get values from the submitted form
        $name = $this->form->value("name");
        $email = $this->form->value("email");
        $password = $this->form->value("password");
        $passwordRepeat = $this->form->value("password-repeat");
        $gravatar = $this->form->value("gravatar");

        // Name at least 4 characters
        if (strlen($name) < 4) {
            $this->form->rememberValues();
            $this->form->addOutput("Name must be at least 4 characters in length.");
            return false;
        }

        // Check password matches
        if ($password !== $passwordRepeat) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        // Save to database
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->name = $name;
        $user->email = $email;
        $user->setGravatar();
        $user->setAcronym();
        $user->setPassword($password);
        $user->save();

        // $this->form->addOutput("User was created");
        $this->acronym = $user->acronym;
        return true;
    }


    /**
    * Callback what to do if the form was successfully submitted, this
    * happen when the submit callback method returns true. This method
    * can/should be implemented by the subclass for a different behaviour.
    */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("user/registerOk/{$this->acronym}")->send();
    }
}
