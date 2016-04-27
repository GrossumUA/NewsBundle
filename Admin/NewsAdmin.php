<?php

namespace Grossum\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class NewsAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('News')
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
                ->add('enabled', null, ['label' => 'Отображать', 'required' => false])
            ->end()
            ->with('Tags')
                ->add('tags', null, ['label' => 'Теги'])
                ->add(
                    'tags',
                    'sonata_type_model',
                    [
//                        'class' => 'BiudeeCoreBundle:Subscriber',
                        'property' => 'name',
                        'required' => false,
                        'multiple' => true,
                        'by_reference' => false,
                        'compound' => false,
                    ]
                )
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('publicationAt', null, ['label' => 'Дата публикации'])
            ->add('tags', null, ['label' => 'Теги'])
            ->add('enabled', null, ['label' => 'Отображать']);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, ['label' => 'Название'])
            ->add('publicationAt', null, ['label' => 'Дата публикации'])
            ->add('enabled', null, ['label' => 'Отображать']);
    }
}
