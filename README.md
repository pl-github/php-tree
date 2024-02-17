# Tree

[![codecov](https://codecov.io/gh/pl-github/php-tree/graph/badge.svg?token=7CYQ6TO5GJ)](https://codecov.io/gh/pl-github/php-tree)

A PHP library for working with tree data structures.

## Installation

```shell
$ composer require plook/tree
```

## Working with trees that are stored in arrays

### Traversing a left/right tree that is ordered by the left value

```php
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
```

```text
Processing node 1
Processing node 2
Processing node 3
Childrens of node 3 have been processed
Processing node 4
Childrens of node 4 have been processed
Childrens of node 2 have been processed
Processing node 5
Processing node 6
Childrens of node 6 have been processed
Processing node 7
Childrens of node 7 have been processed
Childrens of node 5 have been processed
Childrens of node 1 have been processed
```
