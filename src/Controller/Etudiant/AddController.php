<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\View\TwigCore;
use Quizz\Entity\Etudiant;
use Quizz\Model\EtudiantModel;

class addController implements \Quizz\Core\Controller\ControllerInterface
{
    private $posts;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["POST"])) {
            $this->posts = $tabInput["POST"];
        }
    }

    public function outputEvent()
    {
        $error = "Bienvenue ! ";

        if (isset($this->posts) and !empty($this->posts)) {
            $etudiant = new Etudiant();
            $etudiantModel = new EtudiantModel();

            $etudiant->setPrenom($this->posts["prenom"]);
            $etudiant->setNom($this->posts["nom"]);
            $etudiant->setMotDePasse(sha1($this->posts["password"]));
            $etudiant->setLogin($this->posts["login"]);
            $etudiant->setEmail($this->posts["email"]);

            $error = $etudiantModel->addEtudiant($etudiant);
        }
        return TwigCore::getEnvironment()->render(
            'etudiant/add.html.twig',
            [
                "error" => $error
            ]);
    }
}