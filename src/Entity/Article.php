<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="fk_autheur", columns={"auteur"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le champ 'titre' est obligatoire")
     * @Assert\Length(
     *     min="5",
     *     max="255",
     *     minMessage="Le titre doit faire au moins 5 caractères",
     *     maxMessage="Le titre ne doit pas depasser 255 caractères"
     * )
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text", length=65535, nullable=false)
     *
     * @Assert\NotBlank(message="Le champ 'intro' est obligatoire")
     * @Assert\Length(
     *     min="5",
     *     max="65535",
     *     minMessage="L'intro doit faire au moins 5 caractères",
     *     maxMessage="L'intre ne doit pas depasser 255 caractères"
     * )
     *
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", length=65535, nullable=false)
     *
     * @Assert\NotBlank(message="Le champ 'intro' est obligatoire")
     * @Assert\Length(
     *     min="5",
     *     max="65535",
     *     minMessage="L'intro doit faire au moins 5 caractères",
     *     maxMessage="L'intre ne doit pas depasser 255 caractères"
     * )
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime", nullable=false)
     *
     * @Assert\NotBlank(message="Le champ 'date_publication' est obligatoire")
     * @Assert\DateTime(
     *     format="Y-m-d H:i:s",
     *     message="Le format de la date est incorrect."
     * )
     */
    private $datePublication;

    // Attentiion: Pour la relation bidirectionnelle, il faut ajouter l'attribut 'inverseBy'
    // Comme auteur toujours necessaire lors du chargement d'un livre, alors chargement auto de Auteur
    // fetcg -> EAGER
    /**
     * @var \Auteur
     *
     * @ORM\ManyToOne(targetEntity="Auteur", inversedBy="articles", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="auteur", referencedColumnName="identifiant", nullable=false)
     * })
     * @Assert\NotNull(message="L'auteur est obligatoire pour un article")
     */
    private $auteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIntro(): ?string
    {
        return $this->intro;
    }

    public function setIntro(string $intro): self
    {
        $this->intro = $intro;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }


}
