<?php


namespace App\Entity;


use Doctrine\Common\Collections\Collection;

interface TranslatableInterface
{
    public function getTranslations(): Collection;
    public function addTranslation(TranslationInterface $translation): self;
    public function removeTranslation(TranslationInterface $translation): self;
    public function translate(string $locale, TranslationInterface $translation);
    public function getTranslation(string $locale);
}