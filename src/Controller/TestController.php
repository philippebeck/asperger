<?php

namespace App\Controller;

use App\Controller\TestManager;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class TestController
 * @package App\Controller
 */
class TestController extends TestManager
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if ($this->checkArray($this->getPost())) {

            $this->setSummary($this->getPostData());
            $this->getValues();
            $this->calculateScore();
            $this->createVisitorData();

            if ($this->getGet("category") !== "FQ") {

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

        if ($this->getGet("category") !== "FQ") {

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
            $test = $this->setTestData();
   
            ModelFactory::getModel("Test")->updateData(
                $this->getGet("id"), 
                $test
            );

            $this->setSession([
                "message"   => "Modification du test effectuée!", 
                "type"      => "blue"
            ]);
    
            $this->redirect("admin");
        }

        $test = ModelFactory::getModel("Test")->readData($this->getGet("id"));

        return $this->render("back/updateTest.twig", ["test" => $test]);
    }

     // ******************************************************* \\
    // ******************** PRIVATE METHODS ******************** \\

    private function createVisitorData()
    {
        $visitorData["test"]        = $this->getGet("category");
        $visitorData["score"]       = $this->score;
        $visitorData["visitDate"]   = date('Y-m-d H:i:s');

        ModelFactory::getModel("Visitor")->createData($visitorData);
    }

    /**
     * @return array
     */
    private function setTestData()
    {
        $test["category"]             = (string) trim($this->getPost("category"));
        $test["author"]               = (string) trim($this->getPost("author"));
        $test["translation_author"]   = (string) trim($this->getPost("translation_author"));

        $test["value_max"]        = (int) $this->getPost("value_max");
        $test["asperger_min"]     = (int) $this->getPost("asperger_min");
        $test["asperger_max"]     = (int) $this->getPost("asperger_max");
        $test["man_min"]          = (int) $this->getPost("man_min");
        $test["man_max"]          = (int) $this->getPost("man_max");
        $test["woman_min"]        = (int) $this->getPost("woman_min");
        $test["woman_max"]        = (int) $this->getPost("woman_max");
        $test["year"]             = (int) $this->getPost("year");
        $test["translation_year"] = (int) $this->getPost("translation_year");

        if ($this->checkArray($this->getPost(), "score_type")) {
            $test["score_type"] = (int) $this->getPost("score_type");
        }

        return $test;
    }
}
