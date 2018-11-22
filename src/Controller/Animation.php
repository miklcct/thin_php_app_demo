<?php
declare(strict_types=1);

namespace App\Controller;

use App\Middleware\DisallowFrame;
use Psr\Http\Message\StreamFactoryInterface;
use Miklcct\ThinPhpApp\Response\ViewResponseFactoryInterface;
use Miklcct\ThinPhpApp\View\StaticTemplate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Example application to return a randomly chosen static page
 */
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
                    $page_list = glob(__DIR__ . '/../../template/animation/*.xhtml');
                    return $page_list[array_rand($page_list)];
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