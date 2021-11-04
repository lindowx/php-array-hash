<?php

namespace Lindowx\PHPArrayHash;

use PHPUnit\Framework\TestCase;

class HashTest extends TestCase
{
    public function testABC(): void
    {
        $arr1 = [
            'a' => 3,
            'b' => 'hello, world',
            'c' => [
                [1, 2, 3],
                [4, 5, 6],
            ],
        ];

        $arr2 = [
            'a' => 3,
            'b' => 'hello, world',
            'c' => [
                [4, 6, 5],
                [3, 1, 2],
            ],
        ];

        var_dump(ArrayHash::hash($arr1, 'sha1', ArrayHash::OPT_NIA_IGNORE_ORDER));
        var_dump(ArrayHash::hash($arr2, 'sha1', ArrayHash::OPT_NIA_IGNORE_ORDER));
    }

    public function testAssocHash(): void
    {
        $arr1 = [
            'a' => 3,
            'b' => 'hello, world',
            'c' => [
                [1,2,3],
                [4,5,6]
            ],
        ];

        $arr2 = [
            'c' => [
                [1,2,3],
                [4,5,6]
            ],
            'a' => 3,
            'b' => 'hello, world',
        ];

        $hashArr1 = ArrayHash::hash($arr1, 'sha1');
        $hashArr2 = ArrayHash::hash($arr2, 'sha1');

        $this->assertEquals($hashArr1, $hashArr2);
    }

    public function testNumIndexArrHash(): void
    {
        $arr1 = [
            1,
            [1,2,3,4]
        ];

        $arr2 = [
            1,
            [4,3,2,1]
        ];

        $hashArr1 = ArrayHash::hash($arr1, 'sha1');
        $hashArr2 = ArrayHash::hash($arr2, 'sha1');

        $this->assertNotEquals($hashArr1, $hashArr2);
    }

    public function testNumIndexArrHashIgnoreOrder(): void
    {
        $arr1 = [
            1,
            [1,2,3,4]
        ];

        $arr2 = [
            1,
            [4,3,2,1]
        ];

        $hashArr1 = ArrayHash::hash($arr1, 'sha1', OPT_NIA_IGNORE_ORDER);
        $hashArr2 = ArrayHash::hash($arr2, 'sha1', OPT_NIA_IGNORE_ORDER);
        $this->assertEquals($hashArr1, $hashArr2);

        $hashArr2Normal = ArrayHash::hash($arr2, 'sha1');
        $this->assertNotEquals($hashArr1, $hashArr2Normal);
    }
}
