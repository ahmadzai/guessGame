<?php

namespace Guess\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guess\Bundle\Entity\Player
 */
class Player
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $logindate
     */
    private $logindate;

    /**
     * @var integer $id
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set logindate
     *
     * @param string $logindate
     */
    public function setLogindate($logindate)
    {
        $this->logindate = $logindate;
    }

    /**
     * Get logindate
     *
     * @return string 
     */
    public function getLogindate()
    {
        return $this->logindate;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}