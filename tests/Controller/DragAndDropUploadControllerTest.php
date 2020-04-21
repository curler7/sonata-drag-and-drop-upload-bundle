<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\Controller;

use Curler\SonataDragAndDropUploadBundle\Controller\DragAndDropUploadController;
use Curler\SonataDragAndDropUploadBundle\Tests\App\Entity\GalleryHasMedia;
use PHPUnit\Framework\TestCase;
use Sonata\MediaBundle\Model\GalleryManagerInterface;
use Sonata\MediaBundle\Model\MediaManagerInterface;


class DragAndDropUploadControllerTest extends TestCase
{
    private $controller;


    protected function setUp(): void
    {
        $mediaManager = $this->createMock(MediaManagerInterface::class);
        $galleryManager = $this->createMock(GalleryManagerInterface::class);

        $this->controller = new DragAndDropUploadController($mediaManager, $galleryManager, GalleryHasMedia::class);
    }

    public function testItIsInstantiable()
    {
        $this->assertNotNull($this->controller);
    }
}