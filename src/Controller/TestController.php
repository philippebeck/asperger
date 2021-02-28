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
    private $infos = [];

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

        $this->infos = ModelFactory::getModel("Test")->readData($this->getGet()->getGetVar("category"), "category");
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
            $this->checkMainAnswers();
            $this->calculateScore();

            if ($this->getGet()->getGetVar("category") !== "FQ") {

                return $this->render("front/mainTest.twig", [
                    "infos"     => $this->infos,
                    "summary"   => $this->summary,
                    "score"     => $this->score
                ]);
            }

            return $this->render("front/specialTest.twig", [
                "infos"     => $this->infos,
                "summary"   => $this->summary,
                "score"     => $this->score
            ]);
        }

        if ($this->getGet()->getGetVar("category") !== "FQ") {

            return $this->render("front/mainTest.twig", [
                    "infos" => $this->infos,
                    "test"  => $this->test
                ]);
        }

        return $this->render("front/specialTest.twig", [
            "infos" => $this->infos,
            "test"  => $this->test
        ]);
    }

    private function getPostData()
    {
        if ($this->getGet()->getGetVar("category") === "FQ") {
            $this->form_content = $this->getPost()->getPostArray();

        } else {
            $this->score_type       = (int) $this->getPost()->getPostArray()["score_type"];
            $this->form_content     = array_slice($this->getPost()->getPostArray(), 1);
        }
        
        $this->answers_count = count($this->form_content) / 3;
    }

    private function setSummary()
    {
        for($i = 1; $i <= $this->answers_count; $i++) {
            $this->summary[$i]["id"]         = $this->form_content["id_" . $i];
            $this->summary[$i]["question"]   = $this->form_content["question_" . $i];
            $this->summary[$i]["answer"]     = $this->form_content["answer_" . $i];
            $this->answers[]                 = (int) $this->form_content["answer_" . $i];
        }
    }

    private function checkMainAnswers()
    {
        for($i = 0; $i < $this->answers_count; $i++) {

            if ((int) $this->test[$i]["answer"] === 0) {

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

            } elseif ((int) $this->test[$i]["answer"] === 1) {

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

    private function checkSpecialAnswers()
    {
        for($i = 0; $i < $this->answers_count; $i++) {

            switch ($this->answers[$i]) {
                case 1:
                    $this->count[] = $this->test[$i]['value_1'];
                    break;
                case 2:
                    $this->count[] = $this->test[$i]['value_2'];
                    break;
                case 3:
                    $this->count[] = $this->test[$i]['value_3'];
                    break;
                case 4:
                    $this->count[] = $this->test[$i]['value_4'];
                    break;
                case 5:
                    $this->count[] = $this->test[$i]['value_5'];
                    break;
                case 6:
                    $this->count[] = $this->test[$i]['value_6'];
                    break;
                case 7:
                    $this->count[] = $this->test[$i]['value_7'];
                    break;
                case 8:
                    $this->count[] = $this->test[$i]['value_8'];
                    break;
            }
        }

        for($i = 1; $i < $this->answers_count; $i++) {

            $this->summary[$i]["answer"] = $this->test[$i - 1]['answer_' . $this->answers[$i]];
        }
    }

    private function calculateScore()
    {
        foreach ($this->count as $answer) {
             $this->score += $answer;
        }

        if ($this->getGet()->getGetVar("category") !== "FQ" && $this->score_type === 1) {
            $this->score = (int) ($this->score / 2);
        }
    }
}
