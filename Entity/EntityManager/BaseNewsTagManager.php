<?php

namespace Grossum\NewsBundle\Entity\EntityManager;

use Doctrine\Common\Persistence\ObjectManager;

use Grossum\CoreBundle\Entity\EntityTrait\SaveUpdateInManagerTrait;
use Grossum\NewsBundle\Entity\Repository\BaseNewsTagRepository;

class BaseNewsTagManager
{
    use SaveUpdateInManagerTrait;

    /**
     * @var string
     */
    private $newsTagClass;

    /**
     * @var BaseNewsTagRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager, $newsTagClass)
    {
        $this->objectManager = $objectManager;
        $this->newsTagClass  = $newsTagClass;
    }

    /**
     * @return BaseNewsTagRepository
     */
    public function getRepository()
    {
        if (null === $this->repository) {
            $this->repository = $this->objectManager->getRepository($this->newsTagClass);
        }

        return $this->repository;
    }
}
