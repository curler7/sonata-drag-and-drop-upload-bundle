<?php

namespace SmartMedia\SonataDragAndDropUploadBundle\Helper;

use Sonata\MediaBundle\Model\MediaInterface;


trait MediaableTrait
{
    /**
     * @var MediaInterface|null
     */
    protected $media;

    /**
     * @return MediaInterface|null
     */
    public function getMedia(): ?MediaInterface
    {
        return $this->media;
    }

    /**
     * @param MediaInterface|null $media
     * @return self
     */
    public function setMedia(?MediaInterface $media): self
    {
        $this->media = $media;
        return $this;
    }
}