<?php

namespace Grossum\NewsBundle\Entity\EntityManager;

use Doctrine\Common\Persistence\ObjectManager;

use Grossum\CoreBundle\Entity\EntityTrait\SaveUpdateInManagerTrait;
use Grossum\NewsBundle\Entity\Repository\BaseNewsRepository;

class BaseNewsManager
{
    use SaveUpdateInManagerTrait;

    /**
     * @var string
     */
    private $newsClass;

    /**
     * @var BaseNewsRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager, $newsClass)
    {
        $this->objectManager = $objectManager;
        $this->newsClass     = $newsClass;
    }

    /**
     * @return BaseNewsRepository
     */
    public function getRepository()
    {
        if (null === $this->repository) {
            $this->repository = $this->objectManager->getRepository($this->newsClass);
        }

        return $this->repository;
    }
}
