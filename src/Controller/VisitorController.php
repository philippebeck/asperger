<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;

/**
 * Class VisitorController
 * @package App\Controller
 */
class VisitorController extends MainController
{
    public function defaultMethod()
    {
        $this->redirect("admin");
    }

    public function deleteMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Visitor")->deleteData($this->getGet("id"));

        $this->setSession([
            "message"   => "Suppression du visiteur effectuée !", 
            "type"      => "red"
        ]);

        $this->redirect("admin");
    }
}
