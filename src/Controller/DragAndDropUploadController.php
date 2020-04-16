<?php

namespace SmartMedia\SonataDragAndDropUploadBundle\Controller;

use Sonata\MediaBundle\Controller\MediaAdminController;
use Sonata\MediaBundle\Model\GalleryHasMediaInterface;
use Sonata\MediaBundle\Model\GalleryInterface;
use Sonata\MediaBundle\Model\GalleryManagerInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Model\MediaManagerInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DragAndDropUploadController extends MediaAdminController
{
    /**
     * @var MediaManagerInterface
     */
    protected $mediaManager;

    /**
     * @var GalleryManagerInterface
     */
    protected $galleryManager;

    /**
     * @var GalleryHasMediaInterface
     */
    protected $galleryHasMedia;


    /**
     * @param MediaManagerInterface $mediaManager
     * @param GalleryManagerInterface $galleryManager
     * @param string $galleryHasMedia
     */
    public function __construct(
        MediaManagerInterface $mediaManager,
        GalleryManagerInterface $galleryManager,
        string $galleryHasMedia
    ) {
        $this->mediaManager = $mediaManager;
        $this->galleryManager = $galleryManager;
        $this->galleryHasMedia = new $galleryHasMedia();
        if ( ! $this->galleryHasMedia instanceof GalleryHasMediaInterface) {
            throw new \InvalidArgumentException(sprintf('%s must instance of: %s', $galleryHasMedia, GalleryHasMediaInterface::class));
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function dragAndDropUploadAction(Request $request)
    {
        $this->admin->checkAccess('create');

        $providerName = $request->query->get('provider');
        $context = $request->query->get('context', 'default');

        /** @var MediaInterface $media */
        $media = $this->mediaManager->create();
        $media->setContext($context);
        $media->setBinaryContent($request->files->get('file'));
        $media->setProviderName($providerName);
        $media->setEnabled(true);
        $this->mediaManager->save($media);

        /** @var GalleryInterface */
        $gallery = $this->galleryManager->find($request->query->get('association'));

        $this->galleryHasMedia->setGallery($gallery);
        $this->galleryHasMedia->setMedia($media);

        $gallery->addGalleryHasMedia($this->galleryHasMedia);
        $this->galleryManager->save($gallery);

        return new JsonResponse([
            'status' => 'ok',
            'path' => $this->get($providerName)->generatePublicUrl($media, MediaProviderInterface::FORMAT_ADMIN),
            'edit' => $this->admin->generateUrl('edit', ['id' => $media->getId()]),
            'id' => $media->getId(),
        ]);
    }
}