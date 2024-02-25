<?php

declare(strict_types=1);

namespace Haikara\Pagination\Exceptions;

use RuntimeException;

class CurrentException extends RuntimeException
{
    public function __construct()
    {
        $this->message = '指定されたページは存在しません。';
    }
}
