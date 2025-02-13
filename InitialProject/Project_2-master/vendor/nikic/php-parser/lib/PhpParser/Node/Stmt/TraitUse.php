<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class TraitUse extends Node\Stmt
{
    /** @var Node\Name[] Traits */
    public $traits;
    /** @var TraitUseAdaptation[] Adaptations */
    public $adaptations;
=======
class TraitUse extends Node\Stmt {
    /** @var Node\Name[] Traits */
    public array $traits;
    /** @var TraitUseAdaptation[] Adaptations */
    public array $adaptations;
>>>>>>> main

    /**
     * Constructs a trait use node.
     *
<<<<<<< HEAD
     * @param Node\Name[]          $traits      Traits
     * @param TraitUseAdaptation[] $adaptations Adaptations
     * @param array                $attributes  Additional attributes
=======
     * @param Node\Name[] $traits Traits
     * @param TraitUseAdaptation[] $adaptations Adaptations
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $traits, array $adaptations = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->traits = $traits;
        $this->adaptations = $adaptations;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['traits', 'adaptations'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['traits', 'adaptations'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_TraitUse';
    }
}
