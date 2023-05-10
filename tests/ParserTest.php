<?php

use Manialib\Gbx\Map\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testParseBigMap()
    {
        $map = Parser::parseFile(__DIR__ . '/fixtures/bigMap.Map.Gbx');

        //87562 is quite arbitrary and what I got frm my naive implementation. It might be also wrong
        $this->assertSame(87562, strlen($map->getComments()));
    }

    public function testParseMap()
    {
        $map = Parser::parseFile(__DIR__ . '/fixtures/Valley - Mini-2.Map.Gbx');

        $this->assertSame($map->getExeVersion(), '3.3.0');
        $this->assertSame($map->getExeBuild(), '2014-11-21_17_57');
        $this->assertSame($map->getTitle(), 'TMValley');
        $this->assertSame($map->getLightmap(), 6);
        //Ident
        $this->assertSame($map->getUid(), 'Qeca3ztXLSQD7jx3xO40wrzmLH1');
        $this->assertSame($map->getName(), '$s$w$fffValley $f40- $0f1Mini$f40-$0f12');
        $this->assertSame($map->getAuthor(), 'willie-maykit');
        $this->assertSame($map->getAuthorZone(), 'World|Europe|United Kingdom|England|Yorkshire & the Humb');
        //Desc
        $this->assertSame($map->getEnvironment(), 'Valley');
        $this->assertSame($map->getMood(), 'Day');
        $this->assertSame($map->getType(), 'Race');
        $this->assertSame($map->getType(), 'Race');
        $this->assertSame($map->getMapType(), 'Trackmania\Race');
        $this->assertSame($map->getMapStyle(), '');
        $this->assertSame($map->isValidated(), true);
        $this->assertSame($map->getNbLaps(), 0);
        $this->assertSame($map->getDisplayCost(), 1863);
        $this->assertSame($map->getMod(), '');
        $this->assertSame($map->hasGhostBlocks(), true);
        //Playermodel
        $this->assertSame($map->getPlayerModel(), '');
        //Times
        $this->assertSame($map->getBronzeMedal(), 53000);
        $this->assertSame($map->getSilverMedal(), 43000);
        $this->assertSame($map->getGoldMedal(), 38000);
        $this->assertSame($map->getAuthorTime(), 35282);
        $this->assertSame($map->getAuthorScore(), 35282);
        //Deps
        $this->assertSame($map->getDependencies()[0]->getFile(), 'Skins\Valley\CircuitScreen\Right.webm');
        $this->assertSame($map->getDependencies()[0]->getUrl(), '');
        $this->assertSame($map->getDependencies()[1]->getFile(), 'Skins\Any\Advertisement\SignWarning.dds');
        $this->assertSame($map->getDependencies()[1]->getUrl(), '');
        $this->assertSame($map->getDependencies()[2]->getFile(), 'Skins\Any\Advertisement\SignDown.dds');
        $this->assertSame($map->getDependencies()[2]->getUrl(), '');
        $this->assertSame($map->getDependencies()[3]->getFile(), 'Skins\Valley\CircuitScreen\Down.webm');
        $this->assertSame($map->getDependencies()[3]->getUrl(), '');
        $this->assertSame($map->getDependencies()[4]->getFile(), 'Skins\Valley\CircuitScreen\Left.webm');
        $this->assertSame($map->getDependencies()[4]->getUrl(), '');
        $this->assertSame($map->getDependencies()[5]->getFile(), 'Skins\Models\CarCommon\tommi_valleycar.zip');
        $this->assertSame($map->getDependencies()[5]->getUrl(), 'http://unc-crew.dk/ftp_upload/manialink/tm2/cars/tommi_valleycar.zip');
        $this->assertSame($map->getDependencies()[6]->getFile(), 'Skins\Horns\TrackMania\hornC5.wav');
        $this->assertSame($map->getDependencies()[6]->getUrl(), '');
        //comments
        $this->assertSame($map->getComments(), '');
        //Thumbnail
        $thumbnailImage = @imagecreatefromstring((string) $map->getThumbnail());
        $this->assertNotFalse($thumbnailImage, 'The thumbnail is not a valid jepg');
    }
}
