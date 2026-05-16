# Frootbox HTTP

General-purpose HTTP helpers for Frootbox projects.

The package provides small wrappers around request data, simple response and
stream objects, and a URL sanitizing trait. It targets PHP 8.2 and newer.

## Installation

```bash
composer require frootbox/http
```

## Request Data

`Get`, `Post`, and `Patch` extend `AbstractHttpData` and expose the same access
helpers for HTTP payloads.

```php
use Frootbox\Http\Post;

$post = new Post();

$title = $post->get('Title');
$countryId = $post->getIntWithDefault('CountryId');
$isActive = $post->getBoolean('Active');
```

String values returned by `get()` are trimmed. Missing attributes return `null`.

### Defaults and Nested Values

```php
$post = new Post([
    'Title' => ' Example ',
    'Address' => [
        'City' => 'Amsterdam',
    ],
]);

$title = $post->getWithDefault('Title', 'Untitled');
$city = $post->getPath('Address.City');
```

`getPath()` resolves dot-separated paths and returns `null` when any segment is
missing.

### Required Input

```php
$post->require(['Title', 'Address.City']);
$post->requireOne(['Email', 'Phone']);
```

Both methods return the current instance when validation succeeds and throw
`Frootbox\Exceptions\InputMissing` when the required input is not present.

`validate()` is deprecated and delegates to `require()`.

## Query Data

`Get` reads from `$_GET` and can be adjusted in tests or small scripts:

```php
use Frootbox\Http\Get;

$get = new Get();
$get->set('page', 2);
```

## Post Data

`Post` reads from `$_POST` by default. Pass an array to work with explicit data:

```php
use Frootbox\Http\Post;

$post = new Post([
    'CountryId' => '5',
]);
```

## Patch Data

`Patch` parses `php://input` with `parse_str()` and exposes the parsed values via
the same `AbstractHttpData` helpers.

## Responses

`Response` is a lightweight response object for building headers, status and a
body before flushing them to PHP output.

```php
use Frootbox\Http\Response;

$response = (new Response())
    ->withStatus(201)
    ->setHeader('Content-Type', 'application/json');

$response->setBody(json_encode(['ok' => true]));
$response->flush();
```

## URL Sanitizing

Use `UrlSanitize` to build URL-safe slugs from labels:

```php
use Frootbox\Http\Traits\UrlSanitize;

final class Slugger
{
    use UrlSanitize;
}

$slug = (new Slugger())->getStringUrlSanitized('Äpfel & Öl');
// aepfel-und-oel
```

German is used as the default language for ampersand replacement. Dutch can be
selected with `nl-NL`.

## Tests

```bash
composer install
vendor/bin/phpunit
```

Some PSR-7 related tests are currently marked as skipped because the
corresponding methods are placeholders.

## License

GPL-3.0-or-later
