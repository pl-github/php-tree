<?php

declare(strict_types=1);

namespace Plook\Tree\Array;

use function array_pop;
use function count;

/** @template T of array */
final class TraverseLeftRightTree
{
    /**
     * @param T[]               $tree
     * @param callable(T): void $beforeChildren
     * @param callable(T): void $afterChildren
     */
    public function __invoke(
        array $tree,
        int|string $leftKey,
        int|string $rightKey,
        callable $beforeChildren,
        callable $afterChildren,
    ): void {
        $parents = [];

        foreach ($tree as $node) {
            while ($parents !== [] && $parents[count($parents) - 1][$rightKey] < $node[$leftKey]) {
                $afterChildren(array_pop($parents));
            }

            $beforeChildren($node);

            $parents[] = $node;
        }

        while ($parents !== []) {
            $afterChildren(array_pop($parents));
        }
    }
}
