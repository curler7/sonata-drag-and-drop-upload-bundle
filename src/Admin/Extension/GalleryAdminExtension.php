<?php

namespace Curler\SonataDragAndDropUploadBundle\Admin\Extension;

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
     * @param array $galleries
     */
    public function __construct(array $galleries)
    {
        $this->galleries = $galleries;
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist(AdminInterface $admin, $object)
    {
        foreach (explode(',', $this->galleries[$admin->getCode()]) as $item) {
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