<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends MainController
{
    /**
     * @var array
     */
    private $user = [];

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $this->redirect("auth");
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
                $this->getSession()->createAlert("Les mots de passe ne correspondent pas !", "red");

                $this->redirect("user!create");
            }

            $this->user["pass"] = password_hash($this->getPost()->getPostVar("pass"), PASSWORD_DEFAULT);

            ModelFactory::getModel("User")->createData($this->user);
            $this->getSession()->createAlert("Nouvel utilisateur créé avec succès !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/user/createUser.twig");
    }

    private function setUserData()
    {
        $this->user["name"] = $this->getString()->cleanString(
            $this->getPost()->getPostVar("name"), "name"
        );
        $this->user["email"] = (string) trim($this->getPost()->getPostVar("email"));
    }

    private function setUserImage()
    {
        $this->user["image"] = $this->getString()->cleanString($this->user["name"]) . $this->getFiles()->setFileExtension();

        $this->getFiles()->uploadFile("img/user/", $this->getString()->cleanString($this->user["name"]));
        $this->getImage()->makeThumbnail("img/user/" . $this->user["image"], 150);
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
            $this->setUpdateData();
        }

        $user = ModelFactory::getModel("User")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/user/updateUser.twig", ["user" => $user]);
    }

    private function setUpdateData()
    {
        $this->setUserData();

        if (!empty($this->getFiles()->getFileVar("name"))) {
            $this->setUserImage();
        }

        if (!empty($this->getPost()->getPostVar("old-pass"))) {
            $this->setUpdatePassword();
        }

        ModelFactory::getModel("User")->updateData($this->getGet()->getGetVar("id"), $this->user);
        $this->getSession()->createAlert("Modification de l'utilisateur réussie !", "blue");

        $this->redirect("admin");
    }

    private function setUpdatePassword()
    {
        $user = ModelFactory::getModel("User")->readData($this->getGet()->getGetVar("id"));

        if (!password_verify($this->getPost()->getPostVar("old-pass"), $user["pass"])) {
            $this->getSession()->createAlert("Ancien mot de passe incorrect !", "red");

            $this->redirect("admin");
        }

        if ($this->getPost()->getPostVar("new-pass") !== $this->getPost()->getPostVar("conf-pass")) {
            $this->getSession()->createAlert("Les nouveaux mots de passe ne correspondent pas !", "red");

            $this->redirect("admin");
        }

        $this->user["pass"] = password_hash($this->getPost()->getPostVar("new-pass"), PASSWORD_DEFAULT);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("User")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Suppression de l'utilisateur effectuée !", "red");

        $this->redirect("admin");
    }
}
