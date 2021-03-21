<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected static $migrated = false;

    protected function setUp(): void
    {
        parent::setUp();
        if (!self::$migrated) {
            $this->artisan('migrate:fresh');
            $this->artisan('passport:install');
            $this->artisan('db:seed');

            self::$migrated = true;
        }
        DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        DB::rollback();
        parent::tearDown();
    }
}
