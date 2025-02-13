<?php declare(strict_types=1);

namespace PhpParser\Node;

<<<<<<< HEAD
class NullableType extends ComplexType
{
    /** @var Identifier|Name Type */
    public $type;
=======
use PhpParser\Node;

class NullableType extends ComplexType {
    /** @var Identifier|Name Type */
    public Node $type;
>>>>>>> main

    /**
     * Constructs a nullable type (wrapping another type).
     *
<<<<<<< HEAD
     * @param string|Identifier|Name $type       Type
     * @param array                  $attributes Additional attributes
     */
    public function __construct($type, array $attributes = []) {
        $this->attributes = $attributes;
        $this->type = \is_string($type) ? new Identifier($type) : $type;
    }

    public function getSubNodeNames() : array {
        return ['type'];
    }
    
    public function getType() : string {
=======
     * @param Identifier|Name $type Type
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Node $type, array $attributes = []) {
        $this->attributes = $attributes;
        $this->type = $type;
    }

    public function getSubNodeNames(): array {
        return ['type'];
    }

    public function getType(): string {
>>>>>>> main
        return 'NullableType';
    }
}
