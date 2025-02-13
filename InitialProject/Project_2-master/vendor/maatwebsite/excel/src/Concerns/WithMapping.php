<?php

namespace Maatwebsite\Excel\Concerns;

<<<<<<< HEAD
interface WithMapping
{
    /**
     * @param  mixed  $row
=======
/**
 * @template RowType of mixed
 */
interface WithMapping
{
    /**
     * @param  RowType  $row
>>>>>>> main
     * @return array
     */
    public function map($row): array;
}
