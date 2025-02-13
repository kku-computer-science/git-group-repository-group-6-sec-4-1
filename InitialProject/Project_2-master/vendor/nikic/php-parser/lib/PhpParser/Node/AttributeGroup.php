<?php declare(strict_types=1);

namespace PhpParser\Node;

<<<<<<< HEAD
use PhpParser\Node;
use PhpParser\NodeAbstract;

class AttributeGroup extends NodeAbstract
{
    /** @var Attribute[] Attributes */
    public $attrs;

    /**
     * @param Attribute[] $attrs PHP attributes
     * @param array $attributes Additional node attributes
=======
use PhpParser\NodeAbstract;

class AttributeGroup extends NodeAbstract {
    /** @var Attribute[] Attributes */
    public array $attrs;

    /**
     * @param Attribute[] $attrs PHP attributes
     * @param array<string, mixed> $attributes Additional node attributes
>>>>>>> main
     */
    public function __construct(array $attrs, array $attributes = []) {
        $this->attributes = $attributes;
        $this->attrs = $attrs;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['attrs'];
    }

    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['attrs'];
    }

    public function getType(): string {
>>>>>>> main
        return 'AttributeGroup';
    }
}
