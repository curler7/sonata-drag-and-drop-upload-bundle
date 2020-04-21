<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\Helper;

use Curler\SonataDragAndDropUploadBundle\Helper\MediaableTrait;
use PHPUnit\Framework\TestCase;
use Sonata\MediaBundle\Model\MediaInterface;


class MediaableTraitTest extends TestCase
{
    public function testSetterGetter()
    {
        $media = $this->createMock(MediaInterface::class);

        $entity = (new TestMediaableTrait())->setMedia($media);

        $this->assertEquals($media, $entity->getMedia());
    }
}


class TestMediaableTrait
{
    use MediaableTrait;
}