<?php declare(strict_types=1);

namespace PhpParser\Node\Name;

<<<<<<< HEAD
class Relative extends \PhpParser\Node\Name
{
=======
class Relative extends \PhpParser\Node\Name {
>>>>>>> main
    /**
     * Checks whether the name is unqualified. (E.g. Name)
     *
     * @return bool Whether the name is unqualified
     */
<<<<<<< HEAD
    public function isUnqualified() : bool {
=======
    public function isUnqualified(): bool {
>>>>>>> main
        return false;
    }

    /**
     * Checks whether the name is qualified. (E.g. Name\Name)
     *
     * @return bool Whether the name is qualified
     */
<<<<<<< HEAD
    public function isQualified() : bool {
=======
    public function isQualified(): bool {
>>>>>>> main
        return false;
    }

    /**
     * Checks whether the name is fully qualified. (E.g. \Name)
     *
     * @return bool Whether the name is fully qualified
     */
<<<<<<< HEAD
    public function isFullyQualified() : bool {
=======
    public function isFullyQualified(): bool {
>>>>>>> main
        return false;
    }

    /**
     * Checks whether the name is explicitly relative to the current namespace. (E.g. namespace\Name)
     *
     * @return bool Whether the name is relative
     */
<<<<<<< HEAD
    public function isRelative() : bool {
        return true;
    }

    public function toCodeString() : string {
        return 'namespace\\' . $this->toString();
    }
    
    public function getType() : string {
=======
    public function isRelative(): bool {
        return true;
    }

    public function toCodeString(): string {
        return 'namespace\\' . $this->toString();
    }

    public function getType(): string {
>>>>>>> main
        return 'Name_Relative';
    }
}
