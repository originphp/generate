<?php
/**
 * OriginPHP Framework
 * Copyright 2018 - 2021 Jamiel Sharief.
 *
 * Licensed under The MIT License
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * @copyright   Copyright (c) Jamiel Sharief
 * @link        https://www.originphp.com
 * @license     https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Generate\Test\Fixture;

use Origin\TestSuite\Fixture;

class BookmarksTagFixture extends Fixture
{
    protected $schema = [
        'columns' => [
            'bookmark_id' => ['type' => 'integer'],
            'tag_id' => ['type' => 'integer'],
        ],
        'constraints' => [
            'primary' => ['type' => 'primary','column' => ['bookmark_id','tag_id']],
        ],
    ];
}
