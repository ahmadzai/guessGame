<?php

namespace Guess\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guess\Bundle\Entity\Top10score
 *
 * @ORM\Table(name="Top10Score")
 * @ORM\Entity
 */
class Top10score
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $gametype
     *
     * @ORM\Column(name="gametype", type="integer", nullable=false)
     */
    private $gametype;

    /**
     * @var integer $gamelevel
     *
     * @ORM\Column(name="gamelevel", type="integer", nullable=false)
     */
    private $gamelevel;

    /**
     * @var integer $score
     *
     * @ORM\Column(name="score", type="integer", nullable=false)
     */
    private $score;

    /**
     * @var datetime $date
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;



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
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
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