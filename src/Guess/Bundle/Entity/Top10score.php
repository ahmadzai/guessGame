<?php

namespace Guess\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guess\Bundle\Entity\Top10score
 */
class Top10score
{
    /**
     * @var integer $gametype
     */
    private $gametype;

    /**
     * @var integer $gamelevel
     */
    private $gamelevel;

    /**
     * @var integer $score
     */
    private $score;

    /**
     * @var string $date
     */
    private $date;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Guess\Bundle\Entity\Player
     */
    private $player;


    /**
     * Set gametype
     *
     * @param integer $gametype
     */
    public function setGametype($gametype)
    {
        $this->gametype = $gametype;
    }

    /**
     * Get gametype
     *
     * @return integer 
     */
    public function getGametype()
    {
        return $this->gametype;
    }

    /**
     * Set gamelevel
     *
     * @param integer $gamelevel
     */
    public function setGamelevel($gamelevel)
    {
        $this->gamelevel = $gamelevel;
    }

    /**
     * Get gamelevel
     *
     * @return integer 
     */
    public function getGamelevel()
    {
        return $this->gamelevel;
    }

    /**
     * Set score
     *
     * @param integer $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set date
     *
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
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

    /**
     * Set player
     *
     * @param Guess\Bundle\Entity\Player $player
     */
    public function setPlayer(\Guess\Bundle\Entity\Player $player)
    {
        $this->player = $player;
    }

    /**
     * Get player
     *
     * @return Guess\Bundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }
}