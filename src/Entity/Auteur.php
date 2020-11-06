<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Auteur
 *
 * @ORM\Table(name="auteur")
 * @ORM\Entity
 *
 * @UniqueEntity(
 *     fields={"identifiant"},
 *     message="Cet identifiant d'auteur est deja utilisé."
 * )
 *
 */
class Auteur implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="identifiant", type="string", length=50, nullable=false)
     * @ORM\Id
     *
     * @Assert\NotBlank(message="Le champ 'identifiant' est obligatoire")
     * @Assert\Length(
     *     min="5",
     *     max="50",
     *     minMessage="L'identifiant doit faire au moins 5 caractères",
     *     maxMessage="L'identifiant ne doit pas depasser 50 caractères"
     * )
     *
     */
    private $identifiant;

    /**
     * @var string
     *
     * @ORM\Column(name="motdepasse", type="string", length=200, nullable=false)
     *
     * @Assert\NotBlank(message="Le champ 'motdepasse' est obligatoire")
     * @Assert\Length(
     *     min="5",
     *     max="200",
     *     minMessage="Le mot de passe doit faire au moins 5 caractères",
     *     maxMessage="Le mot de passe ne doit pas depasser 200 caractères"
     * )
     *
     */
    private $motdepasse;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     *
     * @Assert\NotBlank(message="Le champ 'prenom' est obligatoire")
     * @Assert\Length(
     *     min="5",
     *     max="50",
     *     minMessage="Le prenom doit faire au moins 5 caractères",
     *     maxMessage="Le prenom ne doit pas depasser 50 caractères"
     * )
     *
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     *
     * @Assert\NotBlank(message="Le champ 'nom' est obligatoire")
     * @Assert\Length(
     *     min="5",
     *     max="50",
     *     minMessage="Le nom doit faire au moins 5 caractères",
     *     maxMessage="Le nom ne doit pas depasser 50 caractères"
     * )
     *
     */
    private $nom;

    // On ajoute un attribut 'articles' pour referencer les articles de cet auteur.
    // On met en place une relation bidirectionnelle.
    // 'targetEntity' permet de spécifier quelle Entité est referencée de l'autre coté
    // mappedBy colonne concernée dans l'entité referencée
    /**
     * @var Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Article",
     *     mappedBy="auteur",
     *     fetch="LAZY"
     * )
     */
    private $articles;


    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    /**
     * @param Article[] $articles
     */
    public function setArticles(array $articles): void
    {
        $this->articles = $articles;
    }


    /**
     * @return string[] un tableau des rôles que l'utilisateur possède
     */
    public function getRoles()
    {
        return ['ROLE_AUTEUR'];
    }

    public function getPassword()
    {
        return $this->motdepasse;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->identifiant;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
