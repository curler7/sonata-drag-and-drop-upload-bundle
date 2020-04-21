Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require curler/sonata-drag-and-drop-upload-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require curler/sonata-drag-and-drop-upload-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Curler\SonataDragAndDropUploadBundle\CurlerSonataDragAndDropUploadBundle::class => ['all' => true],
];
```

Usage
----------------------------------------

### Step 1: Association Mapping

In our entity create an association mapping to the gallery you want to use.
There are two traits for getter and setter methods.


```php
// Entity/Archive.php

use Curler\SonataDragAndDropUploadBundle\Helper\GalleryableInterface;
use Curler\SonataDragAndDropUploadBundle\Helper\GalleryableTrait;
use Curler\SonataDragAndDropUploadBundle\Helper\MediaableTrait;

use Sonata\MediaBundle\Model\GalleryInterface;

class Archive implements GalleryableInterface
{
    use MediaableTrait,
        GalleryableTrait;


    /**
     * @var GalleryInterface|null
     *
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Gallery", cascade={"all"})
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     */
    protected $gallery;
}
```

### Step 2: Configure Form Fields

In our admin create a form filed with DragAndDropUploadType.
Wrap it in an if statement to execute it after creation.


```php
// Admin/ArchiveAdmin.php

use App\Application\Sonata\MediaBundle\Entity\Media;
use Curler\SonataDragAndDropUploadBundle\Form\Type\DragAndDropUploadType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\Type\AdminType;


class ArchiveAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        if ( ! $this->isCurrentRoute('create')) {
            $form->
                tab('tab_nav.label_gallery')
                    ->with('tab_nav.label_drag_and_drop')
                        ->add('media', DragAndDropUploadType::class, [
                            'data_class' => Media::class,
                            'association' => $this->subject->getGallery()
                        ])
                    ->end()
                    ->with('tab_nav.label_gallery')
                        ->add('gallery', AdminType::class, [
                            'required' => false,
                            ], [
                            'edit' => 'inline',
                            'inline' => 'table',
                        ])
                    ->end()
                ->end()
            ;
        }
    }
}
```

### Step 3: Config

Add entity classes to bundle config 

```yaml
// config/packages/curler_sonata_drag_and_drop_upload.yaml

curler_sonata_drag_and_drop_upload:
    class:
        media: App\Application\Sonata\MediaBundle\Entity\Media
        gallery: App\Application\Sonata\MediaBundle\Entity\Gallery
        gallery_has_media: App\Application\Sonata\MediaBundle\Entity\GalleryHasMedia
```

In our services.yaml add a drag_and_drop_upload tag.

```yaml
// config/services.yaml

    admin.archive:
        class: App\Admin\ArchiveAdmin
        arguments: [~, App\Entity\Archive, ~]
        tags:
            - { name: sonata.admin, manager_type: orm, drag_and_drop_upload: true }
```

Add JavaScript and CSS to Sonata Admin config

```yaml
// config/packages/curler_sonata_drag_and_drop_upload.yaml

sonata_admin:
    assets:
        extra_stylesheets:
            - dist/sonata-drag_and_drop_upload.css

        extra_javascripts:
            - dist/sonata-drag_and_drop_upload.js
```

### Optional

If you have many galleries in our entity, you can pass
them in our services.yaml separated by [,].
Thanks to the admin extension, who persist for each a gallery.

 ```yaml
 // config/services.yaml
 
     admin.archive:
         class: App\Admin\ArchiveAdmin
         arguments: [~, App\Entity\Archive, ~]
         tags:
             - { name: sonata.admin, manager_type: orm, drag_and_drop_upload: 'imageGallery,videoGallery,gallery' }
 ```