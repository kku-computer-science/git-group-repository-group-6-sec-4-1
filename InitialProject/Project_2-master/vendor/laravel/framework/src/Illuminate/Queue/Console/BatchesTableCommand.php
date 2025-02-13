<?php

namespace Illuminate\Queue\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;

class BatchesTableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:batches-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration for the batches database table';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
<<<<<<< HEAD
     * Create a new failed queue jobs table command instance.
=======
     * Create a new batched queue jobs table command instance.
>>>>>>> main
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $table = $this->laravel['config']['queue.batching.table'] ?? 'job_batches';

        $this->replaceMigration(
            $this->createBaseMigration($table), $table, Str::studly($table)
        );

        $this->info('Migration created successfully!');

        $this->composer->dumpAutoloads();
    }

    /**
     * Create a base migration file for the table.
     *
     * @param  string  $table
     * @return string
     */
<<<<<<< HEAD
    protected function createBaseMigration($table = 'failed_jobs')
=======
    protected function createBaseMigration($table = 'job_batches')
>>>>>>> main
    {
        return $this->laravel['migration.creator']->create(
            'create_'.$table.'_table', $this->laravel->databasePath().'/migrations'
        );
    }

    /**
<<<<<<< HEAD
     * Replace the generated migration with the failed job table stub.
=======
     * Replace the generated migration with the batches job table stub.
>>>>>>> main
     *
     * @param  string  $path
     * @param  string  $table
     * @param  string  $tableClassName
     * @return void
     */
    protected function replaceMigration($path, $table, $tableClassName)
    {
        $stub = str_replace(
            ['{{table}}', '{{tableClassName}}'],
            [$table, $tableClassName],
            $this->files->get(__DIR__.'/stubs/batches.stub')
        );

        $this->files->put($path, $stub);
    }
}
