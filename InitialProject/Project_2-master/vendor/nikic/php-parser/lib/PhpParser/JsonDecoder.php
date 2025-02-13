<?php declare(strict_types=1);

namespace PhpParser;

<<<<<<< HEAD
class JsonDecoder
{
    /** @var \ReflectionClass[] Node type to reflection class map */
    private $reflectionClassCache;

=======
class JsonDecoder {
    /** @var \ReflectionClass<Node>[] Node type to reflection class map */
    private array $reflectionClassCache;

    /** @return mixed */
>>>>>>> main
    public function decode(string $json) {
        $value = json_decode($json, true);
        if (json_last_error()) {
            throw new \RuntimeException('JSON decoding error: ' . json_last_error_msg());
        }

        return $this->decodeRecursive($value);
    }

<<<<<<< HEAD
=======
    /**
     * @param mixed $value
     * @return mixed
     */
>>>>>>> main
    private function decodeRecursive($value) {
        if (\is_array($value)) {
            if (isset($value['nodeType'])) {
                if ($value['nodeType'] === 'Comment' || $value['nodeType'] === 'Comment_Doc') {
                    return $this->decodeComment($value);
                }
                return $this->decodeNode($value);
            }
            return $this->decodeArray($value);
        }
        return $value;
    }

<<<<<<< HEAD
    private function decodeArray(array $array) : array {
=======
    private function decodeArray(array $array): array {
>>>>>>> main
        $decodedArray = [];
        foreach ($array as $key => $value) {
            $decodedArray[$key] = $this->decodeRecursive($value);
        }
        return $decodedArray;
    }

<<<<<<< HEAD
    private function decodeNode(array $value) : Node {
=======
    private function decodeNode(array $value): Node {
>>>>>>> main
        $nodeType = $value['nodeType'];
        if (!\is_string($nodeType)) {
            throw new \RuntimeException('Node type must be a string');
        }

        $reflectionClass = $this->reflectionClassFromNodeType($nodeType);
<<<<<<< HEAD
        /** @var Node $node */
=======
>>>>>>> main
        $node = $reflectionClass->newInstanceWithoutConstructor();

        if (isset($value['attributes'])) {
            if (!\is_array($value['attributes'])) {
                throw new \RuntimeException('Attributes must be an array');
            }

            $node->setAttributes($this->decodeArray($value['attributes']));
        }

        foreach ($value as $name => $subNode) {
            if ($name === 'nodeType' || $name === 'attributes') {
                continue;
            }

            $node->$name = $this->decodeRecursive($subNode);
        }

        return $node;
    }

<<<<<<< HEAD
    private function decodeComment(array $value) : Comment {
=======
    private function decodeComment(array $value): Comment {
>>>>>>> main
        $className = $value['nodeType'] === 'Comment' ? Comment::class : Comment\Doc::class;
        if (!isset($value['text'])) {
            throw new \RuntimeException('Comment must have text');
        }

        return new $className(
            $value['text'],
            $value['line'] ?? -1, $value['filePos'] ?? -1, $value['tokenPos'] ?? -1,
            $value['endLine'] ?? -1, $value['endFilePos'] ?? -1, $value['endTokenPos'] ?? -1
        );
    }

<<<<<<< HEAD
    private function reflectionClassFromNodeType(string $nodeType) : \ReflectionClass {
=======
    /** @return \ReflectionClass<Node> */
    private function reflectionClassFromNodeType(string $nodeType): \ReflectionClass {
>>>>>>> main
        if (!isset($this->reflectionClassCache[$nodeType])) {
            $className = $this->classNameFromNodeType($nodeType);
            $this->reflectionClassCache[$nodeType] = new \ReflectionClass($className);
        }
        return $this->reflectionClassCache[$nodeType];
    }

<<<<<<< HEAD
    private function classNameFromNodeType(string $nodeType) : string {
=======
    /** @return class-string<Node> */
    private function classNameFromNodeType(string $nodeType): string {
>>>>>>> main
        $className = 'PhpParser\\Node\\' . strtr($nodeType, '_', '\\');
        if (class_exists($className)) {
            return $className;
        }

        $className .= '_';
        if (class_exists($className)) {
            return $className;
        }

        throw new \RuntimeException("Unknown node type \"$nodeType\"");
    }
}
