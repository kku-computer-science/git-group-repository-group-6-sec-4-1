<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace League\CommonMark\Extension\FrontMatter\Exception;

<<<<<<< HEAD
class InvalidFrontMatterException extends \RuntimeException
=======
use League\CommonMark\Exception\CommonMarkException;

class InvalidFrontMatterException extends \RuntimeException implements CommonMarkException
>>>>>>> main
{
    public static function wrap(\Throwable $t): self
    {
        return new InvalidFrontMatterException('Failed to parse front matter: ' . $t->getMessage(), 0, $t);
    }
}
