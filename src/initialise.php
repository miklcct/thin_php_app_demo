<?php
declare(strict_types=1);

namespace App;

use App\View\ExceptionView;
use DI\ContainerBuilder;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\ResponseFactory;
use Http\Factory\Guzzle\ServerRequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use Interop\Http\Factory\RequestFactoryInterface;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Factory\ServerRequestFactoryInterface;
use Interop\Http\Factory\StreamFactoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use function DI\get;
use function Miklcct\ThinPhpApp\get_exception_handler_for_view;

// require the autoloader
require __DIR__ . '/../vendor/autoload.php';

function get_container() : ContainerInterface {
    static $container;
    if ($container === NULL) {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(
            [
                RequestFactoryInterface::class => get(RequestFactory::class),
                ServerRequestFactoryInterface::class => get(ServerRequestFactory::class),
                ResponseFactoryInterface::class => get(ResponseFactory::class),
                StreamFactoryInterface::class => get(StreamFactory::class),
            ]
        );
        $container = $builder->build();
    }
    return $container;
}

function get_request() : ServerRequestInterface {
    return get_container()->get(ServerRequestFactoryInterface::class)->createServerRequestFromArray($_SERVER);
}

// set up error handler
set_error_handler('Miklcct\ThinPhpApp\exception_error_handler');
set_exception_handler(
    get_exception_handler_for_view(
        get_container()->get(ExceptionView::class)
        , get_container()->get(ResponseFactoryInterface::class)
    )
);


