<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Security;

use PhpOffice\PhpSpreadsheet\Reader;

class XmlScanner
{
<<<<<<< HEAD
=======
    private const ENCODING_PATTERN = '/encoding\\s*=\\s*(["\'])(.+?)\\1/s';
    private const ENCODING_UTF7 = '/encoding\\s*=\\s*(["\'])UTF-7\\1/si';

>>>>>>> main
    /**
     * String used to identify risky xml elements.
     *
     * @var string
     */
    private $pattern;

<<<<<<< HEAD
    private $callback;

=======
    /** @var ?callable */
    private $callback;

    /** @var ?bool */
>>>>>>> main
    private static $libxmlDisableEntityLoaderValue;

    /**
     * @var bool
     */
    private static $shutdownRegistered = false;

<<<<<<< HEAD
    public function __construct($pattern = '<!DOCTYPE')
=======
    public function __construct(string $pattern = '<!DOCTYPE')
>>>>>>> main
    {
        $this->pattern = $pattern;

        $this->disableEntityLoaderCheck();

        // A fatal error will bypass the destructor, so we register a shutdown here
        if (!self::$shutdownRegistered) {
            self::$shutdownRegistered = true;
            register_shutdown_function([__CLASS__, 'shutdown']);
        }
    }

<<<<<<< HEAD
    public static function getInstance(Reader\IReader $reader)
    {
        switch (true) {
            case $reader instanceof Reader\Html:
                return new self('<!ENTITY');
            case $reader instanceof Reader\Xlsx:
            case $reader instanceof Reader\Xml:
            case $reader instanceof Reader\Ods:
            case $reader instanceof Reader\Gnumeric:
                return new self('<!DOCTYPE');
            default:
                return new self('<!DOCTYPE');
        }
    }

