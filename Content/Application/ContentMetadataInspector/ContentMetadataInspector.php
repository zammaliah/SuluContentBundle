<?php

declare(strict_types=1);

/*
 * This file is part of Sulu.
 *
 * (c) Sulu GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ContentBundle\Content\Application\ContentMetadataInspector;

use Doctrine\ORM\EntityManagerInterface;

class ContentMetadataInspector implements ContentMetadataInspectorInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getDimensionContentClass(string $contentRichEntityClass): string
    {
        $classMetadata = $this->entityManager->getClassMetadata($contentRichEntityClass);
        $associationMapping = $classMetadata->getAssociationMapping('dimensionContents');

        return $associationMapping['targetEntity'];
    }

    public function getDimensionContentPropertyName(string $contentRichEntityClass): string
    {
        $classMetadata = $this->entityManager->getClassMetadata($contentRichEntityClass);
        $associationMapping = $classMetadata->getAssociationMapping('dimensionContents');

        return $associationMapping['mappedBy'];
    }
}
