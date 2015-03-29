<?php

namespace Grossum\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewsAdmin extends Admin
{
    /**
     * Fields to be shown on create/edit forms
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, ['label' => 'Название'])
            ->add('description', 'ckeditor', ['label' => 'Содержание', 'config' => array('height' => '600px')])
            ->add(
                'publicationAt',
                'sonata_type_datetime_picker',
                [
                    'label'           => 'Дата публикации',
                    'dp_side_by_side' => true,
                    'dp_use_current'  => true,
                    'dp_use_seconds'  => false
                ]
            )
            ->add('tags', null, ['label' => 'Теги'])
            ->add(
                'image',
                'sonata_type_model_list',
                array(
                    'label'    => 'Фотография к новости',
                    'required' => true,
                ),
                array(
                    'placeholder'     => 'Выберите фотографию',
                    'provider'        => 'sonata.media.provider.image',
                    'link_parameters' => array('context' => 'news')
                )
            )
            ->add('enabled', null, ['label' => 'Отображать', 'required' => false]);
    }

    /**
     * Fields to be shown on filter forms
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('publicationAt', null, ['label' => 'Дата публикации'])
            ->add('tags', null, ['label' => 'Теги'])
            ->add('enabled', null, ['label' => 'Отображать']);
    }

    /**
     * Fields to be shown on lists
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, ['label' => 'Название'])
            ->add('publicationAt', null, ['label' => 'Дата публикации'])
            ->add('enabled', null, ['label' => 'Отображать']);
    }

    /**
     * @param ErrorElement $errorElement
     * @param mixed $object
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('title')
            ->addConstraint(new NotBlank(['message' => 'Введите название новости']))
            ->end();

        $errorElement
            ->with('description')
            ->addConstraint(new NotBlank(['message' => 'Введите содержание новости']))
            ->end();

        $errorElement
            ->with('publicationAt')
            ->addConstraint(new NotBlank(['message' => 'Выберите дату публикации']))
            ->end();

        $errorElement
            ->with('tags')
            ->addConstraint(new NotBlank(['message' => 'Выберите тег']))
            ->end();

        $errorElement
            ->with('image')
            ->addConstraint(new NotBlank(['message' => 'Выберите фотографию для новости']))
            ->end();
    }
}
