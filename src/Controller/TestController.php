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
    private $resume = [];

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
            $this->scoreMethod();

            return $this->render("front/mainTest.twig", [
                "info"      => $this->info,
                "resume"    => $this->resume,
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
            $this->scoreMethod();

            return $this->render("front/specialTest.twig", [
                "info"      => $this->info,
                "resume"    => $this->resume,
                "score"     => $this->score
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
        $form_content   = array_slice($this->getPost()->getPostArray(), 1);
        $answers_count  = count($form_content) / 3;

        for($i = 1; $i <= $answers_count; $i++) {
            $this->resume[$i]["id"]         = $form_content["id_" . $i];
            $this->resume[$i]["question"]   = $form_content["question_" . $i];
            $this->resume[$i]["answer"]     = $form_content["answer_" . $i];
            $this->answers[]                = intval($form_content["answer_" . $i]);
        }

        $count = [];

        for($i = 0; $i < $answers_count; $i++) {

            if (intval($this->test[$i]["answer"]) === 0) {

                switch ($this->answers[$i]) {
                    case 1:
                        $count[] = 0;
                        break;
                    case 2:
                        $count[] = 0;
                        break;
                    case 3:
                        $count[] = 1;
                        break;
                    case 4:
                        $count[] = 2;
                        break;
                }

            } elseif (intval($this->test[$i]["answer"]) === 1) {

                switch ($this->answers[$i]) {
                    case 1:
                        $count[] = 2;
                        break;
                    case 2:
                        $count[] = 1;
                        break;
                    case 3:
                        $count[] = 0;
                        break;
                    case 4:
                        $count[] = 0;
                        break;
                }
            }
        }

        foreach ($count as $answer) {
             $this->score += $answer;
        }

        if ($score_type === 1) {
            $this->score = $this->score / 2;
        }

    }
}
