# Generate

![license](https://img.shields.io/badge/license-MIT-brightGreen.svg)
[![build](https://travis-ci.org/originphp/generate.svg?branch=master)](https://travis-ci.org/originphp/generate)
[![coverage](https://coveralls.io/repos/github/originphp/generate/badge.svg?branch=master)](https://coveralls.io/github/originphp/generate?branch=master)

This is the code generation plugin for the OriginPHP framework.

## Installation

To install this package

```linux
$ composer require originphp/generate
```

## Generators

To run the interactive generator

```
$ bin/console generate
  concern_controller   Generates a Concern for a Controller
  concern_model        Generates a Concern for a Model
  command              Generates a Command class
  component            Generates a Component class
  controller           Generates a Controller class
  entity               Generates an Entity class
  exception            Generates an Exception class
  helper               Generates a Helper class
  job                  Generates a Job class
  listener             Generates a Listener class
  mailer               Generates a Mailer class
  model                Generates a Model class
  middleware           Generates a Middleware class
  migration            Generates a Migration class
  plugin               Generates a Plugin skeleton
  query                Generates a Query Object class
  repository           Generates a Repository for a Model
  scaffold             Generates a MVC using the database
  service              Generates a Service Object class

Which generator?
> 

  ```


To generate a class
```linux
$ bin/console generate controller Users
```

To generate a class in a Plugin folder

```linux
$ bin/console generate controller MyPlugin.Users
```

For more information see [Code Generation Guide](https://www.originphp.com/docs/development/code-generation/).