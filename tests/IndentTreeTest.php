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
            ['id' => 1, 'name' => '1-1', 'parent_id' => 0, 'indent_tree' => [
                'tab' => '├', 'depth' => 1, 'parent_map' => [1], 'children_map' => [1, 4, 5, 7, 8], 'tab_name' => '├ 1-1',
            ]],
            ['id' => 4, 'name' => '2-1', 'parent_id' => 1, 'indent_tree' => [
                'tab' => '│├', 'depth' => 2, 'parent_map' => [1, 4], 'children_map' => [4], 'tab_name' => '│├ 2-1',
            ]],
            ['id' => 5, 'name' => '2-2', 'parent_id' => 1, 'indent_tree' => [
                'tab' => '│└', 'depth' => 2, 'parent_map' => [1, 5], 'children_map' => [5, 7, 8], 'tab_name' => '│└ 2-2',
            ]],
            ['id' => 7, 'name' => '3-1', 'parent_id' => 5, 'indent_tree' => [
                'tab' => '│　└', 'depth' => 3, 'parent_map' => [1, 5, 7], 'children_map' => [7, 8], 'tab_name' => '│　└ 3-1',
            ]],
            ['id' => 8, 'name' => '4-1', 'parent_id' => 7, 'indent_tree' => [
                'tab' => '│　　└', 'depth' => 4, 'parent_map' => [1, 5, 7, 8], 'children_map' => [8], 'tab_name' => '│　　└ 4-1',
            ]],
            ['id' => 2, 'name' => '1-2', 'parent_id' => 0, 'indent_tree' => [
                'tab' => '├', 'depth' => 1, 'parent_map' => [2], 'children_map' => [2, 6], 'tab_name' => '├ 1-2',
            ]],
            ['id' => 6, 'name' => '2-3', 'parent_id' => 2, 'indent_tree' => [
                'tab' => '│└', 'depth' => 2, 'parent_map' => [2, 6], 'children_map' => [6], 'tab_name' => '│└ 2-3',
            ]],
            ['id' => 3, 'name' => '1-3', 'parent_id' => 0, 'indent_tree' => [
                'tab' => '└', 'depth' => 1, 'parent_map' => [3], 'children_map' => [3], 'tab_name' => '└ 1-3',
            ]],
        ];
        $tree = new IndentTree();

        self::assertEquals($data, $tree->indentData($this->data));
    }

}
