<?php

namespace SmartMedia\SonataDragAndDropUploadBundle\Admin;

use SmartMedia\SonataDragAndDropUploadBundle\Form\Type\MediaListType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Admin\GalleryHasMediaAdmin as BaseGalleryHasMediaAdmin;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class GalleryHasMediaAdmin extends BaseGalleryHasMediaAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $link_parameters = [];

        if ($this->hasParentFieldDescription()) {
            $link_parameters = $this->getParentFieldDescription()->getOption('link_parameters', []);
        }

        if ($this->hasRequest()) {
            $context = $this->getRequest()->get('context', null);

            if (null !== $context) {
                $link_parameters['context'] = $context;
            }
        }

        $formMapper
            ->add('media', MediaListType::class)
            ->add('position', HiddenType::class)
        ;
    }
}