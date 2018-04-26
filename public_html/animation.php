<?php
declare(strict_types=1);

use App\Controller\Animation;
use function App\get_container;
use function App\get_request;
use function Http\Response\send;

require __DIR__ . '/../src/initialise.php';

send(get_container()->get(Animation::class)->handle(get_request()));