    public static function threadSafeLibxmlDisableEntityLoaderAvailability()
    {
        if (PHP_MAJOR_VERSION == 7) {
=======
    public static function getInstance(Reader\IReader $reader): self
    {
        $pattern = ($reader instanceof Reader\Html) ? '<!ENTITY' : '<!DOCTYPE';

        return new self($pattern);
    }

    /**
     * @codeCoverageIgnore
     */
    public static function threadSafeLibxmlDisableEntityLoaderAvailability(): bool
    {
        if (PHP_MAJOR_VERSION === 7) {
>>>>>>> main
            switch (PHP_MINOR_VERSION) {
                case 2:
                    return PHP_RELEASE_VERSION >= 1;
                case 1:
                    return PHP_RELEASE_VERSION >= 13;
                case 0:
                    return PHP_RELEASE_VERSION >= 27;
            }

            return true;
        }

        return false;
    }

<<<<<<< HEAD
=======
    /**
     * @codeCoverageIgnore
     */
>>>>>>> main
    private function disableEntityLoaderCheck(): void
    {
        if (\PHP_VERSION_ID < 80000) {
            $libxmlDisableEntityLoaderValue = libxml_disable_entity_loader(true);

            if (self::$libxmlDisableEntityLoaderValue === null) {
                self::$libxmlDisableEntityLoaderValue = $libxmlDisableEntityLoaderValue;
            }
        }
    }

<<<<<<< HEAD
=======
    /**
     * @codeCoverageIgnore
     */
>>>>>>> main
    public static function shutdown(): void
    {
        if (self::$libxmlDisableEntityLoaderValue !== null && \PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader(self::$libxmlDisableEntityLoaderValue);
            self::$libxmlDisableEntityLoaderValue = null;
        }
    }

    public function __destruct()
    {
        self::shutdown();
    }

    public function setAdditionalCallback(callable $callback): void
    {
        $this->callback = $callback;
    }

<<<<<<< HEAD
    private function toUtf8($xml)
    {
        $pattern = '/encoding="(.*?)"/';
        $result = preg_match($pattern, $xml, $matches);
        $charset = strtoupper($result ? $matches[1] : 'UTF-8');

        if ($charset !== 'UTF-8') {
            $xml = mb_convert_encoding($xml, 'UTF-8', $charset);

            $result = preg_match($pattern, $xml, $matches);
            $charset = strtoupper($result ? $matches[1] : 'UTF-8');
            if ($charset !== 'UTF-8') {
                throw new Reader\Exception('Suspicious Double-encoded XML, spreadsheet file load() aborted to prevent XXE/XEE attacks');
            }
=======
    /** @param mixed $arg */
    private static function forceString($arg): string
    {
        return is_string($arg) ? $arg : '';
    }

    /**
     * @param string $xml
     *
     * @return string
     */
    private function toUtf8($xml)
    {
        $charset = $this->findCharSet($xml);
        $foundUtf7 = $charset === 'UTF-7';
        if ($charset !== 'UTF-8') {
            $testStart = '/^.{0,4}\\s*<?xml/s';
            $startWithXml1 = preg_match($testStart, $xml);
            $xml = self::forceString(mb_convert_encoding($xml, 'UTF-8', $charset));
            if ($startWithXml1 === 1 && preg_match($testStart, $xml) !== 1) {
                throw new Reader\Exception('Double encoding not permitted');
            }
            $foundUtf7 = $foundUtf7 || (preg_match(self::ENCODING_UTF7, $xml) === 1);
            $xml = preg_replace(self::ENCODING_PATTERN, '', $xml) ?? $xml;
        } else {
            $foundUtf7 = $foundUtf7 || (preg_match(self::ENCODING_UTF7, $xml) === 1);
        }
        if ($foundUtf7) {
            throw new Reader\Exception('UTF-7 encoding not permitted');
        }
        if (substr($xml, 0, Reader\Csv::UTF8_BOM_LEN) === Reader\Csv::UTF8_BOM) {
            $xml = substr($xml, Reader\Csv::UTF8_BOM_LEN);
>>>>>>> main
        }

        return $xml;
    }

<<<<<<< HEAD
    /**
     * Scan the XML for use of <!ENTITY to prevent XXE/XEE attacks.
     *
     * @param mixed $xml
=======
    private function findCharSet(string $xml): string
    {
        if (substr($xml, 0, 4) === "\x4c\x6f\xa7\x94") {
            throw new Reader\Exception('EBCDIC encoding not permitted');
        }
        $encoding = Reader\Csv::guessEncodingBom('', $xml);
        if ($encoding !== '') {
            return $encoding;
        }
        $xml = str_replace("\0", '', $xml);
        if (preg_match(self::ENCODING_PATTERN, $xml, $matches)) {
            return strtoupper($matches[2]);
        }

        return 'UTF-8';
    }

    /**
     * Scan the XML for use of <!ENTITY to prevent XXE/XEE attacks.
     *
     * @param false|string $xml
>>>>>>> main
     *
     * @return string
     */
    public function scan($xml)
    {
        $this->disableEntityLoaderCheck();
<<<<<<< HEAD

        $xml = $this->toUtf8($xml);

        // Don't rely purely on libxml_disable_entity_loader()
        $pattern = '/\\0?' . implode('\\0?', str_split($this->pattern)) . '\\0?/';

=======
        // Don't rely purely on libxml_disable_entity_loader()
        $pattern = '/\\0*' . implode('\\0*', /** @scrutinizer ignore-type */ str_split($this->pattern)) . '\\0*/';

        $xml = "$xml";
        if (preg_match($pattern, $xml)) {
            throw new Reader\Exception('Detected use of ENTITY in XML, spreadsheet file load() aborted to prevent XXE/XEE attacks');
        }

        $xml = $this->toUtf8($xml);

>>>>>>> main
        if (preg_match($pattern, $xml)) {
            throw new Reader\Exception('Detected use of ENTITY in XML, spreadsheet file load() aborted to prevent XXE/XEE attacks');
        }

<<<<<<< HEAD
        if ($this->callback !== null && is_callable($this->callback)) {
=======
        if ($this->callback !== null) {
>>>>>>> main
            $xml = call_user_func($this->callback, $xml);
        }

        return $xml;
    }

    /**
<<<<<<< HEAD
     * Scan theXML for use of <!ENTITY to prevent XXE/XEE attacks.
=======
     * Scan the XML for use of <!ENTITY to prevent XXE/XEE attacks.
>>>>>>> main
     *
     * @param string $filestream
     *
     * @return string
     */
    public function scanFile($filestream)
    {
        return $this->scan(file_get_contents($filestream));
    }
}
