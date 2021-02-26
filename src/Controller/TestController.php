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
     * @var array
     */
    private $info = [];

    /**
     * @var array
     */
    private $test = [];

    /**
     * @var array
     */
    private $answers = [];

    /**
     * @var array
     */
    private $answers_count = 0;

    /**
     * @var array
     */
    private $form_content = [];

    /**
     * @var array
     */
    private $count = [];

    /**
     * @var array
     */
    private $summary = [];

    /**
     * @var int
     */
    private $score_type = null;

    /**
     * @var int
     */
    private $score = 0;

    /**
     * TestController constructor
     */
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
            $this->getPostData();
            $this->setSummary();
            $this->checkAnswers();
            $this->calculateScore();

            return $this->render("front/mainTest.twig", [
                "info"      => $this->info,
                "summary"   => $this->summary,
                "score"     => $this->score
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
            $this->getPostData();
            $this->setSummary();
            $this->checkAnswers();
            $this->calculateScore();

            return $this->render("front/specialTest.twig", [
                "info"      => $this->info,
                "summary"   => $this->summary,
                "score"     => $this->score
            ]);
        }

        return $this->render("front/specialTest.twig", [
            "info" => $this->info,
            "test" => $this->test
        ]);        
    }

    private function getPostData()
    {
        $this->score_type     = intval($this->getPost()->getPostArray()["score_type"]);
        $this->form_content   = array_slice($this->getPost()->getPostArray(), 1);
        $this->answers_count  = count($this->form_content) / 3;
    }

    private function setSummary()
    {
        for($i = 1; $i <= $this->answers_count; $i++) {
            $this->summary[$i]["id"]         = $this->form_content["id_" . $i];
            $this->summary[$i]["question"]   = $this->form_content["question_" . $i];
            $this->summary[$i]["answer"]     = $this->form_content["answer_" . $i];
            $this->answers[]                 = intval($this->form_content["answer_" . $i]);
        }
    }

    private function checkAnswers()
    {
        for($i = 0; $i < $this->answers_count; $i++) {

            if (intval($this->test[$i]["answer"]) === 0) {

                switch ($this->answers[$i]) {
                    case 1:
                        $this->count[] = 0;
                        break;
                    case 2:
                        $this->count[] = 0;
                        break;
                    case 3:
                        $this->count[] = 1;
                        break;
                    case 4:
                        $this->count[] = 2;
                        break;
                }

            } elseif (intval($this->test[$i]["answer"]) === 1) {

                switch ($this->answers[$i]) {
                    case 1:
                        $this->count[] = 2;
                        break;
                    case 2:
                        $this->count[] = 1;
                        break;
                    case 3:
                        $this->count[] = 0;
                        break;
                    case 4:
                        $this->count[] = 0;
                        break;
                }
            }
        }
    }

    private function calculateScore()
    {
        foreach ($this->count as $answer) {
             $this->score += $answer;
        }

        if ($this->score_type === 1) {
            $this->score = $this->score / 2;
        }

    }
}
