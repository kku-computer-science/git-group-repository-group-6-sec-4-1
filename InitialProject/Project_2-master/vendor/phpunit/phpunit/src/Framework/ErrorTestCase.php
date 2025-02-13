<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ErrorTestCase extends TestCase
{
    /**
<<<<<<< HEAD
     * @var bool
=======
     * @var ?bool
>>>>>>> main
     */
    protected $backupGlobals = false;

    /**
<<<<<<< HEAD
     * @var bool
=======
     * @var ?bool
>>>>>>> main
     */
    protected $backupStaticAttributes = false;

    /**
<<<<<<< HEAD
     * @var bool
=======
     * @var ?bool
>>>>>>> main
     */
    protected $runTestInSeparateProcess = false;

    /**
     * @var string
     */
    private $message;

    public function __construct(string $message = '')
    {
        $this->message = $message;

        parent::__construct('Error');
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Returns a string representation of the test case.
     */
    public function toString(): string
    {
        return 'Error';
    }

    /**
     * @throws Exception
     *
     * @psalm-return never-return
     */
    protected function runTest(): void
    {
        throw new Error($this->message);
    }
}
