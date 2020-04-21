<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\Admin;

use Curler\SonataDragAndDropUploadBundle\Admin\GalleryHasMediaAdmin;
use PHPUnit\Framework\TestCase;
use Sonata\MediaBundle\Entity\BaseGallery;


class GalleryHasMediaAdminTest extends TestCase
{
    protected $admin;


    protected function setUp(): void
    {
        $this->admin = new GalleryHasMediaAdmin(
            null,
            BaseGallery::class,
            'SonataMediaBundle:GalleryAdmin'

        );
    }

    public function testItIsInstantiable(): void
    {
        $this->assertNotNull($this->admin);
    }
}