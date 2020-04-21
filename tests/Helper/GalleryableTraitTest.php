<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\Helper;

use Curler\SonataDragAndDropUploadBundle\Helper\GalleryableTrait;
use PHPUnit\Framework\TestCase;
use Sonata\MediaBundle\Model\GalleryInterface;


class GalleryableTraitTest extends TestCase
{
    public function testSetterGetter()
    {
        $gallery = $this->createMock(GalleryInterface::class);

        $entity = (new TestGalleryableTrait())->setGallery($gallery);

        $this->assertEquals($gallery, $entity->getGallery());
    }
}


class TestGalleryableTrait
{
    use GalleryableTrait;
}