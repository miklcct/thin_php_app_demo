<?php
declare(strict_types=1);

namespace App\View;

use Interop\Http\Factory\StreamFactoryInterface;

class AnimationScriptFactory {
    public function __construct(StreamFactoryInterface $streamFactory) {
        $this->streamFactory = $streamFactory;
    }

    public function __invoke(int $blinkInterval, string $colour = 'red') : AnimationScript {
        return new AnimationScript($this->streamFactory, $blinkInterval, $colour);
    }

    /** @var StreamFactoryInterface */
    private $streamFactory;
}