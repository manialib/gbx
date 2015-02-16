<?php
/**
 * Created by PhpStorm.
 * User: Philippe
 * Date: 11/12/2014
 * Time: 11:44
 */

namespace Manialib\Gbx\Map;

class Ident
{
    /**
     * @var string
     */
    protected $uid;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $author;
    /**
     * @var string
     */
    protected $authorZone;

    /**
     * @param string $uid
     * @param string $name
     * @param string $author
     * @param string $authorZone
     */
    public function __construct($uid, $name, $author, $authorZone)
    {
        $this->author = $author;
        $this->authorZone = $authorZone;
        $this->name = $name;
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getAuthorZone()
    {
        return $this->authorZone;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }
}
