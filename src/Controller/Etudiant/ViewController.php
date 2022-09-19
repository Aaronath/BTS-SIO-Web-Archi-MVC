<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class ViewController implements \Quizz\Core\Controller\ControllerInterface
{

    private $id;
    private $posts;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
            $this->posts = $tabInput["POST"];
        }
    }

    public function outputEvent()
    {
        $error = "";
        // Obj connect Mysql -> Obj Questionnaire
        $etudiantModel = new EtudiantModel();

        // je teste la variable GET /?id
        if (isset($this->id)) {
            if (isset($this->posts) and !empty($this->posts)) {
                $etudiant = $etudiantModel->getFechId($this->id);
                // On set les données
                $etudiant->setPrenom($this->posts["prenom"]);
                $etudiant->setNom($this->posts["nom"]);
                $etudiant->setMotDePasse(sha1($this->posts["password"]));
                $etudiant->setLogin($this->posts["login"]);
                $etudiant->setEmail($this->posts["email"]);

                $error = $etudiantModel->updateById($this->id, $etudiant);

        }
            return TwigCore::getEnvironment()->render(
                'etudiant/etudiant.html.twig',
                [
                    'etudiant' => $etudiantModel->getFechId((int) $this->id),
                    'error' => $error
                ]);
        } else {
            return null;
        }    }
}