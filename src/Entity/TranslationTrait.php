<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

trait TranslationTrait
{
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $locale;

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}