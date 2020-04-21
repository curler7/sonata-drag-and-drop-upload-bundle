<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests;

use PHPUnit\Framework\TestCase;
use Curler\SonataDragAndDropUploadBundle\DependencyInjection\Compiler\DragAndDropUploadCompilerPass;
use Curler\SonataDragAndDropUploadBundle\CurlerSonataDragAndDropUploadBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SonataDragAndDropUploadBundleTest extends TestCase
{
    public function testBuild()
    {
        $container = $this->createMock(ContainerBuilder::class);
        $container->expects($this->once())
            ->method('addCompilerPass')
            ->with(new DragAndDropUploadCompilerPass())
            ->willReturnSelf();

        $bundle = new CurlerSonataDragAndDropUploadBundle();
        $bundle->build($container);
    }
}