<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class ListController implements \Quizz\Core\Controller\ControllerInterface
{

    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
    }

    public function outputEvent()
    {
        // Obj connect Mysql -> Obj Questionnaire
        $etudiantModel = new EtudiantModel();

        // Si y a pas de GET alors j'affiche tout
        return TwigCore::getEnvironment()->render(
            'etudiant/list.html.twig',
            [
                'etudiants' => $etudiantModel->getFechAll()
            ]);
    }
}