<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2022 Justin Hileman
=======
 * (c) 2012-2023 Justin Hileman
>>>>>>> main
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\CodeCleaner;

use PhpParser\Node;
use PhpParser\Node\Expr\Exit_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name\FullyQualified as FullyQualifiedName;
use Psy\Exception\BreakException;

class ExitPass extends CodeCleanerPass
{
    /**
     * Converts exit calls to BreakExceptions.
     *
     * @param \PhpParser\Node $node
<<<<<<< HEAD
=======
     *
     * @return int|Node|Node[]|null Replacement node (or special return value)
>>>>>>> main
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Exit_) {
            return new StaticCall(new FullyQualifiedName(BreakException::class), 'exitShell');
        }
    }
}
