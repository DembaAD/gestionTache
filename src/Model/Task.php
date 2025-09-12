<?php
namespace App\Model;

use DateTime;

class Task{
    private int $identifiant;
    private string $titre;
    private string $description;
    private DateTime $createdAt;


    /**
     * Get the value of identifiant
     *
     * @return int
     */
    public function getIdentifiant(): int {
        return $this->identifiant;
    }

    /**
     * Set the value of identifiant
     *
     * @param int $identifiant
     *
     * @return self
     */
    public function setIdentifiant(int $identifiant): self {
        $this->identifiant = $identifiant;
        return $this;
    }

    /**
     * Get the value of titre
     *
     * @return string
     */
    public function getTitre(): string {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @param string $titre
     *
     * @return self
     */
    public function setTitre(string $titre): self {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get the value of description
     *
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param string $createdAt
     *
     * @return self
     */
    public function setCreatedAt(DateTime | string $createdAt): self {
        if(is_string($createdAt)){
            $this->createdAt = new DateTime($createdAt);
            
        }else{
            $this->createdAt = $createdAt;
        }
        return $this;
    }
}