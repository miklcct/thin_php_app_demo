<?php
declare(strict_types=1);

namespace App\Controller;

use App\Middleware\DisallowFrame;
use App\View\HelloViewFactory;
use Miklcct\ThinPhpApp\Controller\Application;
use Miklcct\ThinPhpApp\Response\ViewResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function Miklcct\ThinPhpApp\Request\get_client_address;

class HelloApp extends Application {
    public function __construct(
        ViewResponseFactoryInterface $viewResponseFactory
        , HelloViewFactory $viewFactory
        , DisallowFrame $contentSecurityPolicy
    ) {
        $this->viewFactory = $viewFactory;
        $this->contentSecurityPolicy = $contentSecurityPolicy;
        $this->viewResponseFactory = $viewResponseFactory;
    }

    protected function run(ServerRequestInterface $request) : ResponseInterface {
        $response_factory = $this->viewResponseFactory;
        $view_factory = $this->viewFactory;
        return $response_factory($view_factory(get_client_address($request), $request->getUri()->__toString()));
    }

    protected function getMiddlewares() : array {
        return [$this->contentSecurityPolicy];
    }

    /** @var HelloViewFactory */
    private $viewFactory;
    /** @var DisallowFrame */
    private $contentSecurityPolicy;
    /** @var ViewResponseFactoryInterface */
    private $viewResponseFactory;
}