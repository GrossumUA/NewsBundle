<?php

namespace Grossum\NewsBundle\Entity\EntityManager;

use Doctrine\Common\Persistence\ObjectManager;
use Grossum\CoreBundle\Entity\EntityTrait\SaveUpdateInManagerTrait;

class NewsManager
{
    use SaveUpdateInManagerTrait;

    private $repository;

    /** @var  ObjectManager */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->repository    = $objectManager->getRepository('GrossumNewsBundle:News');
    }
}
