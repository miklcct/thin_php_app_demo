<?php
declare(strict_types=1);

namespace App\View;

use Psr\Http\Message\StreamFactoryInterface;
use Miklcct\ThinPhpApp\View\PhpTemplate;
use Throwable;

class ExceptionView extends PhpTemplate {
    public function __construct(StreamFactoryInterface $factory, Throwable $exception) {
        parent::__construct($factory);
        $this->exception = $exception;
    }

    public function getPathToTemplate() : string {
        return __DIR__ . '/../../template/exception.phtml';
    }

    /**
     * @var Throwable
     */
    protected $exception;
}