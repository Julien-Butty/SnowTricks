<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TricksRepository")
 */
class Trick
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @var Image[]|ArrayCollection
     *@ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="trick",cascade={"persist"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @var
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="trick", cascade={"persist"}, orphanRemoval=true)
     */
    private $videos;



    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\Chat", mappedBy="trick")
     */
    private $chats;

    public function __construct()
    {
        $this->chats = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->date = new \DateTime();

    }

    /**
     * @return ArrayCollection
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param mixed $videos
     */
    public function setVideos($videos): void
    {
        $this->videos = $videos;
    }

    public function addVideo(Video $video)
    {
        $this->videos[] = $video;
        $video->setTrick($this);
    }

    public function removeVideo(Video $video)
    {
        $this->videos->removeElement($video);
    }

    /**
     * @return ArrayCollection
     */
    public function getChats()
    {
        return $this->chats;
    }

    /**
     * @param mixed $chats
     */
    public function setChats($chats): void
    {
        $this->chats = $chats;
    }


    /**
     * @return Image[]|ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param ArrayCollection $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    public function addImage(Image $image)
    {
        if ($this->images->contains($image)) {
            return;
        }
        $this->images[] = $image;
        $image->setTrick($this);

        return $this;
    }

    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getTrickGroup()
    {
        return $this->trickGroup;
    }

    /**
     * @param mixed $trickGroup
     */
    public function setTrickGroup($trickGroup): void
    {
        $this->trickGroup = $trickGroup;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TrickGroup")
     */
    private $trickGroup;

    /**
     * @return mixed
     */
    public function __toString()
    {
      return $this->getDate();
    }


}
