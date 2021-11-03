# php-array-hash

A PHP array hashing library that can hashing multi-dimension array into a unique string value.

## Installation

```bash
composer require lindowx/php-array-hash
```

## Usage

```php
use Lindowx\PHPArrayHash\ArrayHash;


$arr1 = [
    'a' => 3,
    'b' => 'hello, world',
    'c' => [
        [1,2,3],
        [4,5,6]
    ],
];

// 4dea90f136ff0bdeb8da5a7da0f03b1858d62b16
$arrSha1Hash = ArrayHash::hash($arr1, 'sha1');

// 32a02c4310e4c71c27fd5a42b25d0e73
$arrMd5Hash = ArrayHash::hash($arr1, 'md5');

//09ce8e0554ed842d50162e28710331415735e7f618b1caa396f28ab0f3cd99d9
$arrCustomHash = ArrayHash::hash($arr1, function ($stub) {
    $key = 'this is a key';
    return hash_hmac('sha256', $stub, $key);
});
```

# Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.