<?php

namespace Maatwebsite\Excel\Files;

use Illuminate\Support\Str;

class TemporaryFileFactory
{
    /**
     * @var string|null
     */
    private $temporaryPath;

    /**
     * @var string|null
     */
    private $temporaryDisk;

    /**
     * @param  string|null  $temporaryPath
     * @param  string|null  $temporaryDisk
     */
<<<<<<< HEAD
    public function __construct(string $temporaryPath = null, string $temporaryDisk = null)
=======
    public function __construct(?string $temporaryPath = null, ?string $temporaryDisk = null)
>>>>>>> main
    {
        $this->temporaryPath = $temporaryPath;
        $this->temporaryDisk = $temporaryDisk;
    }

    /**
     * @param  string|null  $fileExtension
     * @return TemporaryFile
     */
<<<<<<< HEAD
    public function make(string $fileExtension = null): TemporaryFile
=======
    public function make(?string $fileExtension = null): TemporaryFile
>>>>>>> main
    {
        if (null !== $this->temporaryDisk) {
            return $this->makeRemote($fileExtension);
        }

        return $this->makeLocal(null, $fileExtension);
    }

    /**
     * @param  string|null  $fileName
     * @param  string|null  $fileExtension
     * @return LocalTemporaryFile
     */
<<<<<<< HEAD
    public function makeLocal(string $fileName = null, string $fileExtension = null): LocalTemporaryFile
    {
        if (!file_exists($this->temporaryPath) && !mkdir($concurrentDirectory = $this->temporaryPath) && !is_dir($concurrentDirectory)) {
=======
    public function makeLocal(?string $fileName = null, ?string $fileExtension = null): LocalTemporaryFile
    {
        if (!file_exists($this->temporaryPath) && !mkdir($concurrentDirectory = $this->temporaryPath, config('excel.temporary_files.local_permissions.dir', 0777), true) && !is_dir($concurrentDirectory)) {
>>>>>>> main
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }

        return new LocalTemporaryFile(
            $this->temporaryPath . DIRECTORY_SEPARATOR . ($fileName ?: $this->generateFilename($fileExtension))
        );
    }

    /**
     * @param  string|null  $fileExtension
     * @return RemoteTemporaryFile
     */
<<<<<<< HEAD
    private function makeRemote(string $fileExtension = null): RemoteTemporaryFile
=======
    private function makeRemote(?string $fileExtension = null): RemoteTemporaryFile
>>>>>>> main
    {
        $filename = $this->generateFilename($fileExtension);

        return new RemoteTemporaryFile(
            $this->temporaryDisk,
            config('excel.temporary_files.remote_prefix') . $filename,
            $this->makeLocal($filename)
        );
    }

    /**
     * @param  string|null  $fileExtension
     * @return string
     */
<<<<<<< HEAD
    private function generateFilename(string $fileExtension = null): string
=======
    private function generateFilename(?string $fileExtension = null): string
>>>>>>> main
    {
        return 'laravel-excel-' . Str::random(32) . ($fileExtension ? '.' . $fileExtension : '');
    }
}
