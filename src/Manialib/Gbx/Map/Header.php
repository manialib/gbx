<?php
/**
 * Created by PhpStorm.
 * User: Philippe
 * Date: 11/12/2014
 * Time: 11:42
 */

namespace Manialib\Gbx\Map;


class Header
{
    const EXEBUILD_FORMAT = 'Y-m-d_G_i';

    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $exever;
    /**
     * @var string
     */
    protected $exebuild;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $lightmap;

    /**
     * @var Ident
     */
    protected $ident;
    /**
     * @var Desc
     */
    protected $desc;
    /**
     * @var PlayerModel
     */
    protected $playermodel;
    /**
     * @var Times
     */
    protected $times;
    /**
     * @var Dep[]
     */
    protected $deps = array();

    /**
     * @param string $type
     * @param string $exever
     * @param string $exebuild
     * @param string $title
     * @param string $lightmap
     * @param Ident $ident
     * @param Desc $desc
     * @param Times $times
     * @param Dep[] $deps
     * @param PlayerModel $playermodel
     */
    function __construct($type, $exever, $exebuild, $title, $lightmap, Ident $ident,Desc $desc, Times $times, array $deps, PlayerModel $playermodel = null)
    {
        $this->deps = $deps;
        $this->desc = $desc;
        $this->exebuild = $exebuild;
        $this->exever = $exever;
        $this->ident = $ident;
        $this->lightmap = $lightmap;
        $this->playermodel = $playermodel;
        $this->times = $times;
        $this->title = $title;
        $this->type = $type;
    }

    /**
     * @return Dep[]
     */
    public function getDeps()
    {
        return $this->deps;
    }

    /**
     * @return Desc
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @return string
     */
    public function getExebuild()
    {
        return $this->exebuild;
    }

    /**
     * @return string
     */
    public function getExever()
    {
        return $this->exever;
    }

    /**
     * @return Ident
     */
    public function getIdent()
    {
        return $this->ident;
    }

    /**
     * @return string
     */
    public function getLightmap()
    {
        return $this->lightmap;
    }

    /**
     * @return PlayerModel
     */
    public function getPlayermodel()
    {
        return $this->playermodel;
    }

    /**
     * @return Times
     */
    public function getTimes()
    {
        return $this->times;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


} 