<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        $allTests       = ModelFactory::getModel("Tests")->listData();
        $allUsers       = ModelFactory::getModel("Users")->listData();

        return $this->render("back/admin.twig", [
            "allTests"      => $allTests,
            "allUsers"      => $allUsers
        ]);
    }
}

