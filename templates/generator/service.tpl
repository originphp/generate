<?php
declare(strict_types = 1);
namespace %namespace%\Service;

use Origin\Service\Service;
use Origin\Service\Result;

/**
 * @method Result dispatch()
 */
class %class% extends Service
{

    protected function initialize() : void
    {
    }

    protected function execute() : Result
    {
        return new Result([
            'data' => []
        ]);
    }
}