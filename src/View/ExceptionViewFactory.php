<?php
declare(strict_types=1);

namespace App\View;

use Interop\Http\Factory\StreamFactoryInterface;
use Miklcct\ThinPhpApp\View\ExceptionViewFactory as Base;
use Miklcct\ThinPhpApp\View\View;
use Throwable;

class ExceptionViewFactory implements Base {
    public function __construct(StreamFactoryInterface $factory) {
        $this->factory = $factory;
    }

    public function __invoke(Throwable $exception) : View {
        return new ExceptionView($this->factory, $exception);
    }

    /** @var StreamFactoryInterface */
    private $factory;
}