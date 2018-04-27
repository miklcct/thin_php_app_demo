<?php
declare(strict_types=1);
use App\View\AnimationScript;
use function Miklcct\ThinPhpApp\Escaper\json;
/** @var AnimationScript $this */
?>
'use strict';

function change() {
    change.element.setAttribute(
        'fill'
        , change.element.getAttribute('fill') === change.originalColour
            ? <?= json($this->getColour()) ?>
            : change.originalColour
    );
    setTimeout(change, <?= json($this->getBlinkInterval()) ?>);
}

change.element = document.getElementById('shape');
change.originalColour = change.element.getAttribute('fill');
change();
