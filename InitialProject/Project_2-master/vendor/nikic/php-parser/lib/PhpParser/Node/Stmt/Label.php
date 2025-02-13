<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt;

<<<<<<< HEAD
class Label extends Stmt
{
    /** @var Identifier Name */
    public $name;
=======
class Label extends Stmt {
    /** @var Identifier Name */
    public Identifier $name;
>>>>>>> main

    /**
     * Constructs a label node.
     *
<<<<<<< HEAD
     * @param string|Identifier $name       Name
     * @param array             $attributes Additional attributes
=======
     * @param string|Identifier $name Name
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct($name, array $attributes = []) {
        $this->attributes = $attributes;
        $this->name = \is_string($name) ? new Identifier($name) : $name;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['name'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['name'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Label';
    }
}
