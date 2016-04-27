<?php

namespace Grossum\NewsBundle\Admin;

use Symfony\Component\Validator\Constraints\NotBlank;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Grossum\NewsBundle\Entity\EntityManager\BaseNewsTagManager;

class NewsTagAdmin extends Admin
{
    /**
     * @var BaseNewsTagManager
     */
    private $tagManager;

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, ['label' => 'Название тега']);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name', null, ['label' => 'Название тега']);
    }

    /**
     * {@inheritdoc}
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('name')
            ->addConstraint(new NotBlank(['message' => 'Введите название тега']))
            ->end();

        $tagByName = $this->tagManager->getRepository()->findOneByName($object->getName());

        if ($tagByName && $tagByName->getId() != $object->getId()) {
            $errorElement
                ->with('name')
                ->addViolation('Тег с таким названием уже существует')
                ->end();
        }
    }

    /**
     * @param BaseNewsTagManager $newsTagManager
     */
    public function setNewsTagManager(BaseNewsTagManager $newsTagManager)
    {
        $this->tagManager = $newsTagManager;
    }
}
