<?php
declare(strict_types=1);

namespace App\View;

use Interop\Http\Factory\StreamFactoryInterface;

class HelloViewFactory {
    public function __construct(StreamFactoryInterface $factory) {
        $this->factory = $factory;
    }

    public function make(string $ip_address, string $url) {
        return new HelloView($this->factory, $ip_address, $url);
    }

    /**
     * @var StreamFactoryInterface
     */
    private $factory;
}