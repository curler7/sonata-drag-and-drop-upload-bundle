<?php

namespace Curler\SonataDragAndDropUploadBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DragAndDropUploadType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('binaryContent', FileType::class, [
                'attr' => [
                    'multiple' => true
                ]
            ]);
    }

    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['controller_action'] = $options['controller_action'];
        $view->vars['provider'] = $options['provider'];
        $view->vars['association'] = $options['association'];
        $view->vars['refresh'] = $options['refresh'];
        $view->vars['max_file_size'] = $options['max_file_size'];
        $view->vars['context'] = $options['context'];
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired([
            'data_class',
            'association'
        ]);

        $resolver->setDefaults([
            'required' => false,
            'provider' => 'sonata.media.provider.image',
            'context' => 'default',
            'controller_action' => 'admin_sonata_media_media_drag_and_drop_upload',
            'refresh' => true,
            'max_file_size' => 0
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return self::class;
    }
}