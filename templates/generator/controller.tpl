<?php
declare(strict_types = 1);
namespace %namespace%\Http\Controller;

/**
 * @property \%namespace%\Model\%model% $%model%
 */
class %class%Controller extends ApplicationController
{
    protected function initialize(): void
    {
        parent::initialize();
    }

%methods%
}