<?php
/**
 * Created by PhpStorm.
 * User: Philippe
 * Date: 12/12/2014
 * Time: 11:48
 */

namespace Manialib\Gbx\Map;

use Manialib\Gbx\Map;

class Parser
{
    const MIN_SUPPORTED_BUILD = '2014-05-16_00_00';

    /**
     * @param string $content
     * @return Map
     */
    public static function parseString($content)
    {
        return static::parse($content);
    }

    /**
     * @param string $filename
     * @return Map
     */
    public static function parseFile($filename)
    {
        $content = file_get_contents($filename);
        return static::parse($content);
    }

    /**
     * @param string $content
     * @return Map
     */
    protected static function parse($content)
    {
        $header = strstr($content, '<header');
        $header = strstr($header, '</header>', true) . '</header>';


        $domDocument = new \DOMDocument();
        $internalError = libxml_use_internal_errors(true);
        $domDocument->loadHTML('<?xml encoding="UTF-8">' . $header);
        libxml_use_internal_errors($internalError);

        $headerAttributes = static::getNodeAttributesValues($domDocument->getElementsByTagName('header')->item(0));
        if (\DateTime::createFromFormat(Header::EXEBUILD_FORMAT, static::MIN_SUPPORTED_BUILD) > \DateTime::createFromFormat(Header::EXEBUILD_FORMAT, $headerAttributes['exebuild'])) {
            throw new \InvalidArgumentException('Map created with an unsupported version of Maniaplanet');
        }

        $identAttributes = static::getNodeAttributesValues($domDocument->getElementsByTagName('ident')->item(0));
        $ident = new Ident(
            $identAttributes['uid'],
            $identAttributes['name'],
            $identAttributes['author'],
            $identAttributes['authorzone']
        );

        $descAttributes = static::getNodeAttributesValues($domDocument->getElementsByTagName('desc')->item(0));
        $desc = new Desc(
            $descAttributes['envir'],
            $descAttributes['mood'],
            $descAttributes['type'],
            $descAttributes['maptype'],
            $descAttributes['mapstyle'],
            (bool)$descAttributes['validated'],
            (int)$descAttributes['nblaps'],
            (int)$descAttributes['displaycost'],
            $descAttributes['mod'],
            (bool)$descAttributes['hasghostblocks']
        );

        $playerModelAttributes = static::getNodeAttributesValues($domDocument->getElementsByTagName('playermodel')->item(0));
        $playerModel = new PlayerModel($playerModelAttributes['id']);

        $timesAttributes = static::getNodeAttributesValues($domDocument->getElementsByTagName('times')->item(0));
        $times = new Times(
            (int)$timesAttributes['bronze'],
            (int)$timesAttributes['silver'],
            (int)$timesAttributes['gold'],
            (int)$timesAttributes['authortime'],
            (int)$timesAttributes['authorscore']
        );

        $depsNode = $domDocument->getElementsByTagName('deps')->item(0);
        $deps = array();
        foreach ($depsNode->childNodes as $childNode) {
            if ($childNode->nodeName == 'dep') {
                $depAttributes = static::getNodeAttributesValues($childNode);
                $file = $depAttributes['file'];
                $url = array_key_exists('url', $depAttributes) ? $depAttributes['url'] : '';
                $deps[] = new Dep($file, $url);
            }
        }

        $header = new Header(
            $headerAttributes['type'],
            $headerAttributes['exever'],
            $headerAttributes['exebuild'],
            $headerAttributes['title'],
            $headerAttributes['lightmap'],
            $ident,
            $desc,
            $times,
            $deps,
            $playerModel
        );

        $thumbnail = strstr($content, '<Thumbnail.jpg>');
        $thumbnail = substr($thumbnail, strlen('<Thumbnail.jpg>'));
        $thumbnail = strstr($thumbnail, '</Thumbnail.jpg>', true);

        $gdImage = imagecreatefromstring($thumbnail);
        imageflip($gdImage, IMG_FLIP_VERTICAL);
        ob_start();
        imagejpeg($gdImage, null, 100);
        $thumbnail = ob_get_contents();
        ob_end_clean();

        $comments = strstr($content, '<Comments>');
        $comments = substr($comments, strlen('<Comments>') + 4);
        $comments = strstr($comments, '</Comments>', true);

        return new Map($header, new Thumbnail($thumbnail), $comments);
    }

    /**
     * @param \DOMNode $node
     * @return \DOMNamedNodeMap
     */
    protected static function getNodeAttributesValues(\DOMNode $node)
    {
        $attributes = array();
        foreach ($node->attributes as $attribute) {
            $attributes[$attribute->nodeName] = $attribute->nodeValue;
        }

        return $attributes;
    }
}
