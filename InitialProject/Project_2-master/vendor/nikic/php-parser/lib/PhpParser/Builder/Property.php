<?php declare(strict_types=1);

namespace PhpParser\Builder;

use PhpParser;
use PhpParser\BuilderHelpers;
<<<<<<< HEAD
=======
use PhpParser\Modifiers;
>>>>>>> main
use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\Node\ComplexType;

<<<<<<< HEAD
class Property implements PhpParser\Builder
{
    protected $name;

    protected $flags = 0;
    protected $default = null;
    protected $attributes = [];

    /** @var null|Identifier|Name|NullableType */
    protected $type;

    /** @var Node\AttributeGroup[] */
    protected $attributeGroups = [];
=======
class Property implements PhpParser\Builder {
    protected string $name;

    protected int $flags = 0;

    protected ?Node\Expr $default = null;
    /** @var array<string, mixed> */
    protected array $attributes = [];
    /** @var null|Identifier|Name|ComplexType */
    protected ?Node $type = null;
    /** @var list<Node\AttributeGroup> */
    protected array $attributeGroups = [];
    /** @var list<Node\PropertyHook> */
    protected array $hooks = [];
>>>>>>> main

    /**
     * Creates a property builder.
     *
     * @param string $name Name of the property
     */
    public function __construct(string $name) {
        $this->name = $name;
    }

    /**
     * Makes the property public.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makePublic() {
<<<<<<< HEAD
        $this->flags = BuilderHelpers::addModifier($this->flags, Stmt\Class_::MODIFIER_PUBLIC);
=======
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::PUBLIC);
>>>>>>> main

        return $this;
    }

    /**
     * Makes the property protected.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeProtected() {
<<<<<<< HEAD
        $this->flags = BuilderHelpers::addModifier($this->flags, Stmt\Class_::MODIFIER_PROTECTED);
=======
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::PROTECTED);
>>>>>>> main

        return $this;
    }

    /**
     * Makes the property private.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makePrivate() {
<<<<<<< HEAD
        $this->flags = BuilderHelpers::addModifier($this->flags, Stmt\Class_::MODIFIER_PRIVATE);
=======
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::PRIVATE);
>>>>>>> main

        return $this;
    }

    /**
     * Makes the property static.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeStatic() {
<<<<<<< HEAD
        $this->flags = BuilderHelpers::addModifier($this->flags, Stmt\Class_::MODIFIER_STATIC);
=======
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::STATIC);
>>>>>>> main

        return $this;
    }

    /**
     * Makes the property readonly.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeReadonly() {
<<<<<<< HEAD
        $this->flags = BuilderHelpers::addModifier($this->flags, Stmt\Class_::MODIFIER_READONLY);
=======
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::READONLY);

        return $this;
    }

    /**
     * Makes the property abstract. Requires at least one property hook to be specified as well.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeAbstract() {
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::ABSTRACT);

        return $this;
    }

    /**
     * Makes the property final.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeFinal() {
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::FINAL);

        return $this;
    }

    /**
     * Gives the property private(set) visibility.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makePrivateSet() {
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::PRIVATE_SET);

        return $this;
    }

    /**
     * Gives the property protected(set) visibility.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeProtectedSet() {
        $this->flags = BuilderHelpers::addModifier($this->flags, Modifiers::PROTECTED_SET);
>>>>>>> main

        return $this;
    }

    /**
     * Sets default value for the property.
     *
     * @param mixed $value Default value to use
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setDefault($value) {
        $this->default = BuilderHelpers::normalizeValue($value);

        return $this;
    }

    /**
     * Sets doc comment for the property.
     *
     * @param PhpParser\Comment\Doc|string $docComment Doc comment to set
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setDocComment($docComment) {
        $this->attributes = [
            'comments' => [BuilderHelpers::normalizeDocComment($docComment)]
        ];

        return $this;
    }

    /**
     * Sets the property type for PHP 7.4+.
     *
     * @param string|Name|Identifier|ComplexType $type
     *
     * @return $this
     */
    public function setType($type) {
        $this->type = BuilderHelpers::normalizeType($type);

        return $this;
    }

    /**
     * Adds an attribute group.
     *
     * @param Node\Attribute|Node\AttributeGroup $attribute
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addAttribute($attribute) {
        $this->attributeGroups[] = BuilderHelpers::normalizeAttribute($attribute);

        return $this;
    }

    /**
<<<<<<< HEAD
=======
     * Adds a property hook.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addHook(Node\PropertyHook $hook) {
        $this->hooks[] = $hook;

        return $this;
    }

    /**
>>>>>>> main
     * Returns the built class node.
     *
     * @return Stmt\Property The built property node
     */
<<<<<<< HEAD
    public function getNode() : PhpParser\Node {
        return new Stmt\Property(
            $this->flags !== 0 ? $this->flags : Stmt\Class_::MODIFIER_PUBLIC,
            [
                new Stmt\PropertyProperty($this->name, $this->default)
            ],
            $this->attributes,
            $this->type,
            $this->attributeGroups
=======
    public function getNode(): PhpParser\Node {
        if ($this->flags & Modifiers::ABSTRACT && !$this->hooks) {
            throw new PhpParser\Error('Only hooked properties may be declared abstract');
        }

        return new Stmt\Property(
            $this->flags !== 0 ? $this->flags : Modifiers::PUBLIC,
            [
                new Node\PropertyItem($this->name, $this->default)
            ],
            $this->attributes,
            $this->type,
            $this->attributeGroups,
            $this->hooks
>>>>>>> main
        );
    }
}
