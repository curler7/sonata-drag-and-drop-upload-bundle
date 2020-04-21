<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\Admin;

use Curler\SonataDragAndDropUploadBundle\Admin\GalleryAdmin;
use PHPUnit\Framework\TestCase;
use Sonata\MediaBundle\Entity\BaseGallery;
use Sonata\MediaBundle\Provider\Pool;


class GalleryAdminTest extends TestCase
{
    protected $pool;
    protected $admin;


    protected function setUp(): void
    {
        $this->pool = $this->createMock(Pool::class);

        $this->admin = new GalleryAdmin(
            null,
            BaseGallery::class,
            'SonataMediaBundle:GalleryAdmin',
            $this->pool
        );
    }

    public function testItIsInstantiable(): void
    {
        $this->assertNotNull($this->admin);
    }
}