<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TricksRepository")
 */
class Tricks
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image")
     * @ORM\Column(type="string")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video")
     * @ORM\Column(type="string")
     */
    private $video;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chat")
     * @ORM\Column(type="string")
     */
    private $chat;
}
