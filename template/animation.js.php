<?php
declare(strict_types=1);
use App\View\AnimationScript;
use function Miklcct\ThinPhpApp\Escaper\json;
/** @var AnimationScript $this */
?>

function change() {
    var element = document.getElementById("animation");
    if(element.getAttribute("fill") === "black") {
        element.setAttribute("fill", "red");
    } else {
        element.setAttribute("fill", "black");
    }
    setTimeout(change, <?= json($this->getBlinkInterval()) ?>);
}
change();
