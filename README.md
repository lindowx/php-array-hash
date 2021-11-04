# php-array-hash

A PHP array hashing library that can hashing multi-dimension array into a unique string value.

## Requirements

PHP >= 7.3

## Installation

```bash
composer require lindowx/php-array-hash
```

## Usage

```php
/**
 * Array hashing
 * 
 * @param array $arr        The array data you want to hash
 * @param callable $func    Hash algo function
 * @param int $options      Hashing options
 */
Lindowx\PHPArrayHash\ArrayHash::hash(array $arr, callable $func, int $options = 0): string;
```

### Hashing options

 - **ArrayHash::OPT_NIA_IGNORE_ORDER**  Ignore the value order when the source array contains num-index lists 

### Examples
```php
use Lindowx\PHPArrayHash\ArrayHash;


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

// SHA-1 hashing
// 4dea90f136ff0bdeb8da5a7da0f03b1858d62b16
$arrSha1Hash = ArrayHash::hash($arr1, 'sha1');

// MD5 hashing
// 32a02c4310e4c71c27fd5a42b25d0e73
$arrMd5Hash = ArrayHash::hash($arr1, 'md5');

// Custom hashing
//09ce8e0554ed842d50162e28710331415735e7f618b1caa396f28ab0f3cd99d9
$arrCustomHash = ArrayHash::hash($arr1, function ($stub) {
    $key = 'this is a key';
    return hash_hmac('sha256', $stub, $key);
});


// 80895b6e8ab6d0d4d1201f84b3ba8b5f70bb50ea
$arr1Sha1NumIdxListIgnoreOrder = ArrayHash::hash($arr1, 'sha1', ArrayHash::OPT_NIA_IGNORE_ORDER);
// 80895b6e8ab6d0d4d1201f84b3ba8b5f70bb50ea
$arr2Sha1NumIdxListIgnoreOrder = ArrayHash::hash($arr2, 'sha1', ArrayHash::OPT_NIA_IGNORE_ORDER);
```

# Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.