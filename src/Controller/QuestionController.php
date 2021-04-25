<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;
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
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        if ($this->checkArray($this->getPost())) {
            $this->checkTestCategory();

            ModelFactory::getModel($this->getGet("category"))->updateData(
                $this->getGet("id"), 
                $this->question
            );
    
            $this->setSession([
                "message"   => "Modification de la Question effectuée !", 
                "type"      => "blue"
            ]);
    
            $this->redirect("admin");
        }

        $question = ModelFactory::getModel($this->getGet("category"))->readData($this->getGet("id"));

        return $this->render("back/updateQuestion.twig", [
            "question" => $question
        ]);
    }

     // ******************************************************* \\
    // ******************** PRIVATE SETTERS ******************** \\

    private function setSimpleQuestionData()
    {
        $this->question["question"] = (string) trim($this->getPost("question"));

        if ($this->checkArray($this->getPost(), "answer")) {
            $this->question["answer"] = $this->getPost("answer");
        }
    }

    private function setComplexQuestionData()
    {
        $this->question["answers"] = (int) $this->getPost("answers");
        $this->question["value_1"] = (int) $this->getPost("value_1");
        $this->question["value_2"] = (int) $this->getPost("value_2");

        $this->checkValues();
        $this->checkAnswers();

        if ($this->checkArray($this->getPost(), "question")) {
            $this->question["question"] = (string) trim($this->getPost("question"));
        }
    }

     // ******************************************************** \\
    // ******************** PRIVATE CHECKERS ******************** \\

    private function checkTestCategory()
    {
        if ($this->getPost("category") === "FQ") {
            $this->setComplexQuestionData();

        } else {
            $this->setSimpleQuestionData();
        }
    }

    private function checkValues()
    {
        if ($this->checkArray($this->getPost(), "value_3")) {
            $this->question["value_3"] = (int) $this->getPost("value_3");
        }

        if ($this->checkArray($this->getPost(), "value_4")) {
            $this->question["value_4"] = (int) $this->getPost("value_4");
        }

        if ($this->checkArray($this->getPost(), "value_5")) {
            $this->question["value_5"] = (int) $this->getPost("value_5");
        }

        if ($this->checkArray($this->getPost(), "value_6")) {
            $this->question["value_6"] = (int) $this->getPost("value_6");
        }

        if ($this->checkArray($this->getPost(), "value_7")) {
            $this->question["value_7"] = (int) $this->getPost("value_7");
        }

        if ($this->checkArray($this->getPost(), "value_8")) {
            $this->question["value_8"] = (int) $this->getPost("value_8");
        }
    }

    private function checkAnswers()
    {
        if ($this->checkArray($this->getPost(), "answer_1")) {
            $this->question["answer_1"] = (string) trim($this->getPost("answer_1"));
        }

        if ($this->checkArray($this->getPost(), "answer_2")) {
            $this->question["answer_2"] = (string) trim($this->getPost("answer_2"));
        }

        if ($this->checkArray($this->getPost(), "answer_3")) {
            $this->question["answer_3"] = (string) trim($this->getPost("answer_3"));
        }

        if ($this->checkArray($this->getPost(), "answer_4")) {
            $this->question["answer_4"] = (string) trim($this->getPost("answer_4"));
        }

        if ($this->checkArray($this->getPost(), "answer_5")) {
            $this->question["answer_5"] = (string) trim($this->getPost("answer_5"));
        }

        if ($this->checkArray($this->getPost(), "answer_6")) {
            $this->question["answer_6"] = (string) trim($this->getPost("answer_6"));
        }

        if ($this->checkArray($this->getPost(), "answer_7")) {
            $this->question["answer_7"] = (string) trim($this->getPost("answer_7"));
        }

        if ($this->checkArray($this->getPost(), "answer_8")) {
            $this->question["answer_8"] = (string) trim($this->getPost("answer_8"));
        }
    }
}
