<?php


namespace App\Entity;


use Doctrine\Common\Collections\Collection;

trait TranslatableTrait
{
    private $translations;

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(TranslationInterface $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setTranslatable($this);
        }

        return $this;
    }

    public function removeTranslation(TranslationInterface $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getTranslatable() === $this) {
                $translation->setTranslatable(null);
            }
        }

        return $this;
    }

    public function translate(string $locale, TranslationInterface $translation)
    {
        $translation->setLocale($locale);
        $this->addTranslation($translation);
    }

    public function getTranslation(string $locale)
    {
        if (!$this->translations->isEmpty()) {
            /** @var TranslationInterface $translation */
            $translation = $this->translations->get($locale);

            return $translation ?? $this;
        }

        return $this;
    }

    public static function getTranslationEntityClass()
    {
        return self::class.'Translation';
    }
}