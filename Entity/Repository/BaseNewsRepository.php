<?php

namespace Grossum\NewsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

use Grossum\NewsBundle\Entity\BaseNews;

class BaseNewsRepository extends EntityRepository
{
    /**
     * @return BaseNews[]
     */
    public function findAllEnabledNewsOrderByPostedAt()
    {
        $query = $this->createQueryBuilder('news');

        $query
            ->where('news.enabled = :enabled')
            ->andWhere('post.postedAt <= :now')
            ->orderBy('post.postedAt', 'DESC')
            ->setParameters([
                'enabled' => true,
                'now'     => new \DateTime('now')
            ]);

        return $query->getQuery()->getResult();
    }
}
