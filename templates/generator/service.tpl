<?php
declare(strict_types = 1);
namespace %namespace%\Service;

use App\Service\ApplicationService;
use Origin\Service\Result;

/**
 * @method Result dispatch()
 */
class %class%Service extends ApplicationService
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