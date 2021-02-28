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
    private $questionsCount = 0;

    /**
     * @var array
     */
    private $formContent = [];

    /**
     * @var array
     */
    private $answersValues = [];

    /**
     * @var array
     */
    private $summary = [];

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
            $this->getValues();
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
            $this->formContent = $this->getPost()->getPostArray();

        } else if ($this->getGet()->getGetVar("category") !== "FQ") {
            $this->formContent      = array_slice($this->getPost()->getPostArray(), 1);
        }
        
        $this->questionsCount = count($this->formContent) / 3;
    }

    private function setSummary()
    {
        for($i = 1; $i <= $this->questionsCount; $i++) {
            $this->summary[$i]["id"]        = $this->formContent["id_" . $i];
            $this->summary[$i]["question"]  = $this->formContent["question_" . $i];
            $this->answers[]                = (int) $this->formContent["answer_" . $i];
            $this->summary[$i]["answer"]    = $this->formContent["answer_" . $i];
        }
    }

    private function getValues()
    {
        if ($this->getGet()->getGetVar("category") !== "FQ") {
            $this->getMainValues();

        } else if ($this->getGet()->getGetVar("category") === "FQ") {
            $this->getSpecialValues();
        }
    }

    private function getMainValues()
    {
        $calculationType  = (int) $this->getPost()->getPostArray()["score_type"];

        for($i = 0; $i < $this->questionsCount; $i++) {

            if ($calculationType === 1) {
                $this->getMainWeakValue($i);

            } else if ($calculationType === 2) {
                $this->getMainStrongValue($i);
            }
        }
    }

    private function getSpecialValues()
    {
        for($i = 1; $i < $this->questionsCount; $i++) {
            $this->getSpecialValue($i);
            $this->summary[$i]["answer"] = $this->test[$i - 1]['answer_' . $this->answers[$i]];
        }
    }

    /**
     * @param int $id
     */
    private function getMainWeakValue(int $id)
    {
        if ((int) $this->test[$id]["answer"] === 0) {

            switch ($this->answers[$id]) {
                case 1:
                case 2:
                    $this->answersValues[] = 0;
                    break;
                case 3:
                case 4:
                    $this->answersValues[] = 1;
                    break;
            }

        } elseif ((int) $this->test[$id]["answer"] === 1) {

            switch ($this->answers[$id]) {
                case 1:
                case 2:
                    $this->answersValues[] = 1;
                    break;
                case 3:
                case 4:
                    $this->answersValues[] = 0;
                    break;
            }
        }
    }

    /**
     * @param int $id
     */
    private function getMainStrongValue($id)
    {
        if ((int) $this->test[$id]["answer"] === 0) {

            switch ($this->answers[$id]) {
                case 1:
                case 2:
                    $this->answersValues[] = 0;
                    break;
                case 3:
                    $this->answersValues[] = 1;
                    break;
                case 4:
                    $this->answersValues[] = 2;
                    break;
            }

        } elseif ((int) $this->test[$id]["answer"] === 1) {

            switch ($this->answers[$id]) {
                case 1:
                    $this->answersValues[] = 2;
                    break;
                case 2:
                    $this->answersValues[] = 1;
                    break;
                case 3:
                case 4:
                    $this->answersValues[] = 0;
                    break;
            }
        }
    }

    /**
     * @param int $id
     */
    private function getSpecialValue($id)
    {
        switch ($this->answers[$id]) {
            case 1:
                $this->answersValues[] = $this->test[$id]['value_1'];
                break;
            case 2:
                $this->answersValues[] = $this->test[$id]['value_2'];
                break;
            case 3:
                $this->answersValues[] = $this->test[$id]['value_3'];
                break;
            case 4:
                $this->answersValues[] = $this->test[$id]['value_4'];
                break;
            case 5:
                $this->answersValues[] = $this->test[$id]['value_5'];
                break;
            case 6:
                $this->answersValues[] = $this->test[$id]['value_6'];
                break;
            case 7:
                $this->answersValues[] = $this->test[$id]['value_7'];
                break;
            case 8:
                $this->answersValues[] = $this->test[$id]['value_8'];
                break;
        }
    }

    private function calculateScore()
    {
        foreach ($this->answersValues as $value) {
             $this->score += $value;
        }
    }
}
