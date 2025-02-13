<?php

namespace Maatwebsite\Excel\Concerns;

use Illuminate\Console\OutputStyle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Maatwebsite\Excel\Exceptions\NoFilePathGivenException;
use Maatwebsite\Excel\Importer;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait Importable
{
    /**
     * @var OutputStyle|null
     */
    protected $output;

    /**
     * @param  string|UploadedFile|null  $filePath
     * @param  string|null  $disk
     * @param  string|null  $readerType
     * @return Importer|PendingDispatch
     *
     * @throws NoFilePathGivenException
     */
<<<<<<< HEAD
    public function import($filePath = null, string $disk = null, string $readerType = null)
=======
    public function import($filePath = null, ?string $disk = null, ?string $readerType = null)
>>>>>>> main
    {
        $filePath = $this->getFilePath($filePath);

        return $this->getImporter()->import(
            $this,
            $filePath,
            $disk ?? $this->disk ?? null,
            $readerType ?? $this->readerType ?? null
        );
    }

    /**
     * @param  string|UploadedFile|null  $filePath
     * @param  string|null  $disk
     * @param  string|null  $readerType
     * @return array
     *
     * @throws NoFilePathGivenException
     */
<<<<<<< HEAD
    public function toArray($filePath = null, string $disk = null, string $readerType = null): array
=======
    public function toArray($filePath = null, ?string $disk = null, ?string $readerType = null): array
>>>>>>> main
    {
        $filePath = $this->getFilePath($filePath);

        return $this->getImporter()->toArray(
            $this,
            $filePath,
            $disk ?? $this->disk ?? null,
            $readerType ?? $this->readerType ?? null
        );
    }

    /**
     * @param  string|UploadedFile|null  $filePath
     * @param  string|null  $disk
     * @param  string|null  $readerType
     * @return Collection
     *
     * @throws NoFilePathGivenException
     */
<<<<<<< HEAD
    public function toCollection($filePath = null, string $disk = null, string $readerType = null): Collection
=======
    public function toCollection($filePath = null, ?string $disk = null, ?string $readerType = null): Collection
>>>>>>> main
    {
        $filePath = $this->getFilePath($filePath);

        return $this->getImporter()->toCollection(
            $this,
            $filePath,
            $disk ?? $this->disk ?? null,
            $readerType ?? $this->readerType ?? null
        );
    }

    /**
     * @param  string|UploadedFile|null  $filePath
     * @param  string|null  $disk
     * @param  string|null  $readerType
     * @return PendingDispatch
     *
     * @throws NoFilePathGivenException
     * @throws InvalidArgumentException
     */
<<<<<<< HEAD
    public function queue($filePath = null, string $disk = null, string $readerType = null)
=======
    public function queue($filePath = null, ?string $disk = null, ?string $readerType = null)
>>>>>>> main
    {
        if (!$this instanceof ShouldQueue) {
            throw new InvalidArgumentException('Importable should implement ShouldQueue to be queued.');
        }

        return $this->import($filePath, $disk, $readerType);
    }

    /**
     * @param  OutputStyle  $output
     * @return $this
     */
    public function withOutput(OutputStyle $output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * @return OutputStyle
     */
    public function getConsoleOutput(): OutputStyle
    {
        if (!$this->output instanceof OutputStyle) {
            $this->output = new OutputStyle(new StringInput(''), new NullOutput());
        }

        return $this->output;
    }

    /**
     * @param  UploadedFile|string|null  $filePath
     * @return UploadedFile|string
     *
     * @throws NoFilePathGivenException
     */
    private function getFilePath($filePath = null)
    {
        $filePath = $filePath ?? $this->filePath ?? null;

        if (null === $filePath) {
            throw NoFilePathGivenException::import();
        }

        return $filePath;
    }

    /**
     * @return Importer
     */
    private function getImporter(): Importer
    {
        return app(Importer::class);
    }
}
