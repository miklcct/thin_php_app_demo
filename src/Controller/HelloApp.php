<?php
declare(strict_types=1);

namespace App\Controller;

use App\Middleware\DisallowFrame;
use App\View\HelloViewFactory;
use Miklcct\ThinPhpApp\Request\ServerRequest;
use Miklcct\ThinPhpApp\Response\ViewResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Example application to serve from a PHP template
 */
class HelloApp extends Application {
    public function __construct(
        ViewResponseFactoryInterface $viewResponseFactory
        , HelloViewFactory $viewFactory
        , DisallowFrame $disallowFrame
    ) {
        parent::__construct($disallowFrame);
        $this->viewFactory = $viewFactory;
        $this->viewResponseFactory = $viewResponseFactory;
    }

    protected function run(ServerRequestInterface $request) : ResponseInterface {
        $response_factory = $this->viewResponseFactory;
        $view_factory = $this->viewFactory;
        return $response_factory(
            $view_factory((new ServerRequest($request))->getClientAddress(), $request->getUri()->__toString())
        );
    }

    /** @var HelloViewFactory */
    private $viewFactory;

    /** @var ViewResponseFactoryInterface */
    private $viewResponseFactory;
}