<?php

namespace Curler\SonataDragAndDropUploadBundle\Tests\App\Entity;

use Sonata\MediaBundle\Entity\BaseMedia;


class Media extends BaseMedia
{
    private $id;


    public function getId()
    {
        return $this->id;
    }
}