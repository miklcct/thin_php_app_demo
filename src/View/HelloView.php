<?php
declare(strict_types=1);

namespace App\View;

use Interop\Http\Factory\StreamFactoryInterface;
use Miklcct\ThinPhpApp\View\PhpTemplate;

class HelloView extends PhpTemplate {
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