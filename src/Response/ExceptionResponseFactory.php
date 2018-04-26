<?php
declare(strict_types=1);

namespace App\Response;

use App\View\ExceptionView;
use Interop\Http\Factory\StreamFactoryInterface;
use Miklcct\ThinPhpApp\Response\ExceptionResponseFactoryInterface;
use Miklcct\ThinPhpApp\Response\ViewResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Teapot\HttpException;
use Teapot\StatusCode\Http;
use Throwable;

class ExceptionResponseFactory implements ExceptionResponseFactoryInterface {
    public function __construct(ViewResponseFactoryInterface $viewResponseFactory, StreamFactoryInterface $streamFactory) {
        $this->viewResponseFactory = $viewResponseFactory;
        $this->streamFactory = $streamFactory;
    }

    public function __invoke(Throwable $exception) : ResponseInterface {
        $view_response_factory = $this->viewResponseFactory;
        return $view_response_factory(new ExceptionView($this->streamFactory, $exception))
            ->withStatus($exception instanceof HttpException ? $exception->getCode() : Http::INTERNAL_SERVER_ERROR);
    }

    /** @var ViewResponseFactoryInterface */
    private $viewResponseFactory;
    /** @var StreamFactoryInterface */
    private $streamFactory;
}