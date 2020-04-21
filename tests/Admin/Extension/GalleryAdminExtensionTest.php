<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\Admin\Extension;

use Curler\SonataDragAndDropUploadBundle\Admin\Extension\GalleryAdminExtension;
use Doctrine\Persistence\AbstractManagerRegistry;
use PHPUnit\Framework\TestCase;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\MediaBundle\Entity\BaseGallery;
use Sonata\MediaBundle\Entity\GalleryManager;
use Sonata\MediaBundle\Model\GalleryInterface;


class GalleryAdminExtensionTest extends TestCase
{
    private $admin;
    private $galleryManager;
    private $container;

    protected function setUp(): void
    {
        $this->admin = $this->createMock(AdminInterface::class);
        $managerRegistry = $this->createMock(AbstractManagerRegistry::class);
        $this->galleryManager = new GalleryManager(Gallery::class, $managerRegistry);
        $this->container = new Container();
    }

    public function testConstructor()
    {

        $extension = new GalleryAdminExtension('imageGallery,videoGallery,gallery');
        $extension->setGalleryManager($this->galleryManager);
        $extension->prePersist($this->admin, $this->container);

        $this->assertInstanceOf(Gallery::class, $this->container->getImageGallery());
        $this->assertInstanceOf(Gallery::class, $this->container->getVideoGallery());
        $this->assertInstanceOf(Gallery::class, $this->container->getGallery());
    }
}


class Gallery extends BaseGallery {}


class Container
{
    /**
     * @var GalleryInterface|null
     */
    private $imageGallery;

    /**
     * @var GalleryInterface|null
     */
    private $videoGallery;

    /**
     * @var GalleryInterface|null
     */
    private $gallery;

    /**
     * @return GalleryInterface|null
     */
    public function getImageGallery(): ?GalleryInterface
    {
        return $this->imageGallery;
    }

    /**
     * @return GalleryInterface|null
     */
    public function getVideoGallery(): ?GalleryInterface
    {
        return $this->videoGallery;
    }

    /**
     * @return GalleryInterface|null
     */
    public function getGallery(): ?GalleryInterface
    {
        return $this->gallery;
    }

    /**
     * @param GalleryInterface|null $imageGallery
     * @return self
     */
    public function setImageGallery(?GalleryInterface $imageGallery): self
    {
        $this->imageGallery = $imageGallery;
        return $this;
    }

    /**
     * @param GalleryInterface|null $videoGallery
     * @return self
     */
    public function setVideoGallery(?GalleryInterface $videoGallery): self
    {
        $this->videoGallery = $videoGallery;
        return $this;
    }

    /**
     * @param GalleryInterface|null $gallery
     * @return self
     */
    public function setGallery(?GalleryInterface $gallery): self
    {
        $this->gallery = $gallery;
        return $this;
    }
}