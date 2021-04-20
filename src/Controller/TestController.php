<?php

namespace App\Controller;

use App\Controller\Service\TestManager;
use Pam\Model\Factory\ModelFactory;
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
        if (!empty($this->getPost()->getPostArray())) {

            $this->setSummary($this->getPostData());
            $this->getValues();
            $this->calculateScore();
            $this->createVisitorData();

            if ($this->getGet()->getGetVar("category") !== "FQ") {

                return $this->render("front/test/mainTest.twig", [
                    "infos"     => $this->infos,
                    "summary"   => $this->summary,
                    "score"     => $this->score
                ]);
            }

            return $this->render("front/test/specialTest.twig", [
                "infos"     => $this->infos,
                "summary"   => $this->summary,
                "score"     => $this->score
            ]);
        }

        if ($this->getGet()->getGetVar("category") !== "FQ") {

            return $this->render("front/test/mainTest.twig", [
                    "infos" => $this->infos,
                    "test"  => $this->test
                ]);
        }

        return $this->render("front/test/specialTest.twig", [
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
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        if (!empty($this->getPost()->getPostArray())) {
            $test = $this->setTestData();
   
            ModelFactory::getModel("Test")->updateData(
                $this->getGet()->getGetVar("id"), $test
            );

            $this->getSession()->createAlert(
                "Modification du test effectuée!", "blue"
            );
    
            $this->redirect("admin");
        }

        $test = ModelFactory::getModel("Test")->readData(
            $this->getGet()->getGetVar("id")
        );

        return $this->render("back/test/updateTest.twig", [
            "test" => $test
        ]);
    }

     // ******************************************************* \\
    // ******************** PRIVATE METHODS ******************** \\

    private function createVisitorData()
    {
        $visitorData["test"]        = $this->getGet()->getGetVar("category");
        $visitorData["score"]       = $this->score;
        $visitorData["visitDate"]   = date('Y-m-d H:i:s');

        ModelFactory::getModel("Visitor")->createData($visitorData);
    }

    /**
     * @return array
     */
    private function setTestData()
    {
        $test["category"]             = (string) trim($this->getPost()->getPostVar("category"));
        $test["author"]               = (string) trim($this->getPost()->getPostVar("author"));
        $test["translation_author"]   = (string) trim($this->getPost()->getPostVar("translation_author"));

        $test["value_max"]        = (int) $this->getPost()->getPostVar("value_max");
        $test["asperger_min"]     = (int) $this->getPost()->getPostVar("asperger_min");
        $test["asperger_max"]     = (int) $this->getPost()->getPostVar("asperger_max");
        $test["man_min"]          = (int) $this->getPost()->getPostVar("man_min");
        $test["man_max"]          = (int) $this->getPost()->getPostVar("man_max");
        $test["woman_min"]        = (int) $this->getPost()->getPostVar("woman_min");
        $test["woman_max"]        = (int) $this->getPost()->getPostVar("woman_max");
        $test["year"]             = (int) $this->getPost()->getPostVar("year");
        $test["translation_year"] = (int) $this->getPost()->getPostVar("translation_year");

        if ($this->getPost()->getPostVar("score_type") !== null) {
            $test["score_type"] = (int) $this->getPost()->getPostVar("score_type");
        }

        return $test;
    }
}
