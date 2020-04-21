<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\Admin;

use Curler\SonataDragAndDropUploadBundle\Admin\MediaAdmin;
use Curler\SonataDragAndDropUploadBundle\Controller\DragAndDropUploadController;
use PHPUnit\Framework\TestCase;
use Sonata\MediaBundle\Entity\BaseMedia;
use Sonata\MediaBundle\Provider\Pool;


class MediaAdminTest extends TestCase
{
    protected $pool;
    protected $admin;


    protected function setUp(): void
    {
        $this->pool = $this->createMock(Pool::class);

        $this->admin = new MediaAdmin(
            null,
            BaseMedia::class,
            DragAndDropUploadController::class,
            $this->pool
        );
    }

    public function testItIsInstantiable(): void
    {
        $this->assertNotNull($this->admin);
    }
}