<?php
declare(strict_types=1);

namespace App;

use App\Response\ExceptionResponseFactory;
use DI\ContainerBuilder;
use GuzzleHttp\Psr7\ServerRequest;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\ResponseFactory;
use Http\Factory\Guzzle\ServerRequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use Miklcct\ThinPhpApp\Response\ResponseSender;
use Miklcct\ThinPhpApp\Response\ResponseSenderInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Miklcct\ThinPhpApp\Exception\ExceptionErrorHandler;
use Miklcct\ThinPhpApp\Exception\ResponseFactoryExceptionHandler;
use Miklcct\ThinPhpApp\Response\ExceptionResponseFactoryInterface;
use Miklcct\ThinPhpApp\Response\ViewResponseFactory;
use Miklcct\ThinPhpApp\Response\ViewResponseFactoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use function DI\get;

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
                ExceptionResponseFactoryInterface::class => get(ExceptionResponseFactory::class),
                ViewResponseFactoryInterface::class => get(ViewResponseFactory::class),
                ResponseSenderInterface::class => get(ResponseSender::class),
            ]
        );
        $container = $builder->build();
    }
    return $container;
}

function get_request() : ServerRequestInterface {
    return ServerRequest::fromGlobals();
}

// set up error handler
set_error_handler(get_container()->get(ExceptionErrorHandler::class));
set_exception_handler(get_container()->get(ResponseFactoryExceptionHandler::class));


