<?php

use Manialib\Gbx\Map\Parser;

class ParserTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function propertyProvider()
    {
        $rawData = file_get_contents(__DIR__.'/Valley - Mini-2.Map.Gbx');

        $map = Parser::parseString($rawData);
        return [
            //Header
            [$map->getHeader()->getType(), 'map'],
            [$map->getHeader()->getExever(), '3.3.0'],
            [$map->getHeader()->getExebuild(), '2014-11-21_17_57'],
            [$map->getHeader()->getTitle(), 'TMValley'],
            [$map->getHeader()->getLightmap(), '6'],
            //Ident
            [$map->getHeader()->getIdent()->getUid(), 'Qeca3ztXLSQD7jx3xO40wrzmLH1'],
            [$map->getHeader()->getIdent()->getName(), '$s$w$fffValley $f40- $0f1Mini$f40-$0f12'],
            [$map->getHeader()->getIdent()->getAuthor(), 'willie-maykit'],
            [$map->getHeader()->getIdent()->getAuthorZone(), 'World|Europe|United Kingdom|England|Yorkshire & the Humb'],
            //Desc
            [$map->getHeader()->getDesc()->getEnvir(), 'Valley'],
            [$map->getHeader()->getDesc()->getMood(), 'Day'],
            [$map->getHeader()->getDesc()->getType(), 'Race'],
            [$map->getHeader()->getDesc()->getMaptype(), 'Trackmania\Race'],
            [$map->getHeader()->getDesc()->getMapstyle(), ''],
            [$map->getHeader()->getDesc()->getValidated(), true],
            [$map->getHeader()->getDesc()->getNbLaps(), '0'],
            [$map->getHeader()->getDesc()->getDisplaycost(), 1863],
            [$map->getHeader()->getDesc()->getMod(), ''],
            [$map->getHeader()->getDesc()->getHasghostblocks(), true],
            //Playermodel
            [$map->getHeader()->getPlayermodel()->getId(), ''],
            //Times
            [$map->getHeader()->getTimes()->getBronze(), 53000],
            [$map->getHeader()->getTimes()->getSilver(), 43000],
            [$map->getHeader()->getTimes()->getGold(), 38000],
            [$map->getHeader()->getTimes()->getAuthortime(), 35282],
            [$map->getHeader()->getTimes()->getAuthorscore(), 35282],
            //Deps
            [$map->getHeader()->getDeps()[0]->getFile(), 'Skins\Valley\CircuitScreen\Right.webm'],
            [$map->getHeader()->getDeps()[0]->getUrl(), ''],
            [$map->getHeader()->getDeps()[1]->getFile(), 'Skins\Any\Advertisement\SignWarning.dds'],
            [$map->getHeader()->getDeps()[1]->getUrl(), ''],
            [$map->getHeader()->getDeps()[2]->getFile(), 'Skins\Any\Advertisement\SignDown.dds'],
            [$map->getHeader()->getDeps()[2]->getUrl(), ''],
            [$map->getHeader()->getDeps()[3]->getFile(), 'Skins\Valley\CircuitScreen\Down.webm'],
            [$map->getHeader()->getDeps()[3]->getUrl(), ''],
            [$map->getHeader()->getDeps()[4]->getFile(), 'Skins\Valley\CircuitScreen\Left.webm'],
            [$map->getHeader()->getDeps()[4]->getUrl(), ''],
            [$map->getHeader()->getDeps()[5]->getFile(), 'Skins\Models\CarCommon\tommi_valleycar.zip'],
            [$map->getHeader()->getDeps()[5]->getUrl(), 'http://unc-crew.dk/ftp_upload/manialink/tm2/cars/tommi_valleycar.zip'],
            [$map->getHeader()->getDeps()[6]->getFile(), 'Skins\Horns\TrackMania\hornC5.wav'],
            [$map->getHeader()->getDeps()[6]->getUrl(), ''],
            //comments
            [$map->getComments(), ''],
        ];

    }

    /**
     * @dataProvider propertyProvider
     */
    public function testProperty($input, $expected)
    {
        $this->assertEquals($expected, $input);
    }
}