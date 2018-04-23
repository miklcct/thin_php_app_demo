<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\HelloView;
use Interop\Http\Factory\ResponseFactoryInterface;
use Miklcct\ThinPhpApp\Application;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function Miklcct\ThinPhpApp\Http\get_client_address;
use function Miklcct\ThinPhpApp\Http\get_url;

class HelloApp extends Application {
    public function __construct(ResponseFactoryInterface $responseFactory, HelloView $view) {
        $this->responseFactory = $responseFactory;
        $this->view = $view;
    }

    protected function run(ServerRequestInterface $request) : ResponseInterface {
        $this->view->ipAddress = get_client_address($request);
        $this->view->url = get_url($request);
        return $this->responseFactory->createResponse()->withBody($this->view->render());
    }

    /** @var ResponseFactoryInterface */
    private $responseFactory;
    /** @var HelloView */
    private $view;
}