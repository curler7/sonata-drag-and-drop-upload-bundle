<?php

namespace Curler\SonataDragAndDropUploadBundle\Helper;

use Sonata\MediaBundle\Model\GalleryInterface;


trait GalleryableTrait
{
    /**
     * @var GalleryInterface|null
     */
    protected $gallery;


    /**
     * @return GalleryInterface|null
     */
    public function getGallery(): ?GalleryInterface
    {
        return $this->gallery;
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