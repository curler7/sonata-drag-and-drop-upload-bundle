<?php

namespace SmartMedia\SonataDragAndDropUploadBundle\Admin\Extension;

use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\MediaBundle\Model\GalleryManagerInterface;


class GalleryAdminExtension extends AbstractAdminExtension
{
    /**
     * @var GalleryManagerInterface
     */
    protected $galleryManager;

    /**
     * @var array
     */
    protected $galleries;


    /**
     * @param $tag
     */
    public function __construct($tag = true)
    {
        $this->galleries = is_string($tag) ? explode(',', $tag) : ['gallery'];
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist(AdminInterface $admin, $object)
    {
        foreach ($this->galleries as $item) {
            $gallery = $this->galleryManager->create();
            $gallery->setName('Gallery');
            $gallery->setEnabled(true);
            $gallery->setContext('default');

            $object->{'set'. ucfirst($item)}($gallery);
        }
    }

    /**
     * @param GalleryManagerInterface $galleryManager
     */
    public function setGalleryManager(GalleryManagerInterface $galleryManager)
    {
        $this->galleryManager = $galleryManager;
    }
}