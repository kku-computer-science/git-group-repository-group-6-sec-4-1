<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage\StaticAnalysis;

<<<<<<< HEAD
use PhpParser\Node;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\BinaryOp;
use PhpParser\Node\Expr\CallLike;
use PhpParser\Node\Expr\Cast;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\Match_;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\NullsafePropertyFetch;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\StaticPropertyFetch;
use PhpParser\Node\Expr\Ternary;
use PhpParser\Node\MatchArm;
use PhpParser\Node\Scalar\Encapsed;
use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Case_;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Continue_;
use PhpParser\Node\Stmt\Do_;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\Else_;
use PhpParser\Node\Stmt\ElseIf_;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Finally_;
use PhpParser\Node\Stmt\For_;
use PhpParser\Node\Stmt\Foreach_;
use PhpParser\Node\Stmt\Goto_;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\Return_;
use PhpParser\Node\Stmt\Switch_;
use PhpParser\Node\Stmt\Throw_;
use PhpParser\Node\Stmt\TryCatch;
use PhpParser\Node\Stmt\Unset_;
use PhpParser\Node\Stmt\While_;
=======
use function array_diff_key;
use function assert;
use function count;
use function current;
use function end;
use function explode;
use function max;
use function preg_match;
use function preg_quote;
use function range;
use function reset;
use function sprintf;
use PhpParser\Node;
>>>>>>> main
use PhpParser\NodeVisitorAbstract;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class ExecutableLinesFindingVisitor extends NodeVisitorAbstract
{
    /**
<<<<<<< HEAD
     * @psalm-var array<int, int>
     */
    private $executableLines = [];

    /**
     * @psalm-var array<int, int>
     */
    private $propertyLines = [];

    /**
     * @psalm-var array<int, Return_>
     */
    private $returns = [];

    public function enterNode(Node $node): void
    {
        $this->savePropertyLines($node);

        if (!$this->isExecutable($node)) {
            return;
        }

        foreach ($this->getLines($node) as $line) {
            if (isset($this->propertyLines[$line])) {
                return;
            }

            $this->executableLines[$line] = $line;
        }
    }

    /**
     * @psalm-return array<int, int>
     */
    public function executableLines(): array
    {
        $this->computeReturns();

        sort($this->executableLines);

        return $this->executableLines;
    }

    private function savePropertyLines(Node $node): void
    {
        if (!$node instanceof Property && !$node instanceof Node\Stmt\ClassConst) {
            return;
        }

        foreach (range($node->getStartLine(), $node->getEndLine()) as $index) {
            $this->propertyLines[$index] = $index;
        }
    }

    private function computeReturns(): void
    {
        foreach ($this->returns as $return) {
            foreach (range($return->getStartLine(), $return->getEndLine()) as $loc) {
                if (isset($this->executableLines[$loc])) {
                    continue 2;
                }
            }

            $line = $return->getEndLine();

            if ($return->expr !== null) {
                $line = $return->expr->getStartLine();
            }

            $this->executableLines[$line] = $line;
        }
    }

    /**
     * @return int[]
     */
    private function getLines(Node $node): array
    {
        if ($node instanceof Cast ||
            $node instanceof PropertyFetch ||
            $node instanceof NullsafePropertyFetch ||
            $node instanceof StaticPropertyFetch) {
            return [$node->getEndLine()];
        }

        if ($node instanceof ArrayDimFetch) {
            if (null === $node->dim) {
                return [];
            }

            return [$node->dim->getStartLine()];
        }

        if ($node instanceof Array_) {
            $startLine = $node->getStartLine();

            if (isset($this->executableLines[$startLine])) {
                return [];
            }

            if ([] === $node->items) {
                return [$node->getEndLine()];
            }

            if ($node->items[0] instanceof ArrayItem) {
                return [$node->items[0]->getStartLine()];
            }
        }

        if ($node instanceof ClassMethod) {
            if ($node->name->name !== '__construct') {
                return [];
            }

            $existsAPromotedProperty = false;

            foreach ($node->getParams() as $param) {
                if (0 !== ($param->flags & Class_::VISIBILITY_MODIFIER_MASK)) {
                    $existsAPromotedProperty = true;

                    break;
                }
            }

            if ($existsAPromotedProperty) {
                // Only the line with `function` keyword should be listed here
                // but `nikic/php-parser` doesn't provide a way to fetch it
                return range($node->getStartLine(), $node->name->getEndLine());
            }

            return [];
        }

        if ($node instanceof MethodCall) {
            return [$node->name->getStartLine()];
        }

        if ($node instanceof Ternary) {
            $lines = [$node->cond->getStartLine()];

            if (null !== $node->if) {
                $lines[] = $node->if->getStartLine();
            }

            $lines[] = $node->else->getStartLine();

            return $lines;
        }

        if ($node instanceof Match_) {
            return [$node->cond->getStartLine()];
        }

        if ($node instanceof MatchArm) {
            return [$node->body->getStartLine()];
        }

        if ($node instanceof Expression && (
            $node->expr instanceof Cast ||
            $node->expr instanceof Match_ ||
            $node->expr instanceof MethodCall
        )) {
            return [];
        }

        if ($node instanceof Return_) {
            $this->returns[] = $node;

            return [];
        }

        return [$node->getStartLine()];
    }

    private function isExecutable(Node $node): bool
    {
        return $node instanceof Assign ||
               $node instanceof ArrayDimFetch ||
               $node instanceof Array_ ||
               $node instanceof BinaryOp ||
               $node instanceof Break_ ||
               $node instanceof CallLike ||
               $node instanceof Case_ ||
               $node instanceof Cast ||
               $node instanceof Catch_ ||
               $node instanceof ClassMethod ||
               $node instanceof Closure ||
               $node instanceof Continue_ ||
               $node instanceof Do_ ||
               $node instanceof Echo_ ||
               $node instanceof ElseIf_ ||
               $node instanceof Else_ ||
               $node instanceof Encapsed ||
               $node instanceof Expression ||
               $node instanceof Finally_ ||
               $node instanceof For_ ||
               $node instanceof Foreach_ ||
               $node instanceof Goto_ ||
               $node instanceof If_ ||
               $node instanceof Match_ ||
               $node instanceof MatchArm ||
               $node instanceof MethodCall ||
               $node instanceof NullsafePropertyFetch ||
               $node instanceof PropertyFetch ||
               $node instanceof Return_ ||
               $node instanceof StaticPropertyFetch ||
               $node instanceof Switch_ ||
               $node instanceof Ternary ||
               $node instanceof Throw_ ||
               $node instanceof TryCatch ||
               $node instanceof Unset_ ||
               $node instanceof While_;
=======
     * @var int
     */
    private $nextBranch = 0;

    /**
     * @var string
     */
    private $source;

    /**
     * @var array<int, int>
     */
    private $executableLinesGroupedByBranch = [];

    /**
     * @var array<int, bool>
     */
    private $unsets = [];

    /**
     * @var array<int, string>
     */
    private $commentsToCheckForUnset = [];

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public function enterNode(Node $node): void
    {
        foreach ($node->getComments() as $comment) {
            $commentLine = $comment->getStartLine();

            if (!isset($this->executableLinesGroupedByBranch[$commentLine])) {
                continue;
            }

            foreach (explode("\n", $comment->getText()) as $text) {
                $this->commentsToCheckForUnset[$commentLine] = $text;
                $commentLine++;
            }
        }

        if ($node instanceof Node\Scalar\String_ ||
            $node instanceof Node\Scalar\EncapsedStringPart) {
            $startLine = $node->getStartLine() + 1;
            $endLine   = $node->getEndLine() - 1;

            if ($startLine <= $endLine) {
                foreach (range($startLine, $endLine) as $line) {
                    unset($this->executableLinesGroupedByBranch[$line]);
                }
            }

            return;
        }

        if ($node instanceof Node\Stmt\Interface_) {
            foreach (range($node->getStartLine(), $node->getEndLine()) as $line) {
                $this->unsets[$line] = true;
            }

            return;
        }

        if ($node instanceof Node\Stmt\Declare_ ||
            $node instanceof Node\Stmt\DeclareDeclare ||
            $node instanceof Node\Stmt\Else_ ||
            $node instanceof Node\Stmt\EnumCase ||
            $node instanceof Node\Stmt\Finally_ ||
            $node instanceof Node\Stmt\GroupUse ||
            $node instanceof Node\Stmt\Label ||
            $node instanceof Node\Stmt\Namespace_ ||
            $node instanceof Node\Stmt\Nop ||
            $node instanceof Node\Stmt\Switch_ ||
            $node instanceof Node\Stmt\TryCatch ||
            $node instanceof Node\Stmt\Use_ ||
            $node instanceof Node\Stmt\UseUse ||
            $node instanceof Node\Expr\ConstFetch ||
            $node instanceof Node\Expr\Match_ ||
            $node instanceof Node\Expr\Variable ||
            $node instanceof Node\Expr\Throw_ ||
            $node instanceof Node\ComplexType ||
            $node instanceof Node\Const_ ||
            $node instanceof Node\Identifier ||
            $node instanceof Node\Name ||
            $node instanceof Node\Param ||
            $node instanceof Node\Scalar) {
            return;
        }

        /*
         * nikic/php-parser ^4.18 represents <code>throw</code> statements
         * as <code>Stmt\Throw_</code> objects
         */
        if ($node instanceof Node\Stmt\Throw_) {
            $this->setLineBranch($node->expr->getEndLine(), $node->expr->getEndLine(), ++$this->nextBranch);

            return;
        }

        /*
         * nikic/php-parser ^5 represents <code>throw</code> statements
         * as <code>Stmt\Expression</code> objects that contain an
         * <code>Expr\Throw_</code> object
         */
        if ($node instanceof Node\Stmt\Expression && $node->expr instanceof Node\Expr\Throw_) {
            $this->setLineBranch($node->expr->expr->getEndLine(), $node->expr->expr->getEndLine(), ++$this->nextBranch);

            return;
        }

        if ($node instanceof Node\Stmt\Enum_ ||
            $node instanceof Node\Stmt\Function_ ||
            $node instanceof Node\Stmt\Class_ ||
            $node instanceof Node\Stmt\ClassMethod ||
            $node instanceof Node\Expr\Closure ||
            $node instanceof Node\Stmt\Trait_) {
            $isConcreteClassLike = $node instanceof Node\Stmt\Enum_ || $node instanceof Node\Stmt\Class_ || $node instanceof Node\Stmt\Trait_;

            if (null !== $node->stmts) {
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Node\Stmt\Nop) {
                        continue;
                    }

                    foreach (range($stmt->getStartLine(), $stmt->getEndLine()) as $line) {
                        unset($this->executableLinesGroupedByBranch[$line]);

                        if (
                            $isConcreteClassLike &&
                            !$stmt instanceof Node\Stmt\ClassMethod
                        ) {
                            $this->unsets[$line] = true;
                        }
                    }
                }
            }

            if ($isConcreteClassLike) {
                return;
            }

            $hasEmptyBody = [] === $node->stmts ||
                null === $node->stmts ||
                (
                    1 === count($node->stmts) &&
                    $node->stmts[0] instanceof Node\Stmt\Nop
                );

            if ($hasEmptyBody) {
                if ($node->getEndLine() === $node->getStartLine()) {
                    return;
                }

                $this->setLineBranch($node->getEndLine(), $node->getEndLine(), ++$this->nextBranch);

                return;
            }

            return;
        }

        if ($node instanceof Node\Expr\ArrowFunction) {
            $startLine = max(
                $node->getStartLine() + 1,
                $node->expr->getStartLine()
            );

            $endLine = $node->expr->getEndLine();

            if ($endLine < $startLine) {
                return;
            }

            $this->setLineBranch($startLine, $endLine, ++$this->nextBranch);

            return;
        }

        if ($node instanceof Node\Expr\Ternary) {
            if (null !== $node->if &&
                $node->getStartLine() !== $node->if->getEndLine()) {
                $this->setLineBranch($node->if->getStartLine(), $node->if->getEndLine(), ++$this->nextBranch);
            }

            if ($node->getStartLine() !== $node->else->getEndLine()) {
                $this->setLineBranch($node->else->getStartLine(), $node->else->getEndLine(), ++$this->nextBranch);
            }

            return;
        }

        if ($node instanceof Node\Expr\BinaryOp\Coalesce) {
            if ($node->getStartLine() !== $node->getEndLine()) {
                $this->setLineBranch($node->getEndLine(), $node->getEndLine(), ++$this->nextBranch);
            }

            return;
        }

        if ($node instanceof Node\Stmt\If_ ||
            $node instanceof Node\Stmt\ElseIf_ ||
            $node instanceof Node\Stmt\Case_) {
            if (null === $node->cond) {
                return;
            }

            $this->setLineBranch(
                $node->cond->getStartLine(),
                $node->cond->getStartLine(),
                ++$this->nextBranch
            );

            return;
        }

        if ($node instanceof Node\Stmt\For_) {
            $startLine = null;
            $endLine   = null;

            if ([] !== $node->init) {
                $startLine = $node->init[0]->getStartLine();

                end($node->init);

                $endLine = current($node->init)->getEndLine();

                reset($node->init);
            }

            if ([] !== $node->cond) {
                if (null === $startLine) {
                    $startLine = $node->cond[0]->getStartLine();
                }

                end($node->cond);

                $endLine = current($node->cond)->getEndLine();

                reset($node->cond);
            }

            if ([] !== $node->loop) {
                if (null === $startLine) {
                    $startLine = $node->loop[0]->getStartLine();
                }

                end($node->loop);

                $endLine = current($node->loop)->getEndLine();

                reset($node->loop);
            }

            if (null === $startLine || null === $endLine) {
                return;
            }

            $this->setLineBranch(
                $startLine,
                $endLine,
                ++$this->nextBranch
            );

            return;
        }

        if ($node instanceof Node\Stmt\Foreach_) {
            $this->setLineBranch(
                $node->expr->getStartLine(),
                $node->valueVar->getEndLine(),
                ++$this->nextBranch
            );

            return;
        }

        if ($node instanceof Node\Stmt\While_ ||
            $node instanceof Node\Stmt\Do_) {
            $this->setLineBranch(
                $node->cond->getStartLine(),
                $node->cond->getEndLine(),
                ++$this->nextBranch
            );

            return;
        }

        if ($node instanceof Node\Stmt\Catch_) {
            assert([] !== $node->types);
            $startLine = $node->types[0]->getStartLine();
            end($node->types);
            $endLine = current($node->types)->getEndLine();

            $this->setLineBranch(
                $startLine,
                $endLine,
                ++$this->nextBranch
            );

            return;
        }

        if ($node instanceof Node\Expr\CallLike) {
            if (isset($this->executableLinesGroupedByBranch[$node->getStartLine()])) {
                $branch = $this->executableLinesGroupedByBranch[$node->getStartLine()];
            } else {
                $branch = ++$this->nextBranch;
            }

            $this->setLineBranch($node->getStartLine(), $node->getEndLine(), $branch);

            return;
        }

        if (isset($this->executableLinesGroupedByBranch[$node->getStartLine()])) {
            return;
        }

        $this->setLineBranch($node->getStartLine(), $node->getEndLine(), ++$this->nextBranch);
    }

    public function afterTraverse(array $nodes): void
    {
        $lines = explode("\n", $this->source);

        foreach ($lines as $lineNumber => $line) {
            $lineNumber++;

            if (1 === preg_match('/^\s*$/', $line) ||
                (
                    isset($this->commentsToCheckForUnset[$lineNumber]) &&
                    1 === preg_match(sprintf('/^\s*%s\s*$/', preg_quote($this->commentsToCheckForUnset[$lineNumber], '/')), $line)
                )) {
                unset($this->executableLinesGroupedByBranch[$lineNumber]);
            }
        }

        $this->executableLinesGroupedByBranch = array_diff_key(
            $this->executableLinesGroupedByBranch,
            $this->unsets
        );
    }

    public function executableLinesGroupedByBranch(): array
    {
        return $this->executableLinesGroupedByBranch;
    }

    private function setLineBranch(int $start, int $end, int $branch): void
    {
        foreach (range($start, $end) as $line) {
            $this->executableLinesGroupedByBranch[$line] = $branch;
        }
>>>>>>> main
    }
}
