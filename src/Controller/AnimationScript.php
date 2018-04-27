<?php
declare(strict_types=1);

namespace App\Controller;

use App\Middleware\DisallowFrame;
use App\View\AnimationScriptFactory;
use Miklcct\ThinPhpApp\Response\ViewResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Example application to dynamically generate Javascript.
 */
class AnimationScript extends Application {
    public function __construct(
        DisallowFrame $disallowFrame
        , ViewResponseFactoryInterface $viewResponseFactory
        , AnimationScriptFactory $viewFactory
    ) {
        parent::__construct($disallowFrame);
        $this->viewResponseFactory = $viewResponseFactory;
        $this->viewFactory = $viewFactory;
    }

    protected function run(ServerRequestInterface $request) : ResponseInterface {
        $rf = $this->viewResponseFactory;
        $vf = $this->viewFactory;
        $interval = $request->getQueryParams()['interval'];
        return $rf($vf($interval === NULL ? 1000 : (int)$interval));
    }

    /** @var ViewResponseFactoryInterface */
    private $viewResponseFactory;
    /** @var AnimationScriptFactory */
    private $viewFactory;
}