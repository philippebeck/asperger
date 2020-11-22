<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ArticlesController
 * @package App\Controller
 */
class ArticlesController extends MainController
{
    /**
     * @var array
     */
    private $article = [];

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allArticles = ModelFactory::getModel("Articles")->listData();

        return $this->render("front/articles/listArticles.twig", ["allArticles" => $allArticles]);
    }

    private function setArticleData()
    {
        $this->article["name"]          = $this->getPost()->getPostVar("name");
        $this->article["updated_date"]  = $this->getPost()->getPostVar("date");
        $this->article["content"]       = $this->getPost()->getPostVar("content");
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
            $this->setArticleData();
            $this->article["created_date"] = $this->article["updated_date"];

            ModelFactory::getModel("Articles")->createData($this->article);
            $this->getSession()->createAlert("New article created successfully !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/articles/createArticle.twig");
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function readMethod()
    {
        $article = ModelFactory::getModel("Articles")->readData($this->getGet()->getGetVar("id"));

        return $this->render("front/articles/readArticle.twig", ["article" => $article]);
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
            $this->setArticleData();

            ModelFactory::getModel("Articles")->updateData($this->getGet()->getGetVar("id"), $this->article);
            $this->getSession()->createAlert("Successful modification of the selected article !", "blue");

            $this->redirect("admin");
        }

        $article = ModelFactory::getModel("Articles")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/articles/updateArticle.twig", ["article" => $article]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Articles")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Article actually deleted !", "red");

        $this->redirect("admin");
    }
}
