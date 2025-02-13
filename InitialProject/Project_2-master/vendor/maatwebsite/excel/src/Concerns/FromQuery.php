<?php

namespace Maatwebsite\Excel\Concerns;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
<<<<<<< HEAD
=======
use Laravel\Scout\Builder as ScoutBuilder;
>>>>>>> main

interface FromQuery
{
    /**
<<<<<<< HEAD
     * @return Builder|EloquentBuilder|Relation
=======
     * @return Builder|EloquentBuilder|Relation|ScoutBuilder
>>>>>>> main
     */
    public function query();
}
