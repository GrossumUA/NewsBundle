<?php

namespace Grossum\NewsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

use Grossum\NewsBundle\Entity\BaseNewsTag;

class BaseNewsTagRepository extends EntityRepository
{
    /**
     * @param string $name
     * @return BaseNewsTag|null
     */
    public function findOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}
