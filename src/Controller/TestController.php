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
    
            return $this->render("front/test.twig", [
                "info" => $info,
                "test" => $test
            ]);
        }

        $score = 0;

        foreach ($this->getPost()->getPostArray() as $answer) {
            $score += $answer;
        }

        return $this->render("front/test.twig", [
                "info"  => $info,
                "score" => $score
            ]);
    }
}
