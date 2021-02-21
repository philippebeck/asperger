<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class TestController
 * @package App\Controller
 */
class TestController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allTests = $this->getArray()->getArrayElements(ModelFactory::getModel("Tests")->listData());

        return $this->render("front/tests/listTests.twig",["allTests" => $allTests]);
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
            $test = $this->getPost()->getPostArray();

            ModelFactory::getModel("Tests")->createData($test);
            $this->getSession()->createAlert("New Test successfully created !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/tests/createTest.twig");
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function readMethod()
    {
        if (empty($this->getPost()->getPostArray())) {
            $info   = ModelFactory::getModel("Test")->readData($this->getGet()->getGetVar("category"), "category");
            $test   = ModelFactory::getModel($this->getGet()->getGetVar("category"))->listData();
    
            return $this->render("front/test/readTest.twig", [
                "info" => $info,
                "test" => $test
            ]);
        }
        
        $score = 0;

        foreach ($this->getPost()->getPostArray() as $answer) {
            $score += $answer;
        }

        return $this->render("front/test/readTest.twig", ["score" => $score]);
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
            $test = $this->getPost()->getPostArray();

            ModelFactory::getModel("Tests")->updateData($this->getGet()->getGetVar("id"), $test);
            $this->getSession()->createAlert("Successful modification of the selected Test !", "blue");

            $this->redirect("admin");
        }

        $test = ModelFactory::getModel("Tests")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/tests/updateTest.twig", ["test" => $test]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Tests")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Test permanently deleted !", "red");

        $this->redirect("admin");

    }
}
