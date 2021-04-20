<?php

namespace App\Controller\Service;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;

/**
 * Class TestManager
 * @package App\Controller
 */
abstract class TestManager extends MainController
{
    /**
     * @var array
     */
    protected $infos = [];

    /**
     * @var array
     */
    protected $test = [];

    /**
     * @var array
     */
    protected $summary = [];

    /**
     * @var int
     */
    protected $score = 0;

    /**
     * @var array
     */
    private $answers = [];

    /**
     * @var array
     */
    private $answersValues = [];

    /**
     * @var array
     */
    private $questionsCount = 0;


    /**
     * TestManager constructor
     */
    public function __construct()
    {
        parent::__construct();

        if (array_key_exists("category", $this->getGet()->getGetArray())) {
            switch ($this->getGet()->getGetVar("category")) {

                case 'AQ':
                case 'EQ':
                case 'FQ':
                case 'SQ':
                    $this->infos = ModelFactory::getModel("Test")->readData(
                        $this->getGet()->getGetVar("category"), "category"
                    );
                    $this->test = ModelFactory::getModel(
                        $this->getGet()->getGetVar("category"))->listData();
                    break;
    
                default:
                    $this->redirect('home');
            }
        }
    }

     // ********************************************************* \\
    // ******************** PROTECTED METHODS ******************** \\

    /**
     * @return array
     */
    protected function getPostData()
    {
        if ($this->getGet()->getGetVar("category") === "FQ") {

            return $this->getPost()->getPostArray();
        }
        
        if ($this->getGet()->getGetVar("category") !== "FQ") {

            return array_slice($this->getPost()->getPostArray(), 1);
        }
    }

    /**
     * @param array $formContent
     */
    protected function setSummary(array $formContent)
    {
        $this->questionsCount = count($formContent) / 3;

        for($i = 1; $i <= $this->questionsCount; $i++) {
            $this->summary[$i]["id"]        = $formContent["id_" . $i];
            $this->summary[$i]["question"]  = $formContent["question_" . $i];
            $this->summary[$i]["answer"]    = $formContent["answer_" . $i];
            $this->answers[]                = (int) $formContent["answer_" . $i];
        }
    }

    protected function getValues()
    {
        if ($this->getGet()->getGetVar("category") !== "FQ") {
            $this->getMainValues();

        } else if ($this->getGet()->getGetVar("category") === "FQ") {
            $this->getSpecialValues();
        }
    }

    protected function calculateScore()
    {
        foreach ($this->answersValues as $value) {
             $this->score += $value;
        }
    }

     // ******************************************************* \\
    // ******************** PRIVATE METHODS ******************** \\

    private function getMainValues()
    {
        $calculationType  = (int) $this->getPost()->getPostArray()["score_type"];

        for($i = 0; $i < $this->questionsCount; $i++) {
            $this->checkCalculationType($calculationType, $i);
        }
    }

    /**
     * @param int $calculationType
     * @param int $id
     */
    private function checkCalculationType(int $calculationType, int $id)
    {
        if ($calculationType === 1) {
            $this->getMainWeakValue($id);

        } else if ($calculationType === 2) {
            $this->getMainStrongValue($id);
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
}
