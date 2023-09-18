<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudTestMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud-test {name}';

    protected $description = 'Make a test file with default empty methods to test CRUD functionality';

    public function handle(): void
    {
        $name = $this->argument('name');
        $stubPath = base_path('stubs/crud-test.stub');
        $testPath = base_path("tests/Feature/{$name}Test.php");

        if (!file_exists($stubPath)) {
            $this->error('Custom stub not found.');
        }

        // TODO make sure the test file doesn't already exist
        // TODO see if Laravel file helpers can be used
        // TODO write a test for the command

        $stubContent = file_get_contents($stubPath);
        $customStub = str_replace('{{ class }}', $name . "Test", $stubContent);
        file_put_contents($testPath, $customStub);

        $this->info("Custom test file {$name}Test.php generated successfully.");
    }
}
