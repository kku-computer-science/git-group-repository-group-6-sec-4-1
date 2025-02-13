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
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified as FullyQualifiedName;
use PhpParser\Node\Stmt\Namespace_;

/**
 * Abstract namespace-aware code cleaner pass.
 */
abstract class NamespaceAwarePass extends CodeCleanerPass
{
<<<<<<< HEAD
    protected $namespace;
    protected $currentScope;
=======
    protected array $namespace = [];
    protected array $currentScope = [];
>>>>>>> main

    /**
     * @todo should this be final? Extending classes should be sure to either
     * use afterTraverse or call parent::beforeTraverse() when overloading.
     *
     * Reset the namespace and the current scope before beginning analysis
<<<<<<< HEAD
=======
     *
     * @return Node[]|null Array of nodes
>>>>>>> main
     */
    public function beforeTraverse(array $nodes)
    {
        $this->namespace = [];
        $this->currentScope = [];
    }

    /**
     * @todo should this be final? Extending classes should be sure to either use
     * leaveNode or call parent::enterNode() when overloading
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
        if ($node instanceof Namespace_) {
<<<<<<< HEAD
            $this->namespace = isset($node->name) ? $node->name->parts : [];
=======
            $this->namespace = isset($node->name) ? $this->getParts($node->name) : [];
>>>>>>> main
        }
    }

    /**
     * Get a fully-qualified name (class, function, interface, etc).
     *
     * @param mixed $name
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> main
     */
    protected function getFullyQualifiedName($name): string
    {
        if ($name instanceof FullyQualifiedName) {
<<<<<<< HEAD
            return \implode('\\', $name->parts);
        } elseif ($name instanceof Name) {
            $name = $name->parts;
=======
            return \implode('\\', $this->getParts($name));
        }

        if ($name instanceof Name) {
            $name = $this->getParts($name);
>>>>>>> main
        } elseif (!\is_array($name)) {
            $name = [$name];
        }

        return \implode('\\', \array_merge($this->namespace, $name));
    }
<<<<<<< HEAD
=======

    /**
     * Backwards compatibility shim for PHP-Parser 4.x.
     *
     * At some point we might want to make $namespace a plain string, to match how Name works?
     */
    protected function getParts(Name $name): array
    {
        return \method_exists($name, 'getParts') ? $name->getParts() : $name->parts;
    }
>>>>>>> main
}
