<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class UsersController
 * @package App\Controller
 */
class UsersController extends MainController
{
    /**
     * @var array
     */
    private $user = [];

    public function defaultMethod()
    {
        $this->redirect("home");
    }

    private function setUserData()
    {
        $this->user["name"]     = $this->getPost()->getPostVar("name");
        $this->user["email"]    = $this->getPost()->getPostVar("email");
    }

    private function setUserImage()
    {
        $this->user["image"] = $this->getString()->cleanString($this->user["name"]) . $this->getFiles()->setFileExtension();

        $this->getFiles()->uploadFile("img/users/", $this->getString()->cleanString($this->user["name"]));
        $this->getImage()->makeThumbnail("img/users/" . $this->user["image"], 150);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        if (!empty($this->getPost()->getPostArray())) {
            $this->setUserData();
            $this->setUserImage();

            if ($this->getPost()->getPostVar("pass") !== $this->getPost()->getPostVar("conf-pass")) {
                $this->getSession()->createAlert("Passwords do not match !", "red");

                $this->redirect("users!create");
            }

            $this->user["pass"] = password_hash($this->getPost()->getPostVar("pass"), PASSWORD_DEFAULT);

            ModelFactory::getModel("Users")->createData($this->user);
            $this->getSession()->createAlert("New user successfully created !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/users/createUser.twig");
    }

    private function setUpdatePassword()
    {
        $user = ModelFactory::getModel("Users")->readData($this->getGet()->getGetVar("id"));

        if (!password_verify($this->getPost()->getPostVar("old-pass"), $user["pass"])) {
            $this->getSession()->createAlert("Old Password does not match !", "red");

            $this->redirect("admin");
        }

        if ($this->getPost()->getPostVar("new-pass") !== $this->getPost()->getPostVar("conf-pass")) {
            $this->getSession()->createAlert("New Passwords do not match !", "red");

            $this->redirect("admin");
        }

        $this->user["pass"] = password_hash($this->getPost()->getPostVar("new-pass"), PASSWORD_DEFAULT);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updateMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        if (!empty($this->getPost()->getPostArray())) {
            $this->setUserData();

            if (!empty($this->getFiles()->getFileVar("name"))) {
                $this->setUserImage();
            }

            if (!empty($this->getPost()->getPostVar("old-pass"))) {
                $this->setUpdatePassword();
            }

            ModelFactory::getModel("Users")->updateData($this->getGet()->getGetVar("id"), $this->user);
            $this->getSession()->createAlert("Successful modification of the user !", "blue");

            $this->redirect("admin");
        }

        $user = ModelFactory::getModel("Users")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/users/updateUser.twig", ["user" => $user]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Users")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("User actually deleted !", "red");

        $this->redirect("admin");
    }
}
