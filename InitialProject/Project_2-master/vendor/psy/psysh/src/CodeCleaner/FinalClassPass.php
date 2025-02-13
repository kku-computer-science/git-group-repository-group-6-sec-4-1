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
use PhpParser\Node\Stmt\Class_;
use Psy\Exception\FatalErrorException;

/**
 * The final class pass handles final classes.
 */
class FinalClassPass extends CodeCleanerPass
{
<<<<<<< HEAD
    private $finalClasses;

    /**
     * @param array $nodes
=======
    private array $finalClasses = [];

    /**
     * @param array $nodes
     *
     * @return Node[]|null Array of nodes
>>>>>>> main
     */
    public function beforeTraverse(array $nodes)
    {
        $this->finalClasses = [];
    }

    /**
     * @throws FatalErrorException if the node is a class that extends a final class
     *
     * @param Node $node
<<<<<<< HEAD
=======
     *
     * @return int|Node|null Replacement node (or special return value)
>>>>>>> main
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Class_) {
            if ($node->extends) {
                $extends = (string) $node->extends;
                if ($this->isFinalClass($extends)) {
                    $msg = \sprintf('Class %s may not inherit from final class (%s)', $node->name, $extends);
<<<<<<< HEAD
                    throw new FatalErrorException($msg, 0, \E_ERROR, null, $node->getLine());
=======
                    throw new FatalErrorException($msg, 0, \E_ERROR, null, $node->getStartLine());
>>>>>>> main
                }
            }

            if ($node->isFinal()) {
                $this->finalClasses[\strtolower($node->name)] = true;
            }
        }
    }

    /**
     * @param string $name Class name
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    private function isFinalClass(string $name): bool
    {
        if (!\class_exists($name)) {
            return isset($this->finalClasses[\strtolower($name)]);
        }

        $refl = new \ReflectionClass($name);

        return $refl->isFinal();
    }
}
