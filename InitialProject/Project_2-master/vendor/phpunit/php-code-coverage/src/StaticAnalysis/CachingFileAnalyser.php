<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage\StaticAnalysis;

<<<<<<< HEAD
use function assert;
use function crc32;
use function file_get_contents;
use function file_put_contents;
use function is_file;
use function serialize;
use GlobIterator;
use SebastianBergmann\CodeCoverage\Util\Filesystem;
use SplFileInfo;
=======
use function file_get_contents;
use function file_put_contents;
use function implode;
use function is_file;
use function md5;
use function serialize;
use function unserialize;
use SebastianBergmann\CodeCoverage\Util\Filesystem;
use SebastianBergmann\FileIterator\Facade as FileIteratorFacade;
>>>>>>> main

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class CachingFileAnalyser implements FileAnalyser
{
    /**
     * @var ?string
     */
    private static $cacheVersion;

    /**
<<<<<<< HEAD
=======
     * @var string
     */
    private $directory;

    /**
>>>>>>> main
     * @var FileAnalyser
     */
    private $analyser;

    /**
<<<<<<< HEAD
=======
     * @var bool
     */
    private $useAnnotationsForIgnoringCode;

    /**
     * @var bool
     */
    private $ignoreDeprecatedCode;

    /**
>>>>>>> main
     * @var array
     */
    private $cache = [];

<<<<<<< HEAD
    /**
     * @var string
     */
    private $directory;

    public function __construct(string $directory, FileAnalyser $analyser)
    {
        Filesystem::createDirectory($directory);

        $this->analyser  = $analyser;
        $this->directory = $directory;

        if (self::$cacheVersion === null) {
            $this->calculateCacheVersion();
        }
=======
    public function __construct(string $directory, FileAnalyser $analyser, bool $useAnnotationsForIgnoringCode, bool $ignoreDeprecatedCode)
    {
        Filesystem::createDirectory($directory);

        $this->analyser                      = $analyser;
        $this->directory                     = $directory;
        $this->useAnnotationsForIgnoringCode = $useAnnotationsForIgnoringCode;
        $this->ignoreDeprecatedCode          = $ignoreDeprecatedCode;
>>>>>>> main
    }

    public function classesIn(string $filename): array
    {
        if (!isset($this->cache[$filename])) {
            $this->process($filename);
        }

        return $this->cache[$filename]['classesIn'];
    }

    public function traitsIn(string $filename): array
    {
        if (!isset($this->cache[$filename])) {
            $this->process($filename);
        }

        return $this->cache[$filename]['traitsIn'];
    }

    public function functionsIn(string $filename): array
    {
        if (!isset($this->cache[$filename])) {
            $this->process($filename);
        }

        return $this->cache[$filename]['functionsIn'];
    }

    /**
     * @psalm-return array{linesOfCode: int, commentLinesOfCode: int, nonCommentLinesOfCode: int}
     */
    public function linesOfCodeFor(string $filename): array
    {
        if (!isset($this->cache[$filename])) {
            $this->process($filename);
        }

        return $this->cache[$filename]['linesOfCodeFor'];
    }

    public function executableLinesIn(string $filename): array
    {
        if (!isset($this->cache[$filename])) {
            $this->process($filename);
        }

        return $this->cache[$filename]['executableLinesIn'];
    }

    public function ignoredLinesFor(string $filename): array
    {
        if (!isset($this->cache[$filename])) {
            $this->process($filename);
        }

        return $this->cache[$filename]['ignoredLinesFor'];
    }

    public function process(string $filename): void
    {
        $cache = $this->read($filename);

        if ($cache !== false) {
            $this->cache[$filename] = $cache;

            return;
        }

        $this->cache[$filename] = [
            'classesIn'         => $this->analyser->classesIn($filename),
            'traitsIn'          => $this->analyser->traitsIn($filename),
            'functionsIn'       => $this->analyser->functionsIn($filename),
            'linesOfCodeFor'    => $this->analyser->linesOfCodeFor($filename),
            'ignoredLinesFor'   => $this->analyser->ignoredLinesFor($filename),
            'executableLinesIn' => $this->analyser->executableLinesIn($filename),
        ];

        $this->write($filename, $this->cache[$filename]);
    }

    /**
     * @return mixed
     */
    private function read(string $filename)
    {
        $cacheFile = $this->cacheFile($filename);

        if (!is_file($cacheFile)) {
            return false;
        }

        return unserialize(
            file_get_contents($cacheFile),
            ['allowed_classes' => false]
        );
    }

    /**
     * @param mixed $data
     */
    private function write(string $filename, $data): void
    {
        file_put_contents(
            $this->cacheFile($filename),
            serialize($data)
        );
    }

    private function cacheFile(string $filename): string
    {
<<<<<<< HEAD
        return $this->directory . DIRECTORY_SEPARATOR . hash('sha256', $filename . crc32(file_get_contents($filename)) . self::$cacheVersion);
    }

    private function calculateCacheVersion(): void
    {
        $buffer = '';

        foreach (new GlobIterator(__DIR__ . '/*.php') as $file) {
            assert($file instanceof SplFileInfo);

            $buffer .= file_get_contents($file->getPathname());
        }

        self::$cacheVersion = (string) crc32($buffer);
=======
        $cacheKey = md5(
            implode(
                "\0",
                [
                    $filename,
                    file_get_contents($filename),
                    self::cacheVersion(),
                    $this->useAnnotationsForIgnoringCode,
                    $this->ignoreDeprecatedCode,
                ]
            )
        );

        return $this->directory . DIRECTORY_SEPARATOR . $cacheKey;
    }

    private static function cacheVersion(): string
    {
        if (self::$cacheVersion !== null) {
            return self::$cacheVersion;
        }

        $buffer = [];

        foreach ((new FileIteratorFacade)->getFilesAsArray(__DIR__, '.php') as $file) {
            $buffer[] = $file;
            $buffer[] = file_get_contents($file);
        }

        self::$cacheVersion = md5(implode("\0", $buffer));

        return self::$cacheVersion;
>>>>>>> main
    }
}
