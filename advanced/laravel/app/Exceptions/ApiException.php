<?php
/**
 * Created by PhpStorm.
 * User: Tiago Gomes
 * Date: 04/11/2019
 * Time: 14:24
 */

namespace App\Exceptions;

/**
 * Class ApiException
 * @package App\Exceptions
 */
class ApiException extends \Exception
{
    /**
     * ApiException constructor.
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, \Throwable $previous = null) {
        $code       = !empty($code) && is_integer($code) ? $code : 500;
        $message    = !empty($message) ? $message : 'Bad Request';
        parent::__construct($message, $code, $previous);
    }
}