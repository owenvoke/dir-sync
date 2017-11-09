# DirSync

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Style CI][ico-styleci]][link-styleci]
[![Code Coverage][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A folder list sync between Server and Client (originally designed for use with a Plex environment)

## Structure

```
public/
src/
tests/
vendor/
```

## Install

Via Composer

``` bash
$ composer create-project pxgamer/dir-sync
```

## Usage

Add the following environment variables, or set up a `.env` file by copying the `.env.example`.

Clone the package to your server and client locations, and set a web server to point at either the `public/server` or `public/client` directories.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email owzie123@gmail.com instead of using the issue tracker.

## Credits

- [pxgamer][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/pxgamer/dir-sync.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/pxgamer/dir-sync/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/68293954/shield
[ico-code-quality]: https://img.shields.io/codecov/c/github/pxgamer/dir-sync.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pxgamer/dir-sync.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pxgamer/dir-sync
[link-travis]: https://travis-ci.org/pxgamer/dir-sync
[link-styleci]: https://styleci.io/repos/68293954
[link-code-quality]: https://codecov.io/gh/pxgamer/dir-sync
[link-downloads]: https://packagist.org/packages/pxgamer/dir-sync
[link-author]: https://github.com/pxgamer
[link-contributors]: ../../contributors
