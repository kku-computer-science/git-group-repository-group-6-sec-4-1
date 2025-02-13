<?php declare(strict_types=1);

namespace PhpParser\Lexer\TokenEmulator;

<<<<<<< HEAD
/**
 * Reverses emulation direction of the inner emulator.
 */
final class ReverseEmulator extends TokenEmulator
{
    /** @var TokenEmulator Inner emulator */
    private $emulator;
=======
use PhpParser\PhpVersion;

/**
 * Reverses emulation direction of the inner emulator.
 */
final class ReverseEmulator extends TokenEmulator {
    /** @var TokenEmulator Inner emulator */
    private TokenEmulator $emulator;
>>>>>>> main

    public function __construct(TokenEmulator $emulator) {
        $this->emulator = $emulator;
    }

<<<<<<< HEAD
    public function getPhpVersion(): string {
=======
    public function getPhpVersion(): PhpVersion {
>>>>>>> main
        return $this->emulator->getPhpVersion();
    }

    public function isEmulationNeeded(string $code): bool {
        return $this->emulator->isEmulationNeeded($code);
    }

    public function emulate(string $code, array $tokens): array {
        return $this->emulator->reverseEmulate($code, $tokens);
    }

    public function reverseEmulate(string $code, array $tokens): array {
        return $this->emulator->emulate($code, $tokens);
    }

    public function preprocessCode(string $code, array &$patches): string {
        return $code;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> main
