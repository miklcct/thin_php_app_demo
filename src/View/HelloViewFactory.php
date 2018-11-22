<?php
declare(strict_types=1);

namespace App\View;

use Psr\Http\Message\StreamFactoryInterface;
use Miklcct\ThinPhpApp\View\View;

class HelloViewFactory {
    public function __construct(StreamFactoryInterface $factory) {
        $this->factory = $factory;
    }

    public function __invoke(string $ip_address, string $url) : View {
        return new HelloView($this->factory, $ip_address, $url);
    }

    /**
     * @var StreamFactoryInterface
     */
    private $factory;
}