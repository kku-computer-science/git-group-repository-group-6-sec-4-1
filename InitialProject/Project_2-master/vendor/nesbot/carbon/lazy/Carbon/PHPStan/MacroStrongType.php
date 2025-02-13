<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\PHPStan;

if (!class_exists(LazyMacro::class, false)) {
<<<<<<< HEAD
    abstract class LazyMacro extends AbstractMacro
=======
    abstract class LazyMacro extends AbstractReflectionMacro
>>>>>>> main
    {
        /**
         * {@inheritdoc}
         */
        public function getFileName(): ?string
        {
<<<<<<< HEAD
            return $this->reflectionFunction->getFileName();
=======
            $file = $this->reflectionFunction->getFileName();

            return (($file ? realpath($file) : null) ?: $file) ?: null;
>>>>>>> main
        }

        /**
         * {@inheritdoc}
         */
        public function getStartLine(): ?int
        {
            return $this->reflectionFunction->getStartLine();
        }

        /**
         * {@inheritdoc}
         */
        public function getEndLine(): ?int
        {
            return $this->reflectionFunction->getEndLine();
        }
    }
}
