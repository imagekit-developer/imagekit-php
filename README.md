# Image Kit PHP API library

The Image Kit PHP library provides convenient access to the Image Kit REST API from any PHP 8.1.0+ application.

## Documentation

The REST API documentation can be found on [imagekit.io](https://imagekit.io/docs/api-reference).

## Installation

<!-- x-release-please-start-version -->

```
composer require "imagekit/imagekit 0.0.1"
```

<!-- x-release-please-end -->

## Usage

This library uses named parameters to specify optional arguments.
Parameters with a default value must be set by name.

```php
<?php

use ImageKit\Client;
use ImageKit\Core\FileParam;

$client = new Client(
  privateKey: getenv('IMAGEKIT_PRIVATE_KEY') ?: 'My Private Key',
  password: getenv('OPTIONAL_IMAGEKIT_IGNORES_THIS') ?: 'do_not_set',
);

$response = $client->files->upload(
  file: FileParam::fromString('https://www.example.com/public-url.jpg', filename: uniqid('file-upload-', true)),
  fileName: 'file-name.jpg',
);

var_dump($response->videoCodec);
```

### Value Objects

It is recommended to use the static `with` constructor `Dog::with(name: "Joey")`
and named parameters to initialize value objects.

However, builders are also provided `(new Dog)->withName("Joey")`.

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `ImageKit\Core\Exceptions\APIException` will be thrown:

```php
<?php

use ImageKit\Core\FileParam;
use ImageKit\Core\Exceptions\APIConnectionException;
use ImageKit\Core\Exceptions\RateLimitException;
use ImageKit\Core\Exceptions\APIStatusException;

try {
  $response = $client->files->upload(
    file: FileParam::fromString('https://www.example.com/public-url.jpg', filename: uniqid('file-upload-', true)),
    fileName: 'file-name.jpg',
  );
} catch (APIConnectionException $e) {
  echo "The server could not be reached", PHP_EOL;
  var_dump($e->getPrevious());
} catch (RateLimitException $e) {
  echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusException $e) {
  echo "Another non-200-range status code was received", PHP_EOL;
  echo $e->getMessage();
}
```

Error codes are as follows:

| Cause            | Error Type                     |
| ---------------- | ------------------------------ |
| HTTP 400         | `BadRequestException`          |
| HTTP 401         | `AuthenticationException`      |
| HTTP 403         | `PermissionDeniedException`    |
| HTTP 404         | `NotFoundException`            |
| HTTP 409         | `ConflictException`            |
| HTTP 422         | `UnprocessableEntityException` |
| HTTP 429         | `RateLimitException`           |
| HTTP >= 500      | `InternalServerException`      |
| Other HTTP error | `APIStatusException`           |
| Timeout          | `APITimeoutException`          |
| Network error    | `APIConnectionException`       |

### Retries

Certain errors will be automatically retried 2 times by default, with a short exponential backoff.

Connection errors (for example, due to a network connectivity problem), 408 Request Timeout, 409 Conflict, 429 Rate Limit, >=500 Internal errors, and timeouts will all be retried by default.

You can use the `maxRetries` option to configure or disable this:

```php
<?php

use ImageKit\Client;
use ImageKit\Core\FileParam;

// Configure the default for all requests:
$client = new Client(requestOptions: ['maxRetries' => 0]);

// Or, configure per-request:
$result = $client->files->upload(
  file: FileParam::fromString('https://www.example.com/public-url.jpg', filename: uniqid('file-upload-', true)),
  fileName: 'file-name.jpg',
  requestOptions: ['maxRetries' => 5],
);
```

### File uploads

Request parameters that correspond to file uploads can be passed as a resource returned by `fopen()`, a string of file contents, or a `FileParam` instance.

```php
<?php

use ImageKit\Core\FileParam;

// Pass a string with filename and content type:
$contents = file_get_contents('/path/to/file');
// Pass a string with filename and content type:
$response = $client->files->upload(
  file: FileParam::fromString($contents, filename: '/path/to/file', contentType: '…'),
);

// Pass in only a string (where applicable)
$response = $client->files->upload(file: '…');

// Pass an open resource:
$fd = fopen('/path/to/file', 'r');
try {
  $response = $client->files->upload(
    file: FileParam::fromResource($fd, filename: '/path/to/file', contentType: '…'),
  );
} finally {
  fclose($fd);
}
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Note: the `extra*` parameters of the same name overrides the documented parameters.

```php
<?php

use ImageKit\Core\FileParam;

$response = $client->files->upload(
  file: FileParam::fromString('https://www.example.com/public-url.jpg', filename: uniqid('file-upload-', true)),
  fileName: 'file-name.jpg',
  requestOptions: [
    'extraQueryParams' => ['my_query_parameter' => 'value'],
    'extraBodyParams' => ['my_body_parameter' => 'value'],
    'extraHeaders' => ['my-header' => 'value'],
  ],
);
```

#### Undocumented request params

If you want to explicitly send an extra param, you can do so with the `extra_query`, `extra_body`, and `extra_headers` under the `request_options:` parameter when making a request, as seen in the examples above.

#### Undocumented endpoints

To make requests to undocumented endpoints while retaining the benefit of auth, retries, and so on, you can make requests using `client.request`, like so:

```php
<?php

$response = $client->request(
  method: "post",
  path: '/undocumented/endpoint',
  query: ['dog' => 'woof'],
  headers: ['useful-header' => 'interesting-value'],
  body: ['hello' => 'world']
);
```

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

This package considers improvements to the (non-runtime) PHPDoc type definitions to be non-breaking changes.

## Requirements

PHP 8.1.0 or higher.

## Contributing

See [the contributing documentation](https://github.com/imagekit-developer/imagekit-php/tree/master/CONTRIBUTING.md).
