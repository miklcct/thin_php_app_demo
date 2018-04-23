<?php
declare(strict_types=1);

namespace App\View;

use Interop\Http\Factory\StreamFactoryInterface;
use Miklcct\ThinPhpApp\View\PhpTemplate;

class HelloView extends PhpTemplate {
    public function __construct(StreamFactoryInterface $factory) {
        parent::__construct($factory);
    }

    public function getPathToTemplate() : string {
        return __DIR__ . '/../../template/hello.phtml';
    }

    /** @var string */
    public $ipAddress;
    /** @var string */
    public $url;
}