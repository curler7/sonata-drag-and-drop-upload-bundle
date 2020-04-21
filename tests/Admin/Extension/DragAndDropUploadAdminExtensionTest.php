<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\Admin\Extension;

use Curler\SonataDragAndDropUploadBundle\Admin\Extension\DragAndDropUploadAdminExtension;
use PHPUnit\Framework\TestCase;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;


class DragAndDropUploadAdminExtensionTest extends TestCase
{
    public function testConfigureRoutes()
    {
        $admin = $this->createMock(AdminInterface::class);
        $routeCollection = $this->createMock(RouteCollection::class);
        $routeCollection->expects($this->once())
            ->method('add')
            ->with('drag_and_drop_upload', 'drag_and_drop_upload')
            ->willReturnSelf()
        ;

        $extension = new DragAndDropUploadAdminExtension();
        $extension->configureRoutes($admin, $routeCollection);
    }
}