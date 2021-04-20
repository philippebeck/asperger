<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class QuestionController
 * @package App\Controller
 */
class QuestionController extends MainController
{
    /**
     * @var array
     */
    private $question = [];

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $this->redirect("test");
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
            $this->checkTestCategory();

            ModelFactory::getModel($this->getGet()->getGetVar("category"))->updateData(
                $this->getGet()->getGetVar("id"), $this->question
            );
    
            $this->getSession()->createAlert(
                "Modification de la Question effectuée !", "blue"
            );
    
            $this->redirect("admin");
        }

        $question = ModelFactory::getModel($this->getGet()->getGetVar("category"))->readData(
            $this->getGet()->getGetVar("id")
        );

        return $this->render("back/question/updateQuestion.twig", [
            "question" => $question
        ]);
    }

     // ******************************************************* \\
    // ******************** PRIVATE SETTERS ******************** \\

    private function setSimpleQuestionData()
    {
        $this->question["question"] = (string) trim(
            $this->getPost()->getPostVar("question")
        );

        if ($this->getPost()->getPostVar("answer") !== null) {
            $this->question["answer"] = $this->getPost()->getPostVar("answer");
        }
    }

    private function setComplexQuestionData()
    {
        $this->question["answers"] = (int) $this->getPost()->getPostVar("answers");
        $this->question["value_1"] = (int) $this->getPost()->getPostVar("value_1");
        $this->question["value_2"] = (int) $this->getPost()->getPostVar("value_2");

        $this->checkValues();
        $this->checkAnswers();

        if ($this->getPost()->getPostVar("question") !== null) {
            $this->question["question"] = (string) trim(
                $this->getPost()->getPostVar("question")
            );
        }
    }

     // ******************************************************** \\
    // ******************** PRIVATE CHECKERS ******************** \\

    private function checkTestCategory()
    {
        if ($this->getPost()->getPostVar("category") === "FQ") {
            $this->setComplexQuestionData();

        } else {
            $this->setSimpleQuestionData();
        }
    }

    private function checkValues()
    {
        if ($this->getPost()->getPostVar("value_3") !== null) {
            $this->question["value_3"] = (int) $this->getPost()->getPostVar("value_3");
        }

        if ($this->getPost()->getPostVar("value_4") !== null) {
            $this->question["value_4"] = (int) $this->getPost()->getPostVar("value_4");
        }

        if ($this->getPost()->getPostVar("value_5") !== null) {
            $this->question["value_5"] = (int) $this->getPost()->getPostVar("value_5");
        }

        if ($this->getPost()->getPostVar("value_6") !== null) {
            $this->question["value_6"] = (int) $this->getPost()->getPostVar("value_6");
        }

        if ($this->getPost()->getPostVar("value_7") !== null) {
            $this->question["value_7"] = (int) $this->getPost()->getPostVar("value_7");
        }

        if ($this->getPost()->getPostVar("value_8") !== null) {
            $this->question["value_8"] = (int) $this->getPost()->getPostVar("value_8");
        }
    }

    private function checkAnswers()
    {
        if ($this->getPost()->getPostVar("answer_1") !== null) {
            $this->question["answer_1"] = (string) trim($this->getPost()->getPostVar("answer_1"));
        }

        if ($this->getPost()->getPostVar("answer_2") !== null) {
            $this->question["answer_2"] = (string) trim($this->getPost()->getPostVar("answer_2"));
        }

        if ($this->getPost()->getPostVar("answer_3") !== null) {
            $this->question["answer_3"] = (string) trim($this->getPost()->getPostVar("answer_3"));
        }

        if ($this->getPost()->getPostVar("answer_4") !== null) {
            $this->question["answer_4"] = (string) trim($this->getPost()->getPostVar("answer_4"));
        }

        if ($this->getPost()->getPostVar("answer_5") !== null) {
            $this->question["answer_5"] = (string) trim($this->getPost()->getPostVar("answer_5"));
        }

        if ($this->getPost()->getPostVar("answer_6") !== null) {
            $this->question["answer_6"] = (string) trim($this->getPost()->getPostVar("answer_6"));
        }

        if ($this->getPost()->getPostVar("answer_7") !== null) {
            $this->question["answer_7"] = (string) trim($this->getPost()->getPostVar("answer_7"));
        }

        if ($this->getPost()->getPostVar("answer_8") !== null) {
            $this->question["answer_8"] = (string) trim($this->getPost()->getPostVar("answer_8"));
        }
    }
}
