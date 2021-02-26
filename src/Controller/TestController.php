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
    private $info = [];

    private $test = [];

    private $answers = [];

    private $score = 0;

    public function __construct()
    {
        parent::__construct();

        $this->info = ModelFactory::getModel("Test")->readData($this->getGet()->getGetVar("category"), "category");
        $this->test = ModelFactory::getModel($this->getGet()->getGetVar("category"))->listData();
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if (!empty($this->getPost()->getPostArray())) {
            $this->scoreMethod();

            return $this->render("front/mainTest.twig", [
                "info"  => $this->info,
                "test"  => $this->test,
                "answers" => $this->answers,
                "score" => $this->score
            ]);
        }

        return $this->render("front/mainTest.twig", [
                "info"  => $this->info,
                "test" => $this->test
            ]);
    }

    /**
    * @return string
    * @throws LoaderError
    * @throws RuntimeError
    * @throws SyntaxError
    */
    public function specialMethod()
    {
        if (!empty($this->getPost()->getPostArray())) {
            $this->scoreMethod();

            return $this->render("front/specialTest.twig", [
                "info" => $this->info,
                "test" => $this->test,
                "answers" => $this->answers,
                "score" => $this->score
            ]);
        }

        return $this->render("front/specialTest.twig", [
            "info" => $this->info,
            "test" => $this->test
        ]);        
    }

    private function scoreMethod()
    {
        $score_type     = intval($this->getPost()->getPostArray()["score_type"]);
        $this->answers  = array_slice($this->getPost()->getPostArray(), 1);

        foreach ($this->answers as $answer) {
            $this->score += $answer;
        }

        if ($score_type === 1) {
            $this->score = $this->score / 2;
        }
    }
}
