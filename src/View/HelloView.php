<?php
declare(strict_types=1);

namespace App\View;

use Psr\Http\Message\StreamFactoryInterface;

class HelloView extends PhpXhtmlTemplate {
    public function __construct(StreamFactoryInterface $factory, string $ipAddress, string $url) {
        parent::__construct($factory);
        $this->ipAddress = $ipAddress;
        $this->url = $url;
    }

    public function getPathToTemplate() : string {
        return __DIR__ . '/../../template/hello.phtml';
    }

    /** @var string */
    public $ipAddress;
    /** @var string */
    public $url;
}