<?php

namespace Curler\SonataDragAndDropUploadBundle;

use Curler\SonataDragAndDropUploadBundle\DependencyInjection\Compiler\DragAndDropUploadCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;


class CurlerSonataDragAndDropUploadBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DragAndDropUploadCompilerPass());
    }
}