<?php

namespace Maatwebsite\Excel\Jobs;

use Illuminate\Bus\Queueable;

trait ExtendedQueueable
{
    use Queueable {
        chain as originalChain;
    }

    /**
<<<<<<< HEAD
     * @param $chain
=======
     * @param  $chain
>>>>>>> main
     * @return $this
     */
    public function chain($chain)
    {
        collect($chain)->each(function ($job) {
<<<<<<< HEAD
            $serialized = method_exists($this, 'serializeJob') ? $this->serializeJob($job) : serialize($job);
=======
            $serialized      = method_exists($this, 'serializeJob') ? $this->serializeJob($job) : serialize($job);
>>>>>>> main
            $this->chained[] = $serialized;
        });

        return $this;
    }
}
