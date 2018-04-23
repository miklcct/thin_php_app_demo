<?php
declare(strict_types=1);

namespace App\Controller;

use App\Middleware\XhtmlHeader;
use App\View\HelloViewFactory;
use Interop\Http\Factory\ResponseFactoryInterface;
use Miklcct\ThinPhpApp\Application;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function Miklcct\ThinPhpApp\Http\get_client_address;
use function Miklcct\ThinPhpApp\Http\get_url;

class HelloApp extends Application {
    public function __construct(
        ResponseFactoryInterface $responseFactory
        , HelloViewFactory $viewFactory
        , XhtmlHeader $xhtmlHeader
    ) {
        $this->responseFactory = $responseFactory;
        $this->viewFactory = $viewFactory;
        $this->xhtmlHeader = $xhtmlHeader;
    }

    protected function run(ServerRequestInterface $request) : ResponseInterface {
        return $this
            ->responseFactory
            ->createResponse()
            ->withBody($this->viewFactory->make(get_client_address($request), get_url($request))->render());
    }

    protected function getMiddlewares() : array {
        return [$this->xhtmlHeader];
    }

    /** @var ResponseFactoryInterface */
    private $responseFactory;
    /** @var HelloViewFactory */
    private $viewFactory;
    /** @var XhtmlHeader */
    private $xhtmlHeader;
}