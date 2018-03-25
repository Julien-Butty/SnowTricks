<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $identif;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @var
     * @Assert\Regex(
     *     pattern="#^(http|https)://(www.youtube.com|www.dailymotion.com|vimeo.com)/#",
     *     match=true,
     *     message="Votre video doit être une video Youtube, Dailymotion ou Vimeo"
     * )
     */
    private $url;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\Trick", inversedBy="videos")
     * @ORM\JoinColumn(name="trick_id", onDelete="SET NULL")
     */
    private $trick;

    /**
     * @return mixed
     */
    public function getTrick()
    {
        return $this->trick;
    }

    /**
     * @param mixed $trick
     */
    public function setTrick($trick): void
    {
        $this->trick = $trick;
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getIdentif(): string
    {
        return $this->identif;
    }

    /**
     * @param string $identif
     */
    public function setIdentif(string $identif): void
    {
        $this->identif = $identif;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }


    private function youtubeId($url)
    {
        $tableaux = explode("=", $url);

        $this->setIdentif($tableaux[1]);
        $this->setType('youtube');
    }

    private function dailymotionId($url)
    {
        $cas = explode("/", $url);
        $idb = $cas[4];
        $bp = explode("_", $idb);
        $id = $bp[0];

        $this->setIdentif($id);
        $this->setType('dailymotion');
    }

    private function vimeoId($url)
    {
        $tableaux = explode("/", $url);

        $id = $tableaux[count($tableaux) - 1];

        $this->setIdentif($id);

        $this->setType('vimeo');
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @ORM\PreFlush()
     */
    public function extractIdentif()
    {
        $url = $this->getUrl();

        if (preg_match("#^(http|https)://www.youtube.com/#", $url)) {
            $this->youtubeId($url);
        } else if ((preg_match("#^(http|https)://www.dailymotion.com/#", $url))) {
            $this->dailymotionId($url);
        } else if ((preg_match("#^(http|https)://vimeo.com/#", $url))) {
            $this->vimeoId($url);
        }
    }

    private function url()
    {
        $control = $this->getType();
        $id = strip_tags($this->getIdentif());

        if ($control == 'youtube') {

            $embed = "https://www.youtube-nocookie.com/embed/" . $id;
            return $embed;
        } elseif ($control == 'dailymotion') {

            $embed = "https://www.dailymotion.com/embed/video" . $id;
            return $embed;
        } elseif ($control == 'vimeo') {

            $embed = "https://player.vimeo.com/video/" . $id;
            return $embed;
        }
    }

    public function image()
    {
        $control = $this->getType();
        $id = strip_tags($this->getIdentif());

        if($control == 'youtube')
        {
            $image = 'https://img.youtube.com/vi/'. $id. '/hqdefault.jpg';
            return $image;
        }
        else if ($control == 'dailymotion')
        {
            $image = 'https://www.dailymotion.com/thumbnail/150x120/video/'. $id. '' ;
            return $image;
        }
        else if($control == 'vimeo')
        {
            $hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/".$id.".php"));
            $image = $hash[0]['thumbnail_small'];
            return $image;
        }

    }

    public function video()
    {
        $video = "<iframe width='100%' height='100%' src='".$this->url()."'  frameborder='0'  allowfullscreen></iframe>";
        return $video;
    }

}
