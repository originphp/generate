{
    "name": "your-name/%underscored%",
    "description": "%namespace% plugin for OriginPHP",
    "type": "origin-plugin",
    "license": "MIT",
    "require": {
        "originphp/framework": "^3.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^9.2"
    },
    "autoload": {
        "psr-4": {
            "%namespace%\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "%namespace%\\Test\\": "tests/"
        }
    }
}