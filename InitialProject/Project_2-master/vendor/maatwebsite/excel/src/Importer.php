<?php

namespace Maatwebsite\Excel;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

interface Importer
{
    /**
     * @param  object  $import
     * @param  string|\Symfony\Component\HttpFoundation\File\UploadedFile  $filePath
     * @param  string|null  $disk
     * @param  string|null  $readerType
     * @return Reader|\Illuminate\Foundation\Bus\PendingDispatch
     */
<<<<<<< HEAD
    public function import($import, $filePath, string $disk = null, string $readerType = null);
=======
    public function import($import, $filePath, ?string $disk = null, ?string $readerType = null);
>>>>>>> main

    /**
     * @param  object  $import
     * @param  string|\Symfony\Component\HttpFoundation\File\UploadedFile  $filePath
     * @param  string|null  $disk
     * @param  string|null  $readerType
     * @return array
     */
<<<<<<< HEAD
    public function toArray($import, $filePath, string $disk = null, string $readerType = null): array;
=======
    public function toArray($import, $filePath, ?string $disk = null, ?string $readerType = null): array;
>>>>>>> main

    /**
     * @param  object  $import
     * @param  string|\Symfony\Component\HttpFoundation\File\UploadedFile  $filePath
     * @param  string|null  $disk
     * @param  string|null  $readerType
     * @return Collection
     */
<<<<<<< HEAD
    public function toCollection($import, $filePath, string $disk = null, string $readerType = null): Collection;
=======
    public function toCollection($import, $filePath, ?string $disk = null, ?string $readerType = null): Collection;
>>>>>>> main

    /**
     * @param  ShouldQueue  $import
     * @param  string|\Symfony\Component\HttpFoundation\File\UploadedFile  $filePath
     * @param  string|null  $disk
     * @param  string  $readerType
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
<<<<<<< HEAD
    public function queueImport(ShouldQueue $import, $filePath, string $disk = null, string $readerType = null);
=======
    public function queueImport(ShouldQueue $import, $filePath, ?string $disk = null, ?string $readerType = null);
>>>>>>> main
}
