<?php
namespace Manialib\Gbx\Map;

class Desc
{
    /**
     * @var string
     */
    protected $envir;
    /**
     * @var string
     */
    protected $mood;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $maptype;
    /**
     * @var string
     */
    protected $mapstyle;
    /**
     * @var bool
     */
    protected $validated;
    /**
     * @var int
     */
    protected $nbLaps;
    /**
     * @var int
     */
    protected $displaycost;
    /**
     * @var string
     */
    protected $mod;
    /**
     * @var bool
     */
    protected $hasghostblocks;

    /**
     * @param string $envir
     * @param string $mood
     * @param string $type
     * @param string $mapType
     * @param string $mapstyle
     * @param bool $validated
     * @param int $nblaps
     * @param int $displaycost
     * @param bool $hasghostblocks
     */
    public function __construct($envir, $mood, $type, $mapType, $mapstyle, $validated, $nblaps, $displaycost, $mod, $hasghostblocks)
    {
        $this->envir = $envir;
        $this->mood = $mood;
        $this->type = $type;
        $this->maptype = $mapType;
        $this->mapstyle = $mapstyle;
        $this->validated = $validated;
        $this->nbLaps = $nblaps;
        $this->displaycost = $displaycost;
        $this->mod = $mod;
        $this->hasghostblocks = $hasghostblocks;
    }

    /**
     * @return string
     */
    public function getEnvir()
    {
        return $this->envir;
    }

    /**
     * @return string
     */
    public function getMood()
    {
        return $this->mood;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMaptype()
    {
        return $this->maptype;
    }

    /**
     * @return string
     */
    public function getMapstyle()
    {
        return $this->mapstyle;
    }

    /**
     * @return bool
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @return int
     */
    public function getNbLaps()
    {
        return $this->nbLaps;
    }

    /**
     * @return int
     */
    public function getDisplaycost()
    {
        return $this->displaycost;
    }

    /**
     * @return string
     */
    public function getMod()
    {
        return $this->mod;
    }

    /**
     * @return bool
     */
    public function getHasghostblocks()
    {
        return $this->hasghostblocks;
    }
}
