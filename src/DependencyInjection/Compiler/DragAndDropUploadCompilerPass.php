<?php

namespace Curler\SonataDragAndDropUploadBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class DragAndDropUploadCompilerPass implements CompilerPassInterface
{
    const SERVICE_ID = 'curler.sonata_drag_and_drop_upload.admin.extension.gallery';


    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $galleries = [];
        foreach ($container->findTaggedServiceIds('sonata.admin') as $id => $attributes) {
            foreach ($attributes as $attribute) {
                if (($attribute['drag_and_drop_upload'] ?? false) !== false) {
                    $container->getDefinition(self::SERVICE_ID)->addTag('sonata.admin.extension', ['target' => $id]);
                    $galleries[$id] = $attribute['drag_and_drop_upload'] === true ? 'gallery' : $attribute['drag_and_drop_upload'];
                }
            }
        }
        $container->getDefinition(self::SERVICE_ID)->addArgument($galleries);
    }
}