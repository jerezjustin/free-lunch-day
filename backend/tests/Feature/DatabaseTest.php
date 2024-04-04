<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    public static function migrationProvider(): array
    {
        return [
            'ingredients table' => ['ingredients'],
            'recipes table' => ['recipes'],
            'orders table' => ['orders'],
            'purchases table' => ['purchases'],
        ];
    }

    #[DataProvider('migrationProvider')]
    public function test_it_has_migration(string $table): void
    {
        $this->assertTrue(Schema::hasTable($table));
    }
}
