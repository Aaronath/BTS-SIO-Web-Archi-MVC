<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Model\EtudiantModel;

class DelController implements \Quizz\Core\Controller\ControllerInterface
{
    private $id;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
        }
    }

    public function outputEvent()
    {
        $etudiantModel = new EtudiantModel();
        $etudiantModel->delEtudiantById($this->id);
        header("Location: /etudiant");
    }
}