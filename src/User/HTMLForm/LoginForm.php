<?php

namespace daib17\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use daib17\User\User;

/**
* Login form.
*/
class LoginForm extends FormModel
{
    /**
    * @var $acronym user's $acronym
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
                "legend" => "Enter details"
            ],
            [
                "user" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }


    /**
    * Callback for submit-button which should return true if it could
    * carry out its work and false if something failed.
    *
    * @return boolean true if okey, false if something went wrong.
    */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $acronym = $this->form->value("user");
        $password = $this->form->value("password");

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->verifyPassword($acronym, $password);

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("User and/or password are not valid.");
            return false;
        }

        // Get user id
        $this->acronym = $acronym;

        return true;
    }


    /**
    * Callback what to do if the form was successfully submitted, this
    * happen when the submit callback method returns true. This method
    * can/should be implemented by the subclass for a different behaviour.
    */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("user/loginOk/{$this->acronym}")->send();
    }
}
