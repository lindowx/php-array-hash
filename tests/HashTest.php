<?php

namespace Lindowx\PHPArrayHash;

use PHPUnit\Framework\TestCase;

class HashTest extends TestCase
{
    public function testAssocHash()
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

    public function testNumIndexArrHash()
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
}
