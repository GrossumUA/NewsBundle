<?php

namespace Grossum\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\Validator\Constraints\NotBlank;
use Grossum\NewsBundle\Entity\EntityManager\TagManager;
use Grossum\NewsBundle\Entity\Tag;

class TagAdmin extends Admin
{
    /** @var  TagManager $tagManager */
    private $tagManager;

    /**
     * Fields to be shown on create/edit forms
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, ['label' => 'Название тега']);
    }

    /**
     * Fields to be shown on lists
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name', null, ['label' => 'Название тега']);
    }

    /**
     * @param ErrorElement $errorElement
     * @param mixed $object
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('name')
            ->addConstraint(new NotBlank(['message' => 'Введите название тега']))
            ->end();

        /** @var Tag $tagByName */
        $tagByName = $this->tagManager->findOneByName($object->getName());

        if ($tagByName && $tagByName->getId() != $object->getId()) {
            $errorElement
                ->with('name')
                ->addViolation('Тег с таким названием уже существует')
                ->end();
        }
    }

    /**
     * @param TagManager $tagManager
     */
    public function setTagManager(TagManager $tagManager)
    {
        $this->tagManager = $tagManager;
    }
}
