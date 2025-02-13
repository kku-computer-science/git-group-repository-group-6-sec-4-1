<?php

namespace Maatwebsite\Excel;

<<<<<<< HEAD
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\PendingDispatch;
=======
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\SyncJob;
>>>>>>> main
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ShouldQueueWithoutChain;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithProgressBar;
<<<<<<< HEAD
use Maatwebsite\Excel\Events\BeforeImport;
=======
>>>>>>> main
use Maatwebsite\Excel\Files\TemporaryFile;
use Maatwebsite\Excel\Imports\HeadingRowExtractor;
use Maatwebsite\Excel\Jobs\AfterImportJob;
use Maatwebsite\Excel\Jobs\QueueImport;
use Maatwebsite\Excel\Jobs\ReadChunk;
use Throwable;

class ChunkReader
{
    /**
<<<<<<< HEAD
     * @param  WithChunkReading  $import
     * @param  Reader  $reader
     * @param  TemporaryFile  $temporaryFile
     * @return \Illuminate\Foundation\Bus\PendingDispatch|null
     */
    public function read(WithChunkReading $import, Reader $reader, TemporaryFile $temporaryFile)
    {
        if ($import instanceof WithEvents && isset($import->registerEvents()[BeforeImport::class])) {
=======
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param  WithChunkReading  $import
     * @param  Reader  $reader
     * @param  TemporaryFile  $temporaryFile
     * @return PendingDispatch|Collection|null
     */
    public function read(WithChunkReading $import, Reader $reader, TemporaryFile $temporaryFile)
    {
        if ($import instanceof WithEvents) {
>>>>>>> main
            $reader->beforeImport($import);
        }

        $chunkSize    = $import->chunkSize();
        $totalRows    = $reader->getTotalRows();
        $worksheets   = $reader->getWorksheets($import);
        $queue        = property_exists($import, 'queue') ? $import->queue : null;
<<<<<<< HEAD
        $delayCleanup = property_exists($import, 'delayCleanup') ? $import->delayCleanup : 600;
=======
        $delayCleanup = property_exists($import, 'cleanupInterval') ? $import->cleanupInterval : 60;
>>>>>>> main

        if ($import instanceof WithProgressBar) {
            $import->getConsoleOutput()->progressStart(array_sum($totalRows));
        }

        $jobs = new Collection();
        foreach ($worksheets as $name => $sheetImport) {
            $startRow = HeadingRowExtractor::determineStartRow($sheetImport);

            if ($sheetImport instanceof WithLimit) {
                $limit = $sheetImport->limit();

                if ($limit <= $totalRows[$name]) {
                    $totalRows[$name] = $sheetImport->limit();
                }
            }

            for ($currentRow = $startRow; $currentRow <= $totalRows[$name]; $currentRow += $chunkSize) {
                $jobs->push(new ReadChunk(
                    $import,
                    $reader->getPhpSpreadsheetReader(),
                    $temporaryFile,
                    $name,
                    $sheetImport,
                    $currentRow,
                    $chunkSize
                ));
            }
        }

        $afterImportJob = new AfterImportJob($import, $reader);

        if ($import instanceof ShouldQueueWithoutChain) {
<<<<<<< HEAD
=======
            $afterImportJob->setInterval($delayCleanup);
            $afterImportJob->setDependencies($jobs);
>>>>>>> main
            $jobs->push($afterImportJob->delay($delayCleanup));

            return $jobs->each(function ($job) use ($queue) {
                dispatch($job->onQueue($queue));
            });
        }

        $jobs->push($afterImportJob);

        if ($import instanceof ShouldQueue) {
            return new PendingDispatch(
                (new QueueImport($import))->chain($jobs->toArray())
            );
        }

        $jobs->each(function ($job) {
            try {
<<<<<<< HEAD
                dispatch_now($job);
=======
                function_exists('dispatch_now')
                    ? dispatch_now($job)
                    : $this->dispatchNow($job);
>>>>>>> main
            } catch (Throwable $e) {
                if (method_exists($job, 'failed')) {
                    $job->failed($e);
                }
                throw $e;
            }
        });

        if ($import instanceof WithProgressBar) {
            $import->getConsoleOutput()->progressFinish();
        }

        unset($jobs);

        return null;
    }
<<<<<<< HEAD
=======

    /**
     * Dispatch a command to its appropriate handler in the current process without using the synchronous queue.
     *
     * @param  object  $command
     * @param  mixed  $handler
     * @return mixed
     */
    protected function dispatchNow($command, $handler = null)
    {
        $uses = class_uses_recursive($command);

        if (in_array(InteractsWithQueue::class, $uses) &&
            in_array(Queueable::class, $uses) && !$command->job
        ) {
            $command->setJob(new SyncJob($this->container, json_encode([]), 'sync', 'sync'));
        }

        $method = method_exists($command, 'handle') ? 'handle' : '__invoke';

        return $this->container->call([$command, $method]);
    }
>>>>>>> main
}
