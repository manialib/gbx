# Manialib\Gbx

[![Packagist Version](https://img.shields.io/packagist/v/manialib/gbx.svg?style=flat-square)](https://packagist.org/packages/manialib/gbx)
[![Total Downloads](https://img.shields.io/packagist/dt/manialib/gbx.svg?style=flat-square)](https://packagist.org/packages/manialib/gbx)
[![Build Status](https://img.shields.io/travis/manialib/gbx.svg?style=flat-square)](https://travis-ci.org/manialib/gbx)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/f3cc9ab7-224a-4fb7-b571-ac057ca22898.svg?style=flat-square)](https://insight.sensiolabs.com/projects/f3cc9ab7-224a-4fb7-b571-ac057ca22898)

Manialib\Gbx is a PHP package for reading Gbx file metadata

## Features

- **Map.Gbx:** Access metadata with a simple object interface
- **Map.Gbx:** Extract JPG thumbnail

## Beta

- **This is a work in progress.** 
- We might break stuff at any point.
- If you need a stable version, feel free to ask us.
- If you need a new feature, feel free to ask us.
- Discuss it with us: https://forum.maniaplanet.com/viewtopic.php?f=40&t=30424

## Requirements

- PHP 5.5+
- PHP GD extension

## Install

[Install via Composer](https://getcomposer.org/)

```json
{
	"require": {
        "manialib/gbx": "4.0.0-beta1"
    }
}
```

## Usage

```php
use Manialib\Gbx\Map;

$map = Map::loadFile('/path/to/my/map.map.gbx');

//save the map thumbnail
$map->getThumbnail()->saveJpg('/path/to/my/thumbnail.jpg');

//get map author
$author = $map->getAuthor();
```

## Development guidelines

We follow best practices from the amazing PHP ecosystem. Warm kudos to [Symfony](http://symfony.com/), [The PHP League](http://thephpleague.com/), [the PHP subreddit](http://www.reddit.com/r/PHP/) and many more for inspiration and challenging ideas.

- We adhere to the best-practices put forward by [PHP The Right Way](http://www.phptherightway.com/)
- We comply to the standards of the [PHP-FIG](http://www.php-fig.org/)
- We distribute code via [Packagist](https://packagist.org/) and [Composer](https://getcomposer.org/)
- We manage version numbers with [Semantic Versioning](http://semver.org/)
- We [keep a changelog](http://keepachangelog.com/)
- We use `Manialib\` as our PHP vendor namespace
- We use `manialib/` as our Packagist vendor namespace
- We'll (try to) make documentation & tests :)
