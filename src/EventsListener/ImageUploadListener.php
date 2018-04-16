<?php


namespace App\EventsListener;

use App\Entity\Image;
use App\Entity\Trick;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Service\FileUploader;

class ImageUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();


        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {

        if (!$entity instanceof Image) {
            return;
        }


        if ($entity->getFile() instanceof UploadedFile) {

            $fileName = $this->uploader->upload($entity->getFile());
            $entity->setUrl($fileName);

        }
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Trick) {
            return;
        }

        foreach ($entity->getImages() as $image) {

            $image->setFile(new File($this->uploader->getTargetDirectory() . '/' . $image->getUrl()));

        }
    }
}