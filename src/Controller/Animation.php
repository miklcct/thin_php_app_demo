<?php
declare(strict_types=1);

namespace App\Controller;

use App\Middleware\DisallowFrame;
use Interop\Http\Factory\StreamFactoryInterface;
use Miklcct\ThinPhpApp\Response\ViewResponseFactoryInterface;
use Miklcct\ThinPhpApp\View\StaticTemplate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Animation extends Application {
    public function __construct(
        DisallowFrame $disallowFrame
        , ViewResponseFactoryInterface $viewResponseFactory
        , StreamFactoryInterface $streamFactory
    ) {
        parent::__construct($disallowFrame);
        $this->viewResponseFactory = $viewResponseFactory;
        $this->streamFactory = $streamFactory;
    }

    protected function run(ServerRequestInterface $request) : ResponseInterface {
        $sf = $this->streamFactory;
        return ($this->viewResponseFactory)(
            new class($sf) extends StaticTemplate {
                protected function getPathToTemplate() : string {
                    return __DIR__ . '/../../template/animation.xhtml';
                }

                public function getContentType() : ?string {
                    return 'application/xhtml+xml; charset=utf-8';
                }
            }
        );
    }

    /** @var ViewResponseFactoryInterface */
    private $viewResponseFactory;
    /** @var StreamFactoryInterface */
    private $streamFactory;
}