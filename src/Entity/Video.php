<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $embed;

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
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @param mixed $embed
     */
    public function setEmbed($embed): void
    {
        $this->embed = $embed;
    }

    /**
     * @return mixed
     */
    public function getTricksVideo()
    {
        return $this->tricksVideo;
    }

    /**
     * @param mixed $tricksVideo
     */
    public function setTricksVideo($tricksVideo): void
    {
        $this->tricksVideo = $tricksVideo;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tricks")
     */
    private $tricksVideo;

}
