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
            [$map->getExeVersion(), '3.3.0'],
            [$map->getExeBuild(), '2014-11-21_17_57'],
            [$map->getTitle(), 'TMValley'],
            [$map->getLightmap(), '6'],
            //Ident
            [$map->getUid(), 'Qeca3ztXLSQD7jx3xO40wrzmLH1'],
            [$map->getName(), '$s$w$fffValley $f40- $0f1Mini$f40-$0f12'],
            [$map->getAuthor(), 'willie-maykit'],
            [$map->getAuthorZone(), 'World|Europe|United Kingdom|England|Yorkshire & the Humb'],
            //Desc
            [$map->getEnvironment(), 'Valley'],
            [$map->getMood(), 'Day'],
            [$map->getType(), 'Race'],
            [$map->getMaptype(), 'Trackmania\Race'],
            [$map->getMapstyle(), ''],
            [$map->isValidated(), true],
            [$map->getNbLaps(), '0'],
            [$map->getDisplaycost(), 1863],
            [$map->getMod(), ''],
            [$map->hasGhostBlocks(), true],
            //Playermodel
            [$map->getPlayermodel(), ''],
            //Times
            [$map->getBronzeMedal(), 53000],
            [$map->getSilverMedal(), 43000],
            [$map->getGoldMedal(), 38000],
            [$map->getAuthorTime(), 35282],
            [$map->getAuthorScore(), 35282],
            //Deps
            [$map->getDependencies()[0]->getFile(), 'Skins\Valley\CircuitScreen\Right.webm'],
            [$map->getDependencies()[0]->getUrl(), ''],
            [$map->getDependencies()[1]->getFile(), 'Skins\Any\Advertisement\SignWarning.dds'],
            [$map->getDependencies()[1]->getUrl(), ''],
            [$map->getDependencies()[2]->getFile(), 'Skins\Any\Advertisement\SignDown.dds'],
            [$map->getDependencies()[2]->getUrl(), ''],
            [$map->getDependencies()[3]->getFile(), 'Skins\Valley\CircuitScreen\Down.webm'],
            [$map->getDependencies()[3]->getUrl(), ''],
            [$map->getDependencies()[4]->getFile(), 'Skins\Valley\CircuitScreen\Left.webm'],
            [$map->getDependencies()[4]->getUrl(), ''],
            [$map->getDependencies()[5]->getFile(), 'Skins\Models\CarCommon\tommi_valleycar.zip'],
            [$map->getDependencies()[5]->getUrl(), 'http://unc-crew.dk/ftp_upload/manialink/tm2/cars/tommi_valleycar.zip'],
            [$map->getDependencies()[6]->getFile(), 'Skins\Horns\TrackMania\hornC5.wav'],
            [$map->getDependencies()[6]->getUrl(), ''],
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