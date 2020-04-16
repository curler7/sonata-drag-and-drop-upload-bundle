<?php

namespace SmartMedia\SonataDragAndDropUploadBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\MediaBundle\Admin\GalleryAdmin as BaseGalleryAdmin;


class GalleryAdmin extends BaseGalleryAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Gallery', ['class' => 'col-md-12'])->end()


            ->with('Gallery')
                ->add('galleryHasMedias', CollectionType::class, [
                    'by_reference' => false,
                    'btn_add' => false
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position'
            ])
            ->end()
        ;
    }
}