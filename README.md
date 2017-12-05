# Architect

[![Latest Version](https://img.shields.io/badge/release-v1.0.2-blue.svg?style=flat-square)](https://github.com/bulwark1374/architect/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://travis-ci.org/bulwark1374/architect.svg?branch=master)](https://travis-ci.org/bulwark1374/architect)
[![Coverage Status](https://coveralls.io/repos/github/bulwark1374/architect/badge.svg?branch=master)](https://coveralls.io/github/bulwark1374/architect)
[![Total Downloads](https://img.shields.io/badge/downloads-1-red.svg?style=flat-square)](https://packagist.org/packages/bulwark/architect)

## Introduction

Architect is used for dynamically creating new structures for API resource relationships.
Sounds confusing and pretentious?

Imagine you have a resource `Book` with a related resource `Author`.

```
Book 1-----n Author
```

### Normal embedded mode

This is how related resources are loaded by default using embedded mode.

```json
{  
   "books":[  
      {  
         "id":1,
         "author_id":1,
         "title":"How to save the world from evil",
         "pages":100,
         "author":{  
            "id":1,
            "name":"Linus torvalds"
         }
      },
      {  
         "id":2,
         "author_id":2,
         "title":"How to take over the world",
         "pages":100,
         "author":{  
            "id":2,
            "name":"Richard stallman"
         }
      }
   ]
}
```

With Architect now you can load related resources using `ids` mode and
`sideloading` mode

### Ids mode

Only load the IDs of the related resource.

```json
{  
   "books":[  
      {  
         "id":1,
         "author_id":1,
         "title":"How to save the world from evil",
         "pages":100,
         "author":1
      },
      {  
         "id":2,
         "author_id":2,
         "title":"How to take over the world",
         "pages":100,
         "author":2
      }
   ]
}
```

### Sideloading mode

Hoist the related resources into the global scope and leave behind the IDs
using the ID mode resolver.

```json
{  
   "author":[  
      {  
         "id":1,
         "name":"Linus torvalds"
      },
      {  
         "id":2,
         "name":"Richard stallman"
      }
   ],
   "books":[  
      {  
         "id":1,
         "author_id":1,
         "title":"How to save the world from evil",
         "pages":100,
         "author":1
      },
      {  
         "id":2,
         "author_id":2,
         "title":"How to take over the world",
         "pages":100,
         "author":2
      }
   ]
}
```

## Usage

Architect works with normal array's (collections and resources), `Illuminate\Support\Collection`
and `Illuminate\Database\Eloquent\Model`.

```php
<?php

$books = Book::with('Author')->get();

$architect = new \Optimus\Architect\Architect;
$parsed = $architect->parseData($books, [
    'author' => 'sideload' // can also be embed or ids (embed is default)
], 'books');
```

[Bulwark\LaravelController](https://github.com/bulwark1374/dream) gives
nice convenience methods to define the Architect relationships in query parameters.

## Installation

```bash
composer require bulwark/architect ~1.0
```

## Standards

This package is compliant with [PSR-1], [PSR-2] and [PSR-4]. If you notice compliance oversights,
please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/bulwark1374/architect/blob/master/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](https://github.com/bulwark1374/architect/blob/master/LICENSE) for more information.
