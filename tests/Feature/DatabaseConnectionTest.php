<?php

use Illuminate\Support\Facades\DB;

test('ensures that the tests are using the in-memory SQLite database.', function () {
    $driverName = DB::connection()->getDriverName();

    $databaseName = DB::connection()->getDatabaseName();

    expect($driverName)->toBe('sqlite')
        ->and($databaseName)->toBe(':memory:');
});
