<?php
declare(strict_types=1);

namespace App\View;

use Miklcct\ThinPhpApp\View\PhpTemplate;

abstract class PhpXhtmlTemplate extends PhpTemplate {
    public function getContentType() : ?string {
        return 'application/xhtml+xml; charset=utf-8';
    }
}