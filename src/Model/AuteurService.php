<?php


namespace App\Model;


use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;

class AuteurService
{

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function ajouterAuteur(Auteur $auteur) {

        try {
            $this->em->persist($auteur);
            $this->em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Erreur lors de l'enregistrement de l'auteur", null, $e);
        }

    }

    public function modifierAuteur(Auteur $auteur) {

        try {
            $this->em->persist($auteur);
            $this->em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Erreur lors de la mise à jour de l'auteur", null, $e);
        }

    }

    public function rechercherAuteurParIdentifiant(string $identifiant) {
        try {
            return $this->em->getRepository('App:Auteur')->find($identifiant);
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la recuperation de l'auteur $identifiant", null, $e);
        }

    }

    public function rechercherTousLesAuteurs() {
        try {
            return $this->em->getRepository('App:Auteur')->findAll();
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la recuperation des auteurs", null, $e);
        }
    }

}