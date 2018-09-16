<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

/**
 * Class AbstractException
 * @package App\Exception
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
abstract class AbstractException extends \Exception
{
    /**
     * AbstractException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @param string $error
     */
    public function __construct(string $message = "", int $code = 0, string $error, ?Throwable $previous = null)
    {
        $config = require __DIR__ . '/../../../config/config.php';
        if ($config['errorException']) {
            $message = $message . ' - ' . $error;
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function errorArray()
    {
        return [
            'code' => $this->getCode(),
            'message' => $this->getMessage()
        ];
    }
}
