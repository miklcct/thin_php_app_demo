<?php
declare(strict_types=1);

namespace App\View;

use Interop\Http\Factory\StreamFactoryInterface;
use Miklcct\ThinPhpApp\View\ExceptionView as Base;
use Miklcct\ThinPhpApp\View\PhpTemplate;
use Throwable;

class ExceptionView extends PhpTemplate implements Base {
    public function __construct(StreamFactoryInterface $factory) {
        parent::__construct($factory);
    }

    public function getPathToTemplate() : string {
        return __DIR__ . '/../../template/exception.phtml';
    }

    public function setException(Throwable $exception) {
        $this->exception = $exception;
    }

    /** @var Throwable */
    protected $exception;
}