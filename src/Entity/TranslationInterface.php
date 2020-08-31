<?php


namespace App\Entity;


interface TranslationInterface
{
    public function getLocale();
    public function setLocale(string $locale);
    public function getTranslatable();
    public function setTranslatable(?TranslatableInterface $translatable);
}