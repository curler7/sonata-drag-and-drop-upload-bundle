<?php

namespace SmartMedia\SonataDragAndDropUploadBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;


class SmartMediaSonataDragAndDropUploadExtension extends Extension
{
    /**
     * {@inheritDoc}
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('controller.yaml');
        $loader->load('admin.yaml');
        $loader->load('admin_extensions.yaml');

        $container->getDefinition('sonata.media.admin.media')
            ->replaceArgument(1, $config['class']['media']);

        $container->getDefinition('sonata.media.admin.gallery')
            ->replaceArgument(1, $config['class']['gallery']);

        $container->getDefinition('sonata.media.admin.gallery_has_media')
            ->replaceArgument(1, $config['class']['gallery_has_media']);

        $container->getDefinition('smart_media.sonata_drag_and_drop_upload.controller.drag_and_drop_upload')
            ->setArgument(2, $config['class']['gallery_has_media']);
    }
}