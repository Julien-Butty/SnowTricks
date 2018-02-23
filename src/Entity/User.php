<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="Cette adresse email est déjà utilisée!")
 */
class User implements UserInterface
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
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string")
     */
    private $email;


    /**
     * @ORM\Column(type="string")
     *
     */
    private $avatar;
    /**
     * @var
     * @ORM\Column(type="string", nullable=false)
     */
    private $password;

    /**
     * @var string
     * @Assert\NotBlank(groups={"Registration"})
     */
    private $plainPassword;


    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var
     * @ORM\Column(type="string", nullable=true)
     */
    private $resetToken;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="App\Entity\Chat", mappedBy="user")
     */
    private $chat;

    /**
     * @return mixed
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * @param mixed $chat
     */
    public function setChat($chat): void
    {
        $this->chat = $chat;
    }

    /**
     * @return mixed
     */
    public function getResetToken()
    {
        return $this->resetToken;
    }

    /**
     * @param mixed $resetToken
     */
    public function setResetToken($resetToken): void
    {
        $this->resetToken = $resetToken;
    }


    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }
    public function getPassword()
    {
        return $this->password;
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
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }
    public function getRoles()
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }
        return $roles;
    }
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function eraseCredentials()
    {
        $this->plainPassword = null;
        $this->resetToken = null;
    }
}