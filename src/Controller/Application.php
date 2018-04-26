<?php
declare(strict_types=1);

namespace App\Controller;

use App\Middleware\DisallowFrame;
use Miklcct\ThinPhpApp\Controller\Application as Base;

abstract class Application extends Base {

    public function __construct(DisallowFrame $disallowFrame) {
        $this->disallowFrame = $disallowFrame;
    }

    protected function getMiddlewares() : array {
        return [$this->disallowFrame]; // this is a global middleware
    }

    /** @var DisallowFrame */
    protected $disallowFrame;
}