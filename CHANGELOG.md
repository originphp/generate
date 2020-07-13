# Changelog

## [3.2.0] - 2020-07-13

### Changed

- Changed dependency to framework, as I have decided to hold back on decoupling until the current subtree split process can be ensured to be 100% reliable.

## [3.1.0] - 2020-07-13

### Added 

- Added Fixture generator

## [3.0.1] - 2020-07-09

### Fixed

- Fixed bootstrap path 
- Fixed incorrect db driver in travis settings

## [3.0.0] - 2020-07-08

### Changed

- Changed OriginPHP framework minimum version 3
- Changed PHP minimum version 7.3
- Changed PHPUnit minimum version 9.2

## [2.0.0] - 2020-07-01

- skipping this version to bring in line with framework version number

### Removed
- Removed docblock property tags for components from scaffolding as this is in ApplicationController

## [1.1.1] - 2020-01-28
### Fixed 
- Fixed scaffolding templates not echoing variable

### Changed
- Changed travis.yml - Changed PHP 7.4 version and removed Removed Codecov.io

## [1.1.0] - 2019-11-28
### Fixed
- Fixed Migration version numbering to use 24 hour time

### Added
- Added Mailbox generator

## [1.0.1] - 2019-11-06

### Fixed
- concern_controller test generator (namespace)
- middleware test generator (namespace)
- model test generator (doc property comment)

## [1.0.0] - 2019-10-16

This component has been decoupled from the [OriginPHP framework](https://www.originphp.com/).