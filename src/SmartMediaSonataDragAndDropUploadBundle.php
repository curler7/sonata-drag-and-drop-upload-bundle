<?php

namespace SmartMedia\SonataDragAndDropUploadBundle;

use SmartMedia\SonataDragAndDropUploadBundle\DependencyInjection\Compiler\DragAndDropUploadCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;


class SmartMediaSonataDragAndDropUploadBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DragAndDropUploadCompilerPass());
    }
}