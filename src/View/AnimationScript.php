<?php
declare(strict_types=1);

namespace App\View;

use Interop\Http\Factory\StreamFactoryInterface;
use Miklcct\ThinPhpApp\View\PhpTemplate;

class AnimationScript extends PhpTemplate {
    public function __construct(StreamFactoryInterface $streamFactory, int $blinkInterval, string $colour) {
        parent::__construct($streamFactory);
        $this->blinkInterval = $blinkInterval;
        $this->colour = $colour;
    }

    protected function getPathToTemplate() : string {
        return __DIR__ . '/../../template/animation.js.php';
    }

    public function getContentType() : ?string {
        return 'text/javascript; charset=utf-8';
    }

    protected function getBlinkInterval() : int {
        return $this->blinkInterval;
    }

    protected function getColour() : string {
        return $this->colour;
    }

    /** @var int */
    private $blinkInterval;
    /** @var string */
    private $colour;
}
