<?php


namespace App\EventSubscriber;


use App\Entity\TranslatableInterface;
use App\Entity\TranslationInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class TranslationEventSubscriber implements EventSubscriber
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $loadClassMetadataEventArgs): void
    {
        $classMetadata = $loadClassMetadataEventArgs->getClassMetadata();

        if ($classMetadata->reflClass === null) {
            // Class has not yet been fully built, ignore this event
            return;
        }

        if ($classMetadata->isMappedSuperclass) {
            return;
        }

        if (is_a($classMetadata->reflClass->getName(), TranslatableInterface::class, true)) {
            $this->mapTranslatable($classMetadata);
        }

        if (is_a($classMetadata->reflClass->getName(), TranslationInterface::class, true)) {
            $this->mapTranslation($classMetadata);
        }
    }

    private function mapTranslatable(ClassMetadataInfo $classMetadataInfo): void
    {
        if ($classMetadataInfo->hasAssociation('translations')) {
            return;
        }

        $classMetadataInfo->mapOneToMany([
            'fieldName' => 'translations',
            'mappedBy' => 'translatable',
            'indexBy' => 'locale',
            'cascade' => ['persist', 'merge', 'remove'],
//            'fetch' => $this->translatableFetchMode,
            'targetEntity' => $classMetadataInfo->getReflectionClass()->getMethod('getTranslationEntityClass')->invoke(
                null
            ),
            'orphanRemoval' => true,
        ]);
    }

    private function mapTranslation(ClassMetadataInfo $classMetadataInfo): void
    {
        if (! $classMetadataInfo->hasAssociation('translatable')) {
            $classMetadataInfo->mapManyToOne([
                'fieldName' => 'translatable',
                'inversedBy' => 'translations',
                'cascade' => ['persist', 'merge'],
//                'fetch' => $this->translationFetchMode,
                'joinColumns' => [[
                    'name' => 'translatable_id',
                    'referencedColumnName' => 'id',
                    'onDelete' => 'CASCADE',
                ]],
                'targetEntity' => $classMetadataInfo->getReflectionClass()->getMethod(
                    'getTranslatableEntityClass'
                )->invoke(null),
            ]);
        }

        if (! $classMetadataInfo->hasField('locale') && ! $classMetadataInfo->hasAssociation('locale')) {
            $classMetadataInfo->mapField([
                'fieldName' => 'locale',
                'type' => 'string',
                'length' => 5,
            ]);
        }
    }

    public function getSubscribedEvents()
    {
        return [Events::loadClassMetadata];
    }
}