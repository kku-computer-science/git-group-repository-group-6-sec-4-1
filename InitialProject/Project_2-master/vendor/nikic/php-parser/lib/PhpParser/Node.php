<?php declare(strict_types=1);

namespace PhpParser;

<<<<<<< HEAD
interface Node
{
    /**
     * Gets the type of the node.
     *
     * @return string Type of the node
     */
    public function getType() : string;
=======
interface Node {
    /**
     * Gets the type of the node.
     *
     * @psalm-return non-empty-string
     * @return string Type of the node
     */
    public function getType(): string;
>>>>>>> main

    /**
     * Gets the names of the sub nodes.
     *
<<<<<<< HEAD
     * @return array Names of sub nodes
     */
    public function getSubNodeNames() : array;
=======
     * @return string[] Names of sub nodes
     */
    public function getSubNodeNames(): array;
>>>>>>> main

    /**
     * Gets line the node started in (alias of getStartLine).
     *
     * @return int Start line (or -1 if not available)
<<<<<<< HEAD
     */
    public function getLine() : int;
=======
     * @phpstan-return -1|positive-int
     *
     * @deprecated Use getStartLine() instead
     */
    public function getLine(): int;
>>>>>>> main

    /**
     * Gets line the node started in.
     *
     * Requires the 'startLine' attribute to be enabled in the lexer (enabled by default).
     *
     * @return int Start line (or -1 if not available)
<<<<<<< HEAD
     */
    public function getStartLine() : int;
=======
     * @phpstan-return -1|positive-int
     */
    public function getStartLine(): int;
>>>>>>> main

    /**
     * Gets the line the node ended in.
     *
     * Requires the 'endLine' attribute to be enabled in the lexer (enabled by default).
     *
     * @return int End line (or -1 if not available)
<<<<<<< HEAD
     */
    public function getEndLine() : int;
=======
     * @phpstan-return -1|positive-int
     */
    public function getEndLine(): int;
>>>>>>> main

    /**
     * Gets the token offset of the first token that is part of this node.
     *
     * The offset is an index into the array returned by Lexer::getTokens().
     *
     * Requires the 'startTokenPos' attribute to be enabled in the lexer (DISABLED by default).
     *
     * @return int Token start position (or -1 if not available)
     */
<<<<<<< HEAD
    public function getStartTokenPos() : int;
=======
    public function getStartTokenPos(): int;
>>>>>>> main

    /**
     * Gets the token offset of the last token that is part of this node.
     *
     * The offset is an index into the array returned by Lexer::getTokens().
     *
     * Requires the 'endTokenPos' attribute to be enabled in the lexer (DISABLED by default).
     *
     * @return int Token end position (or -1 if not available)
     */
<<<<<<< HEAD
    public function getEndTokenPos() : int;
=======
    public function getEndTokenPos(): int;
>>>>>>> main

    /**
     * Gets the file offset of the first character that is part of this node.
     *
     * Requires the 'startFilePos' attribute to be enabled in the lexer (DISABLED by default).
     *
     * @return int File start position (or -1 if not available)
     */
<<<<<<< HEAD
    public function getStartFilePos() : int;
=======
    public function getStartFilePos(): int;
>>>>>>> main

    /**
     * Gets the file offset of the last character that is part of this node.
     *
     * Requires the 'endFilePos' attribute to be enabled in the lexer (DISABLED by default).
     *
     * @return int File end position (or -1 if not available)
     */
<<<<<<< HEAD
    public function getEndFilePos() : int;
=======
    public function getEndFilePos(): int;
>>>>>>> main

    /**
     * Gets all comments directly preceding this node.
     *
     * The comments are also available through the "comments" attribute.
     *
     * @return Comment[]
     */
<<<<<<< HEAD
    public function getComments() : array;
=======
    public function getComments(): array;
>>>>>>> main

    /**
     * Gets the doc comment of the node.
     *
     * @return null|Comment\Doc Doc comment object or null
     */
<<<<<<< HEAD
    public function getDocComment();
=======
    public function getDocComment(): ?Comment\Doc;
>>>>>>> main

    /**
     * Sets the doc comment of the node.
     *
     * This will either replace an existing doc comment or add it to the comments array.
     *
     * @param Comment\Doc $docComment Doc comment to set
     */
<<<<<<< HEAD
    public function setDocComment(Comment\Doc $docComment);
=======
    public function setDocComment(Comment\Doc $docComment): void;
>>>>>>> main

    /**
     * Sets an attribute on a node.
     *
<<<<<<< HEAD
     * @param string $key
     * @param mixed  $value
     */
    public function setAttribute(string $key, $value);

    /**
     * Returns whether an attribute exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasAttribute(string $key) : bool;
=======
     * @param mixed $value
     */
    public function setAttribute(string $key, $value): void;

    /**
     * Returns whether an attribute exists.
     */
    public function hasAttribute(string $key): bool;
>>>>>>> main

    /**
     * Returns the value of an attribute.
     *
<<<<<<< HEAD
     * @param string $key
     * @param mixed  $default
=======
     * @param mixed $default
>>>>>>> main
     *
     * @return mixed
     */
    public function getAttribute(string $key, $default = null);

    /**
     * Returns all the attributes of this node.
     *
<<<<<<< HEAD
     * @return array
     */
    public function getAttributes() : array;
=======
     * @return array<string, mixed>
     */
    public function getAttributes(): array;
>>>>>>> main

    /**
     * Replaces all the attributes of this node.
     *
<<<<<<< HEAD
     * @param array $attributes
     */
    public function setAttributes(array $attributes);
=======
     * @param array<string, mixed> $attributes
     */
    public function setAttributes(array $attributes): void;
>>>>>>> main
}
