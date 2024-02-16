<?php

declare(strict_types=1);

namespace Plook\Tests\Tree\Array;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Plook\Tree\Array\TraverseLeftRightTree;

#[CoversClass(TraverseLeftRightTree::class)]
final class TraverseLeftRightTreeTest extends TestCase
{
    /** @var TraverseLeftRightTree<array{id: int, left: int, right: int}> */
    private TraverseLeftRightTree $traverseLeftRightTree;

    protected function setUp(): void
    {
        $this->traverseLeftRightTree = new TraverseLeftRightTree();
    }

    public function testTraverseTreeWithOneNode(): void
    {
        $givenTree = [
            ['id' => 1, 'left' => 1, 'right' => 2],
        ];

        /** @var list<string> $callOrder */
        $callOrder = [];

        ($this->traverseLeftRightTree)(
            $givenTree,
            'left',
            'right',
            static function (array $row) use (&$callOrder): void {
                $callOrder[] = 'before ' . $row['id'];
            },
            static function (array $row) use (&$callOrder): void {
                $callOrder[] = 'after ' . $row['id'];
            },
        );

        self::assertSame(
            [
                'before 1',
                'after 1',
            ],
            $callOrder,
        );
    }

    public function testTraverseTreeWithOneNodeAndOneChild(): void
    {
        $givenTree = [
            ['id' => 1, 'left' => 1, 'right' => 4],
            ['id' => 2, 'left' => 2, 'right' => 3],
        ];

        /** @var list<string> $callOrder */
        $callOrder = [];

        ($this->traverseLeftRightTree)(
            $givenTree,
            'left',
            'right',
            static function (array $row) use (&$callOrder): void {
                $callOrder[] = 'before ' . $row['id'];
            },
            static function (array $row) use (&$callOrder): void {
                $callOrder[] = 'after ' . $row['id'];
            },
        );

        self::assertSame(
            [
                'before 1',
                'before 2',
                'after 2',
                'after 1',
            ],
            $callOrder,
        );
    }

    public function testTraverseTreeWithSevenNodes(): void
    {
        $givenTree = [
            ['id' => 1, 'left' => 1, 'right' => 14],
            ['id' => 2, 'left' => 2, 'right' => 7],
            ['id' => 3, 'left' => 3, 'right' => 4],
            ['id' => 4, 'left' => 5, 'right' => 6],
            ['id' => 5, 'left' => 8, 'right' => 13],
            ['id' => 6, 'left' => 9, 'right' => 10],
            ['id' => 7, 'left' => 11, 'right' => 12],
        ];

        /** @var list<string> $callOrder */
        $callOrder = [];

        ($this->traverseLeftRightTree)(
            $givenTree,
            'left',
            'right',
            static function (array $row) use (&$callOrder): void {
                $callOrder[] = 'before ' . $row['id'];
            },
            static function (array $row) use (&$callOrder): void {
                $callOrder[] = 'after ' . $row['id'];
            },
        );

        self::assertEquals(
            [
                'before 1',
                'before 2',
                'before 3',
                'after 3',
                'before 4',
                'after 4',
                'after 2',
                'before 5',
                'before 6',
                'after 6',
                'before 7',
                'after 7',
                'after 5',
                'after 1',
            ],
            $callOrder,
        );
    }
}
