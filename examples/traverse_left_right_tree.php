<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Plook\Tree\Array\TraverseLeftRightTree;

$tree = [
    ['id' => 1, 'left' => 1, 'right' => 14],
    ['id' => 2, 'left' => 2, 'right' => 7],
    ['id' => 3, 'left' => 3, 'right' => 4],
    ['id' => 4, 'left' => 5, 'right' => 6],
    ['id' => 5, 'left' => 8, 'right' => 13],
    ['id' => 6, 'left' => 9, 'right' => 10],
    ['id' => 7, 'left' => 11, 'right' => 12],
];

/** @var TraverseLeftRightTree<array{id: int, left: int, right: int}> $traverse */
$traverse = new TraverseLeftRightTree();

$traverse(
    $tree,
    'left',
    'right',
    static function (array $node): void {
        echo sprintf('Processing node %s%s', $node['id'], PHP_EOL);
    },
    static function (array $node): void {
        echo sprintf('Childrens of node %s have been processed%s', $node['id'], PHP_EOL);
    },
);
