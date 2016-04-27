<?php

namespace Grossum\NewsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Sonata\EasyExtendsBundle\Mapper\DoctrineCollector;

class GrossumNewsExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $bundles = $container->getParameter('kernel.bundles');

        if (!isset($bundles['GrossumCoreBundle'])) {
            throw new \RuntimeException('Menu bundle requires a Grossum Core Bundle');
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('admin.yml');
        $loader->load('classes.yml');

        $this->configureParameterClass($container, $config);
        $this->registerDoctrineMapping($config);
    }

    /**
     * @param ContainerBuilder $container
     * @param array $config
     */
    public function configureParameterClass(ContainerBuilder $container, array $config)
    {
        $container->setParameter('grossum_news.entity.news.class', $config['class']['news']);
        $container->setParameter('grossum_news.entity.news_tag.class', $config['class']['news_tag']);
    }

    /**
     * @param array $config
     */
    public function registerDoctrineMapping(array $config)
    {
        $collector = DoctrineCollector::getInstance();

        $collector->addAssociation($config['class']['news'], 'mapManyToMany', [
            'fieldName'    => 'tags',
            'targetEntity' => $config['class']['news_tag'],
            'cascade'      => [
                'persist',
            ],
            'joinTable'    => [
                [
                    'name'               => $config['table']['news_to_tag'],
                    'joinColumns'        => [
                        [
                            'name'                 => 'news_id',
                            'referencedColumnName' => 'id',
//                            'nullable'             => false
                        ],
                    ],
                    'inverseJoinColumns' => [
                        [
                            'name'                 => 'news_tag_id',
                            'referencedColumnName' => 'id',
//                            'nullable'             => false
                        ],
                    ],
                ],
            ],
        ]);

        $collector->addAssociation($config['class']['news'], 'mapOneToOne', [
            'fieldName'     => 'image',
//            'targetEntity'  => $config['class']['menu'],
            'targetEntity'  => 'Application\Sonata\MediaBundle\Entity\Media',
            'cascade'       => [
                'all',
            ],
            'joinColumns'   => [
                [
                    'name'                 => 'media_id',
                    'referencedColumnName' => 'id',
                    'nullable'             => false
                ],
            ],
        ]);
    }
}
