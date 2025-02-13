<?php declare(strict_types=1);
/*
 * This file is part of sebastian/lines-of-code.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\LinesOfCode;

use function substr_count;
use PhpParser\Error;
<<<<<<< HEAD
use PhpParser\Lexer;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\Parser;
=======
use PhpParser\Node;
use PhpParser\NodeTraverser;
>>>>>>> main
use PhpParser\ParserFactory;

final class Counter
{
    /**
     * @throws RuntimeException
     */
    public function countInSourceFile(string $sourceFile): LinesOfCode
    {
        return $this->countInSourceString(file_get_contents($sourceFile));
    }

    /**
     * @throws RuntimeException
     */
    public function countInSourceString(string $source): LinesOfCode
    {
        $linesOfCode = substr_count($source, "\n");

        if ($linesOfCode === 0 && !empty($source)) {
            $linesOfCode = 1;
        }

        try {
<<<<<<< HEAD
            $nodes = $this->parser()->parse($source);
=======
            $nodes = (new ParserFactory)->createForHostVersion()->parse($source);
>>>>>>> main

            assert($nodes !== null);

            return $this->countInAbstractSyntaxTree($linesOfCode, $nodes);

            // @codeCoverageIgnoreStart
        } catch (Error $error) {
            throw new RuntimeException(
                $error->getMessage(),
                (int) $error->getCode(),
                $error
            );
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * @param Node[] $nodes
     *
     * @throws RuntimeException
     */
    public function countInAbstractSyntaxTree(int $linesOfCode, array $nodes): LinesOfCode
    {
        $traverser = new NodeTraverser;
        $visitor   = new LineCountingVisitor($linesOfCode);

        $traverser->addVisitor($visitor);

        try {
            /* @noinspection UnusedFunctionResultInspection */
            $traverser->traverse($nodes);
            // @codeCoverageIgnoreStart
        } catch (Error $error) {
            throw new RuntimeException(
                $error->getMessage(),
                (int) $error->getCode(),
                $error
            );
        }
        // @codeCoverageIgnoreEnd

        return $visitor->result();
    }
<<<<<<< HEAD

    private function parser(): Parser
    {
        return (new ParserFactory)->create(ParserFactory::PREFER_PHP7, new Lexer);
    }
=======
>>>>>>> main
}
