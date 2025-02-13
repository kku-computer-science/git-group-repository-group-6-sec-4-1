<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;
<<<<<<< HEAD

abstract class ClassLike extends Node\Stmt
{
    /** @var Node\Identifier|null Name */
    public $name;
    /** @var Node\Stmt[] Statements */
    public $stmts;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public $attrGroups;

    /** @var Node\Name Namespaced name (if using NameResolver) */
    public $namespacedName;
=======
use PhpParser\Node\PropertyItem;

abstract class ClassLike extends Node\Stmt {
    /** @var Node\Identifier|null Name */
    public ?Node\Identifier $name;
    /** @var Node\Stmt[] Statements */
    public array $stmts;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public array $attrGroups;

    /** @var Node\Name|null Namespaced name (if using NameResolver) */
    public ?Node\Name $namespacedName;
>>>>>>> main

    /**
     * @return TraitUse[]
     */
<<<<<<< HEAD
    public function getTraitUses() : array {
=======
    public function getTraitUses(): array {
>>>>>>> main
        $traitUses = [];
        foreach ($this->stmts as $stmt) {
            if ($stmt instanceof TraitUse) {
                $traitUses[] = $stmt;
            }
        }
        return $traitUses;
    }

    /**
     * @return ClassConst[]
     */
<<<<<<< HEAD
    public function getConstants() : array {
=======
    public function getConstants(): array {
>>>>>>> main
        $constants = [];
        foreach ($this->stmts as $stmt) {
            if ($stmt instanceof ClassConst) {
                $constants[] = $stmt;
            }
        }
        return $constants;
    }

    /**
     * @return Property[]
     */
<<<<<<< HEAD
    public function getProperties() : array {
=======
    public function getProperties(): array {
>>>>>>> main
        $properties = [];
        foreach ($this->stmts as $stmt) {
            if ($stmt instanceof Property) {
                $properties[] = $stmt;
            }
        }
        return $properties;
    }

    /**
     * Gets property with the given name defined directly in this class/interface/trait.
     *
     * @param string $name Name of the property
     *
     * @return Property|null Property node or null if the property does not exist
     */
<<<<<<< HEAD
    public function getProperty(string $name) {
        foreach ($this->stmts as $stmt) {
            if ($stmt instanceof Property) {
                foreach ($stmt->props as $prop) {
                    if ($prop instanceof PropertyProperty && $name === $prop->name->toString()) {
=======
    public function getProperty(string $name): ?Property {
        foreach ($this->stmts as $stmt) {
            if ($stmt instanceof Property) {
                foreach ($stmt->props as $prop) {
                    if ($prop instanceof PropertyItem && $name === $prop->name->toString()) {
>>>>>>> main
                        return $stmt;
                    }
                }
            }
        }
        return null;
    }

    /**
     * Gets all methods defined directly in this class/interface/trait
     *
     * @return ClassMethod[]
     */
<<<<<<< HEAD
    public function getMethods() : array {
=======
    public function getMethods(): array {
>>>>>>> main
        $methods = [];
        foreach ($this->stmts as $stmt) {
            if ($stmt instanceof ClassMethod) {
                $methods[] = $stmt;
            }
        }
        return $methods;
    }

    /**
     * Gets method with the given name defined directly in this class/interface/trait.
     *
     * @param string $name Name of the method (compared case-insensitively)
     *
     * @return ClassMethod|null Method node or null if the method does not exist
     */
<<<<<<< HEAD
    public function getMethod(string $name) {
=======
    public function getMethod(string $name): ?ClassMethod {
>>>>>>> main
        $lowerName = strtolower($name);
        foreach ($this->stmts as $stmt) {
            if ($stmt instanceof ClassMethod && $lowerName === $stmt->name->toLowerString()) {
                return $stmt;
            }
        }
        return null;
    }
}
