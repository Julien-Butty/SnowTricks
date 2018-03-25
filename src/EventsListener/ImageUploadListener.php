<?php


namespace App\EventsListener;

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


        dump('preupdate');

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
//        dump('upload');
//        if (!$entity instanceof Trick) {
//            return;
//        }
//        foreach ($entity->getImages() as $image) {
//            dump('check image');
//
//            if ($image->getFile() instanceof UploadedFile) {
//                dump('new upload');
//                $fileName = $this->uploader->upload($image->getFile());
//                $image->setUrl($fileName);
//            }
//        }
        if (!$entity instanceof Trick ) {
            return;
        }

        $file = $entity->getImages();

        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setImages($fileName);
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