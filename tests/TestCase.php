<?php

namespace MeiTuan\Tests;

use MeiTuan\Application;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function getApplicationInstance()
    {
        $config = [
            'app_id' => 'foo',
            'app_secret' => 'bar',
        ];

        return new Application($config);
    }
}
