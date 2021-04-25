<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;
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
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        $tests      = ModelFactory::getModel("Test")->listData();
        $aQuestions = ModelFactory::getModel("AQ")->listData();
        $eQuestions = ModelFactory::getModel("EQ")->listData();
        $fQuestions = ModelFactory::getModel("FQ")->listData();
        $sQuestions = ModelFactory::getModel("SQ")->listData();
        $visitors   = ModelFactory::getModel("Visitor")->listData();
        $users      = ModelFactory::getModel("User")->listData();

        return $this->render("back/admin.twig", [
            "tests"         => $tests,
            "aQuestions"    => $aQuestions,
            "eQuestions"    => $eQuestions,
            "fQuestions"    => $fQuestions,
            "sQuestions"    => $sQuestions,
            "visitors"      => $visitors,
            "users"         => $users
        ]);
    }
}
