<?php
namespace Manialib\Gbx;

use Manialib\Gbx\Map\Header;
use Manialib\Gbx\Map\Parser;
use Manialib\Gbx\Map\Thumbnail;

class Map
{
    /**
     * @var Header
     */
    protected $header;

    /**
     * @var Thumbnail
     */
    protected $thumbnail;

    /**
     * @var string
     */
    protected $comments;

    /**
     * @param string $filename
     * @return Map
     */
    public static function loadFile($filename)
    {
        return Parser::parseFile($filename);
    }

    /**
     * @param string $string
     * @return Map
     */
    public static function loadString($string)
    {
        return Parser::parseString($string);
    }

    /**
     * @param Header $header
     * @param Thumbnail $thumbnail
     * @param string $comments
     */
    public function __construct(Header $header, Thumbnail $thumbnail, $comments)
    {
        $this->header = $header;
        $this->thumbnail = $thumbnail;
        $this->comments = $comments;
    }


    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return Thumbnail
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }
}
