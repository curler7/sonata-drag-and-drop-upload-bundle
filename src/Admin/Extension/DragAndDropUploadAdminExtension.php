<?php

namespace Curler\SonataDragAndDropUploadBundle\Admin\Extension;

use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;


class DragAndDropUploadAdminExtension extends AbstractAdminExtension
{
    /**
     * {@inheritDoc}
     */
    public function configureRoutes(AdminInterface $admin, RouteCollection $collection)
    {
        $collection->add('drag_and_drop_upload', 'drag_and_drop_upload');
    }
}