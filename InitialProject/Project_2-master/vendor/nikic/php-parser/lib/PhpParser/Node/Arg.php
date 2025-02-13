<?php declare(strict_types=1);

namespace PhpParser\Node;

<<<<<<< HEAD
use PhpParser\Node\VariadicPlaceholder;
use PhpParser\NodeAbstract;

class Arg extends NodeAbstract
{
    /** @var Identifier|null Parameter name (for named parameters) */
    public $name;
    /** @var Expr Value to pass */
    public $value;
    /** @var bool Whether to pass by ref */
    public $byRef;
    /** @var bool Whether to unpack the argument */
    public $unpack;
=======
use PhpParser\NodeAbstract;

class Arg extends NodeAbstract {
    /** @var Identifier|null Parameter name (for named parameters) */
    public ?Identifier $name;
    /** @var Expr Value to pass */
    public Expr $value;
    /** @var bool Whether to pass by ref */
    public bool $byRef;
    /** @var bool Whether to unpack the argument */
    public bool $unpack;
>>>>>>> main

    /**
     * Constructs a function call argument node.
     *
<<<<<<< HEAD
     * @param Expr  $value      Value to pass
     * @param bool  $byRef      Whether to pass by ref
     * @param bool  $unpack     Whether to unpack the argument
     * @param array $attributes Additional attributes
=======
     * @param Expr $value Value to pass
     * @param bool $byRef Whether to pass by ref
     * @param bool $unpack Whether to unpack the argument
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     * @param Identifier|null $name Parameter name (for named parameters)
     */
    public function __construct(
        Expr $value, bool $byRef = false, bool $unpack = false, array $attributes = [],
<<<<<<< HEAD
        Identifier $name = null
=======
        ?Identifier $name = null
>>>>>>> main
    ) {
        $this->attributes = $attributes;
        $this->name = $name;
        $this->value = $value;
        $this->byRef = $byRef;
        $this->unpack = $unpack;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['name', 'value', 'byRef', 'unpack'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['name', 'value', 'byRef', 'unpack'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Arg';
    }
}
