<?php

namespace Grossum\NewsBundle\Entity;

use Sonata\MediaBundle\Entity\BaseMedia;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Grossum\CoreBundle\Entity\EntityTrait\DateTimeControlTrait;

class BaseNews
{
    use DateTimeControlTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var boolean
     */
    protected $enabled;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     */
    protected $publicationAt;

    /**
     * @var BaseNewsTag[]|ArrayCollection
     */
    protected $tags;

    /**
     * @var BaseMedia
     */
    protected $image;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param boolean $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $publicationAt
     * @return $this
     */
    public function setPublicationAt($publicationAt)
    {
        $this->publicationAt = $publicationAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublicationAt()
    {
        return $this->publicationAt;
    }

    /**
     * @param BaseNewsTag $tag
     *
     * @return $this
     */
    public function addTag(BaseNewsTag $tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    /**
     * @param BaseNewsTag $tag
     */
    public function removeTag(BaseNewsTag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return BaseNewsTag[]|Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return BaseMedia
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param BaseMedia $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle() ?: 'Новая новость';
    }
}
