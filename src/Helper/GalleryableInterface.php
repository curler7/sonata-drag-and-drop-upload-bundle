<?php

namespace App\Entity\Helper;

use Sonata\MediaBundle\Model\GalleryInterface;
use Sonata\MediaBundle\Model\MediaInterface;


interface GalleryableInterface
{
    /**
     * @return GalleryInterface|null
     */
    public function getGallery(): ?GalleryInterface;

    /**
     * @param GalleryInterface|null $gallery
     * @return self
     */
    public function setGallery(?GalleryInterface $gallery);

    /**
     * @return MediaInterface|null
     */
    public function getMedia(): ?MediaInterface;

    /**
     * @param MediaInterface|null $media
     * @return self
     */
    public function setMedia(?MediaInterface $media);
}