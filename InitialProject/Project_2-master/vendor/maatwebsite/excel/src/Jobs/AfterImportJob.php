<?php

namespace Maatwebsite\Excel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
<<<<<<< HEAD
=======
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
>>>>>>> main
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\ImportFailed;
use Maatwebsite\Excel\HasEventBus;
use Maatwebsite\Excel\Reader;
use Throwable;

class AfterImportJob implements ShouldQueue
{
<<<<<<< HEAD
    use Queueable, HasEventBus;
=======
    use HasEventBus, InteractsWithQueue, Queueable;
>>>>>>> main

    /**
     * @var WithEvents
     */
    private $import;

    /**
     * @var Reader
     */
    private $reader;

    /**
<<<<<<< HEAD
=======
     * @var iterable
     */
    private $dependencyIds = [];

    private $interval = 60;

    /**
>>>>>>> main
     * @param  object  $import
     * @param  Reader  $reader
     */
    public function __construct($import, Reader $reader)
    {
        $this->import = $import;
        $this->reader = $reader;
    }

<<<<<<< HEAD
    public function handle()
    {
=======
    public function setInterval(int $interval)
    {
        $this->interval = $interval;
    }

    public function setDependencies(Collection $jobs)
    {
        $this->dependencyIds = $jobs->map(function (ReadChunk $job) {
            return $job->getUniqueId();
        })->all();
    }

    public function handle()
    {
        foreach ($this->dependencyIds as $id) {
            if (!ReadChunk::isComplete($id)) {
                // Until there is no jobs left to run we put this job back into the queue every minute
                // Note: this will do nothing in a SyncQueue but that's desired, because in a SyncQueue jobs run in order
                $this->release($this->interval);

                return;
            }
        }

>>>>>>> main
        if ($this->import instanceof ShouldQueue && $this->import instanceof WithEvents) {
            $this->reader->clearListeners();
            $this->reader->registerListeners($this->import->registerEvents());
        }

        $this->reader->afterImport($this->import);
    }

    /**
     * @param  Throwable  $e
     */
    public function failed(Throwable $e)
    {
        if ($this->import instanceof WithEvents) {
            $this->registerListeners($this->import->registerEvents());
            $this->raise(new ImportFailed($e));

            if (method_exists($this->import, 'failed')) {
                $this->import->failed($e);
            }
        }
    }
}
