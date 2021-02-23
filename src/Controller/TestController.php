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
        $info = ModelFactory::getModel("Test")->readData($this->getGet()->getGetVar("category"), "category");

        if (empty($this->getPost()->getPostArray())) {
            $test = ModelFactory::getModel($this->getGet()->getGetVar("category"))->listData();

            if ($this->getGet()->getGetVar("category") === "FQ") {

                return $this->render("front/specialTest.twig", [
                    "info" => $info,
                    "test" => $test
                ]);
            }
    
            return $this->render("front/mainTest.twig", [
                "info" => $info,
                "test" => $test
            ]);
        }

        $score = 0;

        foreach ($this->getPost()->getPostArray() as $answer) {
            $score += $answer;
        }

        if ($this->getGet()->getGetVar("category") === "FQ") {

            return $this->render("front/specialTest.twig", [
                "info" => $info,
                "score" => $score
            ]);
        }

        return $this->render("front/mainTest.twig", [
                "info"  => $info,
                "score" => $score
            ]);
    }
}
