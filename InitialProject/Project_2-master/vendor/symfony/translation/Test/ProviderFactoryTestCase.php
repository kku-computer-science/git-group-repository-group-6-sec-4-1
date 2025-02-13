<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Test;

<<<<<<< HEAD
=======
use PHPUnit\Framework\MockObject\MockObject;
>>>>>>> main
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\Translation\Dumper\XliffFileDumper;
use Symfony\Component\Translation\Exception\IncompleteDsnException;
use Symfony\Component\Translation\Exception\UnsupportedSchemeException;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\Provider\Dsn;
use Symfony\Component\Translation\Provider\ProviderFactoryInterface;
<<<<<<< HEAD
=======
use Symfony\Component\Translation\TranslatorBagInterface;
>>>>>>> main
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * A test case to ease testing a translation provider factory.
 *
 * @author Mathieu Santostefano <msantostefano@protonmail.com>
<<<<<<< HEAD
 *
 * @internal
 */
abstract class ProviderFactoryTestCase extends TestCase
{
    protected $client;
    protected $logger;
    protected $defaultLocale;
    protected $loader;
    protected $xliffFileDumper;
=======
 */
abstract class ProviderFactoryTestCase extends TestCase
{
    protected HttpClientInterface $client;
    protected LoggerInterface|MockObject $logger;
    protected string $defaultLocale;
    protected LoaderInterface|MockObject $loader;
    protected XliffFileDumper|MockObject $xliffFileDumper;
    protected TranslatorBagInterface|MockObject $translatorBag;
>>>>>>> main

    abstract public function createFactory(): ProviderFactoryInterface;

    /**
     * @return iterable<array{0: bool, 1: string}>
     */
<<<<<<< HEAD
    abstract public function supportsProvider(): iterable;

    /**
     * @return iterable<array{0: string, 1: string, 2: TransportInterface}>
     */
    abstract public function createProvider(): iterable;
=======
    abstract public static function supportsProvider(): iterable;

    /**
     * @return iterable<array{0: string, 1: string}>
     */
    abstract public static function createProvider(): iterable;
>>>>>>> main

    /**
     * @return iterable<array{0: string, 1: string|null}>
     */
<<<<<<< HEAD
    public function unsupportedSchemeProvider(): iterable
=======
    public static function unsupportedSchemeProvider(): iterable
>>>>>>> main
    {
        return [];
    }

    /**
     * @return iterable<array{0: string, 1: string|null}>
     */
<<<<<<< HEAD
    public function incompleteDsnProvider(): iterable
=======
    public static function incompleteDsnProvider(): iterable
>>>>>>> main
    {
        return [];
    }

    /**
     * @dataProvider supportsProvider
     */
    public function testSupports(bool $expected, string $dsn)
    {
        $factory = $this->createFactory();

        $this->assertSame($expected, $factory->supports(new Dsn($dsn)));
    }

    /**
     * @dataProvider createProvider
     */
    public function testCreate(string $expected, string $dsn)
    {
        $factory = $this->createFactory();
        $provider = $factory->create(new Dsn($dsn));

        $this->assertSame($expected, (string) $provider);
    }

    /**
     * @dataProvider unsupportedSchemeProvider
     */
<<<<<<< HEAD
    public function testUnsupportedSchemeException(string $dsn, string $message = null)
=======
    public function testUnsupportedSchemeException(string $dsn, ?string $message = null)
>>>>>>> main
    {
        $factory = $this->createFactory();

        $dsn = new Dsn($dsn);

        $this->expectException(UnsupportedSchemeException::class);
        if (null !== $message) {
            $this->expectExceptionMessage($message);
        }

        $factory->create($dsn);
    }

    /**
     * @dataProvider incompleteDsnProvider
     */
<<<<<<< HEAD
    public function testIncompleteDsnException(string $dsn, string $message = null)
=======
    public function testIncompleteDsnException(string $dsn, ?string $message = null)
>>>>>>> main
    {
        $factory = $this->createFactory();

        $dsn = new Dsn($dsn);

        $this->expectException(IncompleteDsnException::class);
        if (null !== $message) {
            $this->expectExceptionMessage($message);
        }

        $factory->create($dsn);
    }

    protected function getClient(): HttpClientInterface
    {
<<<<<<< HEAD
        return $this->client ?? $this->client = new MockHttpClient();
=======
        return $this->client ??= new MockHttpClient();
>>>>>>> main
    }

    protected function getLogger(): LoggerInterface
    {
<<<<<<< HEAD
        return $this->logger ?? $this->logger = $this->createMock(LoggerInterface::class);
=======
        return $this->logger ??= $this->createMock(LoggerInterface::class);
>>>>>>> main
    }

    protected function getDefaultLocale(): string
    {
<<<<<<< HEAD
        return $this->defaultLocale ?? $this->defaultLocale = 'en';
=======
        return $this->defaultLocale ??= 'en';
>>>>>>> main
    }

    protected function getLoader(): LoaderInterface
    {
<<<<<<< HEAD
        return $this->loader ?? $this->loader = $this->createMock(LoaderInterface::class);
=======
        return $this->loader ??= $this->createMock(LoaderInterface::class);
>>>>>>> main
    }

    protected function getXliffFileDumper(): XliffFileDumper
    {
<<<<<<< HEAD
        return $this->xliffFileDumper ?? $this->xliffFileDumper = $this->createMock(XliffFileDumper::class);
=======
        return $this->xliffFileDumper ??= $this->createMock(XliffFileDumper::class);
    }

    protected function getTranslatorBag(): TranslatorBagInterface
    {
        return $this->translatorBag ??= $this->createMock(TranslatorBagInterface::class);
>>>>>>> main
    }
}
