<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Trait_ extends ClassLike
{
=======
class Trait_ extends ClassLike {
>>>>>>> main
    /**
     * Constructs a trait node.
     *
     * @param string|Node\Identifier $name Name
<<<<<<< HEAD
     * @param array  $subNodes   Array of the following optional subnodes:
     *                           'stmts'      => array(): Statements
     *                           'attrGroups' => array(): PHP attribute groups
     * @param array  $attributes Additional attributes
=======
     * @param array{
     *     stmts?: Node\Stmt[],
     *     attrGroups?: Node\AttributeGroup[],
     * } $subNodes Array of the following optional subnodes:
     *             'stmts'      => array(): Statements
     *             'attrGroups' => array(): PHP attribute groups
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct($name, array $subNodes = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->name = \is_string($name) ? new Node\Identifier($name) : $name;
        $this->stmts = $subNodes['stmts'] ?? [];
        $this->attrGroups = $subNodes['attrGroups'] ?? [];
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['attrGroups', 'name', 'stmts'];
    }

    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['attrGroups', 'name', 'stmts'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Trait';
    }
}
