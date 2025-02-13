<?php

declare(strict_types=1);

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Extension\CommonMark\Renderer\Block;

use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
<<<<<<< HEAD
use League\CommonMark\Extension\TaskList\TaskListItemMarker;
use League\CommonMark\Node\Block\Paragraph;
=======
use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Block\TightBlockInterface;
>>>>>>> main
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

final class ListItemRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param ListItem $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        ListItem::assertInstanceOf($node);

        $contents = $childRenderer->renderNodes($node->children());
<<<<<<< HEAD
        if (\substr($contents, 0, 1) === '<' && ! $this->startsTaskListItem($node)) {
            $contents = "\n" . $contents;
        }

        if (\substr($contents, -1, 1) === '>') {
=======

        $inTightList = ($parent = $node->parent()) && $parent instanceof TightBlockInterface && $parent->isTight();

        if ($this->needsBlockSeparator($node->firstChild(), $inTightList)) {
            $contents = "\n" . $contents;
        }

        if ($this->needsBlockSeparator($node->lastChild(), $inTightList)) {
>>>>>>> main
            $contents .= "\n";
        }

        $attrs = $node->data->get('attributes');

        return new HtmlElement('li', $attrs, $contents);
    }

    public function getXmlTagName(Node $node): string
    {
        return 'item';
    }

    /**
     * {@inheritDoc}
     */
    public function getXmlAttributes(Node $node): array
    {
        return [];
    }

<<<<<<< HEAD
    private function startsTaskListItem(ListItem $block): bool
    {
        $firstChild = $block->firstChild();

        return $firstChild instanceof Paragraph && $firstChild->firstChild() instanceof TaskListItemMarker;
=======
    private function needsBlockSeparator(?Node $child, bool $inTightList): bool
    {
        if ($child instanceof Paragraph && $inTightList) {
            return false;
        }

        return $child instanceof AbstractBlock;
>>>>>>> main
    }
}
