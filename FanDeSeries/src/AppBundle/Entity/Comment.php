<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="pRate", type="boolean")
     */
    private $pRate;

    /**
     * @var bool
     *
     * @ORM\Column(name="nRate", type="boolean")
     */
    private $nRate;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pRate
     *
     * @param boolean $pRate
     * @return Comment
     */
    public function setPRate($pRate)
    {
        $this->pRate = $pRate;

        return $this;
    }

    /**
     * Get pRate
     *
     * @return boolean 
     */
    public function getPRate()
    {
        return $this->pRate;
    }

    /**
     * Set nRate
     *
     * @param boolean $nRate
     * @return Comment
     */
    public function setNRate($nRate)
    {
        $this->nRate = $nRate;

        return $this;
    }

    /**
     * Get nRate
     *
     * @return boolean 
     */
    public function getNRate()
    {
        return $this->nRate;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
