<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use function Symfony\Component\String\u;

trait TranslationTrait
{
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $locale;
    private $translatable;

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getTranslatable(): ?TranslatableInterface
    {
        return $this->translatable;
    }

    public function setTranslatable(?TranslatableInterface $translatable): self
    {
        $this->translatable = $translatable;

        return $this;
    }

    public static function getTranslatableEntityClass()
    {
        return u(self::class)->slice(0,-11)->toString();
    }
}