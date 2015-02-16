# Manialib\Gbx

Manialib\Gbx is a PHP package manipulating gbx metadata files 

## Beta

This is a work in progress. As long as we don't release a stable version, we might break stuff at any point. If this is a problem, feel free to open an issue and we'll try to help.

## Features

- Expose a Map.Gbx file metadata through object interface
- Extract thumbnail from a Map.Gbx file


## Requirements

- PHP 5.5+
- ext-gd

## Installation

[Install via Composer](https://getcomposer.org/):

```json
{
	"require": {
        "manialib/gbx": "dev-master"
    }
}
```

## Usage

You can get map's information from a map

```php
use Manialib\Gbx\Map;

$content = file_get_contents('/path/to/my/map.map.gbx');
$map = Map::loadString($content);
// or
$map = Map::loadFile('/path/to/my/map.map.gbx');

//save the map thumbnail
$map->getThumbnail()->saveJpg('/path/to/my/thumbnail.jpg');

//get map author
$author = $map->getHeader()->getIdent()->getAuthor();
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
