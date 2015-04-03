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
    /**
     * @param string $content
     * @return Map
     */
    public static function parseString($content)
    {
        $stream = fopen('php://memory', 'rb+');
        fwrite($stream, $content);
        rewind($stream);
        $data = static::parse($stream);
        fclose($stream);
        return $data;
    }

    /**
     * @param string $filename
     * @return Map
     */
    public static function parseFile($filename)
    {
        $file = fopen($filename, 'rb');
        $data = static::parse($file);
        fclose($file);
        return $data;
    }

    /**
     * @param string $content
     * @return Map
     */
    protected static function parse($fileHandler)
    {
        self::ignore($fileHandler, 9);
        $classId = self::fetchLong($fileHandler);
        if ($classId != 0x03043000)
            throw new \InvalidArgumentException('File is not a map');
        self::ignore($fileHandler, 4);
        $nbChunks = self::fetchLong($fileHandler);
        $chunkInfos = array();
        for (; $nbChunks > 0; --$nbChunks)
            $chunkInfos[self::fetchLong($fileHandler)] = self::fetchLong($fileHandler);

        $properties = [];
        foreach ($chunkInfos as $chunkId => $chunkSize) {
            switch ($chunkId) {
                case 0x03043005:
                    $properties = array_merge($properties, self::parseXMLHeader($fileHandler));
                    break;
                case 0x03043007:
                    $properties = array_merge($properties, self::parseThumbnailAndComment($fileHandler));
                    break;
                default:
                    self::ignore($fileHandler, $chunkSize & 0x7fffffff);
            }
        }

        return new Map($properties);
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

    protected static function fetchLong($fp)
    {
        $long = unpack('V', fread($fp, 4));
        return $long[1];
    }

    protected static function fetchString($fp)
    {
        $length = self::fetchLong($fp);
        return $length ? fread($fp, $length) : '';
    }

    protected static function ignore($fp, $length)
    {
        fread($fp, $length);
    }

    protected static function parseXMLHeader($fp)
    {
        $properties = [];
        $domDocument = new \DOMDocument();
        $internalError = libxml_use_internal_errors(true);
        $domDocument->loadHTML('<?xml encoding="UTF-8">' . self::fetchString($fp));
        libxml_use_internal_errors($internalError);

        $header = static::getNodeAttributesValues($domDocument->getElementsByTagName('header')->item(0));
        $properties['exeVersion'] = array_key_exists('exever', $header) ? $header['exever'] : null;
        $properties['exeBuild'] = array_key_exists('exebuild', $header) ? $header['exebuild'] : null;
        $properties['title'] = array_key_exists('title', $header) ? $header['title'] : null;
        $properties['lightmap'] = array_key_exists('lightmap', $header) ? $header['lightmap'] : null;

        $ident = static::getNodeAttributesValues($domDocument->getElementsByTagName('ident')->item(0));
        $properties['uid'] = array_key_exists('uid', $ident) ? $ident['uid'] : null;
        $properties['name'] = array_key_exists('name', $ident) ? $ident['name'] : null;
        $properties['author'] = array_key_exists('author', $ident) ? $ident['author'] : null;
        $properties['authorZone'] = array_key_exists('authorzone', $ident) ? $ident['authorzone'] : null;

        $desc = static::getNodeAttributesValues($domDocument->getElementsByTagName('desc')->item(0));
        $properties['environment'] = array_key_exists('envir', $desc) ? $desc['envir'] : null;
        $properties['mood'] = array_key_exists('mood', $desc) ? $desc['mood'] : null;
        $properties['type'] = array_key_exists('mood', $desc) ? $desc['type'] : null;
        $properties['mapType'] = array_key_exists('maptype', $desc) ? $desc['maptype'] : null;
        $properties['mapStyle'] = array_key_exists('mapstyle', $desc) ? $desc['mapstyle'] : null;
        $properties['validated'] = array_key_exists('validated', $desc) ? (bool)$desc['validated'] : null;
        $properties['nbLaps'] = array_key_exists('nblaps', $desc) ? (int)$desc['nblaps'] : null;
        $properties['displayCost'] = array_key_exists('displaycost', $desc) ? (int)$desc['displaycost'] : null;
        $properties['mod'] = array_key_exists('mod', $desc) ? $desc['mod'] : null;
        $properties['hasGhostBlocks'] = array_key_exists('hasghostblocks', $desc) ? (bool)$desc['hasghostblocks'] : null;

        $playerModel = static::getNodeAttributesValues($domDocument->getElementsByTagName('playermodel')->item(0));
        $properties['playerModel'] = array_key_exists('id', $playerModel) ? $playerModel['id'] : null;

        $times = static::getNodeAttributesValues($domDocument->getElementsByTagName('times')->item(0));
        $properties['bronzeMedal'] = array_key_exists('bronze', $times) ? (int)$times['bronze'] : null;
        $properties['silverMedal'] = array_key_exists('silver', $times) ? (int)$times['silver'] : null;
        $properties['goldMedal'] = array_key_exists('gold', $times) ? (int)$times['gold'] : null;
        $properties['authorTime'] = array_key_exists('authortime', $times) ? (int)$times['authortime'] : null;
        $properties['authorScore'] = array_key_exists('authorscore', $times) ? (int)$times['authorscore'] : null;

        $dependenciesNode = $domDocument->getElementsByTagName('deps')->item(0);
        foreach ($dependenciesNode->childNodes as $childNode) {
            if ($childNode->nodeName == 'dep') {
                $depAttributes = static::getNodeAttributesValues($childNode);
                $file = $depAttributes['file'];
                $url = array_key_exists('url', $depAttributes) ? $depAttributes['url'] : '';
                $properties['dependencies'][] = new Dependency($file, $url);
            }
        }

        return $properties;
    }

    protected static function parseThumbnailAndComment($fp)
    {
        $haveThumbnail = self::fetchLong($fp);
        $properties = [];
        if ($haveThumbnail) {
            $thumbSize = self::fetchLong($fp);
            self::ignore($fp, strlen('<Thumbnail.jpg>'));
            if ($thumbSize) {
                if (!extension_loaded('gd'))
                    self::ignore($fp, $thumbSize);
                else {
                    $gdImage = imagecreatefromstring(fread($fp, $thumbSize));
                    imageflip($gdImage, IMG_FLIP_VERTICAL);
                    ob_start();
                    imagejpeg($gdImage, null, 100);
                    $properties['thumbnail'] = new Thumbnail(ob_get_contents());
                    ob_end_clean();
                }
            }
            self::ignore($fp, strlen('</Thumbnail.jpg>'));
            self::ignore($fp, strlen('<Comments>'));
            $properties['comments'] = self::fetchString($fp);
            self::ignore($fp, strlen('</Comments>'));
        }
        return $properties;
    }
}