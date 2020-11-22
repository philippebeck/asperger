<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ResourcesController
 * @package App\Controller
 */
class ResourcesController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allResources = $this->getArray()->getArrayElements(ModelFactory::getModel("Resources")->listData());

        return $this->render("front/resources/listResources.twig",["allResources" => $allResources]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        if (!empty($this->getPost()->getPostArray())) {
            $resource = $this->getPost()->getPostArray();

            ModelFactory::getModel("Resources")->createData($resource);
            $this->getSession()->createAlert("New Resource successfully created !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/resources/createResource.twig");
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function readMethod()
    {
        $allResources   = $this->getArray()->getArrayElements(ModelFactory::getModel("Resources")->listData($this->getGet()->getGetVar("category")));
        $resources      = $this->getArray()->getArrayElements($allResources[$this->getGet()->getGetVar("category")]);

        return $this->render("front/resources/readResource.twig", ["resources" => $resources]);
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
            $resource = $this->getPost()->getPostArray();

            ModelFactory::getModel("Resources")->updateData($this->getGet()->getGetVar("id"), $resource);
            $this->getSession()->createAlert("Successful modification of the selected Resource !", "blue");

            $this->redirect("admin");
        }

        $resource = ModelFactory::getModel("Resources")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/resources/updateResource.twig", ["resource" => $resource]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Resources")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Resource permanently deleted !", "red");

        $this->redirect("admin");

    }
}
