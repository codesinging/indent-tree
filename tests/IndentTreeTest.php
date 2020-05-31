<?php
/**
 * Author:  CodeSinging (The code is singing)
 * Email:   codesinging@gmail.com
 * Github:  https://github.com/codesinging
 * Time:    2020-05-31 10:40:59
 */

namespace CodeSinging\IndentTree\Tests;

use CodeSinging\IndentTree\IndentTree;
use PHPUnit\Framework\TestCase;

class IndentTreeTest extends TestCase
{

    protected $data = [
        ['id' => 1, 'name' => '1-1', 'parent_id' => 0],
        ['id' => 2, 'name' => '1-2', 'parent_id' => 0],
        ['id' => 3, 'name' => '1-3', 'parent_id' => 0],
        ['id' => 4, 'name' => '2-1', 'parent_id' => 1],
        ['id' => 5, 'name' => '2-2', 'parent_id' => 1],
        ['id' => 6, 'name' => '2-3', 'parent_id' => 2],
        ['id' => 7, 'name' => '3-1', 'parent_id' => 5],
        ['id' => 8, 'name' => '4-1', 'parent_id' => 7],
    ];

    public function testTreeData()
    {
        $tree = new IndentTree();
        $treeData = [
            ['id' => 1, 'name' => '1-1', 'parent_id' => 0, 'children' => [
                ['id' => 4, 'name' => '2-1', 'parent_id' => 1],
                ['id' => 5, 'name' => '2-2', 'parent_id' => 1, 'children' => [
                    ['id' => 7, 'name' => '3-1', 'parent_id' => 5, 'children' => [
                        ['id' => 8, 'name' => '4-1', 'parent_id' => 7],
                    ]],
                ]],
            ]],
            ['id' => 2, 'name' => '1-2', 'parent_id' => 0, 'children' => [
                ['id' => 6, 'name' => '2-3', 'parent_id' => 2],
            ]],
            ['id' => 3, 'name' => '1-3', 'parent_id' => 0],
        ];

        self::assertEquals($treeData, $tree->treeData($this->data));
    }

    public function testIndentData()
    {
        $data = [
            ['id' => 1, 'name' => '1-1', 'parent_id' => 0, 'tree' => [
                'tab' => '├', 'depth' => 1, 'parents' => [], 'children' => [4, 5, 7, 8], 'name' => '├ 1-1',
            ]],
            ['id' => 4, 'name' => '2-1', 'parent_id' => 1, 'tree' => [
                'tab' => '│├', 'depth' => 2, 'parents' => [1], 'children' => [], 'name' => '│├ 2-1',
            ]],
            ['id' => 5, 'name' => '2-2', 'parent_id' => 1, 'tree' => [
                'tab' => '│└', 'depth' => 2, 'parents' => [1], 'children' => [7, 8], 'name' => '│└ 2-2',
            ]],
            ['id' => 7, 'name' => '3-1', 'parent_id' => 5, 'tree' => [
                'tab' => '│　└', 'depth' => 3, 'parents' => [1, 5], 'children' => [8], 'name' => '│　└ 3-1',
            ]],
            ['id' => 8, 'name' => '4-1', 'parent_id' => 7, 'tree' => [
                'tab' => '│　　└', 'depth' => 4, 'parents' => [1, 5, 7], 'children' => [], 'name' => '│　　└ 4-1',
            ]],
            ['id' => 2, 'name' => '1-2', 'parent_id' => 0, 'tree' => [
                'tab' => '├', 'depth' => 1, 'parents' => [], 'children' => [6], 'name' => '├ 1-2',
            ]],
            ['id' => 6, 'name' => '2-3', 'parent_id' => 2, 'tree' => [
                'tab' => '│└', 'depth' => 2, 'parents' => [2], 'children' => [], 'name' => '│└ 2-3',
            ]],
            ['id' => 3, 'name' => '1-3', 'parent_id' => 0, 'tree' => [
                'tab' => '└', 'depth' => 1, 'parents' => [], 'children' => [], 'name' => '└ 1-3',
            ]],
        ];
        $tree = new IndentTree();

        self::assertEquals($data, $tree->indentData($this->data));
    }

}
