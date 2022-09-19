<?php

namespace Quizz\Model;

use Quizz\Core\Service\DatabaseService;
use Quizz\Entity\Etudiant;

class EtudiantModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    /**
     * @return array
     */
    public function getFechAll()
    {
        $requete = $this->bdd->prepare('SELECT * FROM etudiants');
        $requete->execute();
        $tabEtudiant = [];

        foreach ($requete->fetchAll() as $value)
        {
            $etudiant = new Etudiant();
            $etudiant->setIdEtudiant($value["idEtudiant"]);
            $etudiant->setLogin($value["login"]);
            $etudiant->setEmail($value["email"]);
            $etudiant->setMotDePasse($value["motDePasse"]);
            $etudiant->setNom($value["nom"]);
            $etudiant->setPrenom($value["prenom"]);
            $tabEtudiant[] = $etudiant;
        }

        return $tabEtudiant;
    }

    /**
     * @param int $id
     * @return Etudiant
     */
    public function getFechId(int $id)
    {
        $requete = $this->bdd->prepare('SELECT * FROM etudiants where idEtudiant = ' . $id);
        $requete->execute();
        $result = $requete->fetch();

        $etudiant = new Etudiant();
        $etudiant->setIdEtudiant($result["idEtudiant"]);
        $etudiant->setLogin($result["login"]);
        $etudiant->setEmail($result["email"]);
        $etudiant->setMotDePasse($result["motDePasse"]);
        $etudiant->setNom($result["nom"]);
        $etudiant->setPrenom($result["prenom"]);

        return  $etudiant;
    }

    public function updateById($id, $etudiant) {
        $requete = $this->bdd->prepare("SELECT email FROM etudiants WHERE email = '{$etudiant->getEmail()}'");
        $requete->execute();
        $result = $requete->rowCount();

        if ($result > 0 or !filter_var($etudiant->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $requete = $this->bdd->prepare("UPDATE etudiants SET login = '{$etudiant->getLogin()}', motDePasse = '{$etudiant->getMotDePasse()}', nom = '{$etudiant->getNom()}', prenom = '{$etudiant->getPrenom()}' where idEtudiant = {$id}");
            $requete->execute();
            $error = "Email non modifié, déjà utilisé ou invalide... Les autres données ont cependant été mis à jour !";
        } else {
            $requete = $this->bdd->prepare("UPDATE etudiants SET login = '{$etudiant->getLogin()}', motDePasse = '{$etudiant->getMotDePasse()}', nom = '{$etudiant->getNom()}', prenom = '{$etudiant->getPrenom()}', email = '{$etudiant->getEmail()}' where idEtudiant = {$id}");
            $requete->execute();
            $error = "Etudiant modifié avec succès";
        }
        return $error;
    }

    public function addEtudiant($etudiant) {
        $requete = $this->bdd->prepare("SELECT email FROM etudiants WHERE email = '{$etudiant->getEmail()}'");
        $requete->execute();
        $result = $requete->rowCount();

        if ($result > 0) {
            $error = "Email déjà utilisé ...";
        } else if (filter_var($etudiant->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $requete = $this->bdd->prepare("INSERT INTO etudiants (login, motDePasse, nom, prenom, email) VALUES ('{$etudiant->getLogin()}', '{$etudiant->getMotDePasse()}', '{$etudiant->getNom()}', '{$etudiant->getPrenom()}', '{$etudiant->getEmail()}')");
            $requete->execute();
            $error = "Etudiant ajouté avec succés !";
        } else {
            $error = "E-Mail invalide ...";
        }
        return $error;
    }

    public function delEtudiantById($id) {
        $requete = $this->bdd->prepare("DELETE FROM etudiants WHERE idEtudiant = {$id}");
        $requete->execute();
    }
}