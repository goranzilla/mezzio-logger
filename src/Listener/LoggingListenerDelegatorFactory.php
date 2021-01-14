<?php

declare(strict_types=1);

namespace Goranzilla\Mezzio\Logger\Listener;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;
use Laminas\Stratigility\Middleware\ErrorHandler;
use Psr\Log\LoggerInterface;

class LoggingListenerDelegatorFactory implements DelegatorFactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        $listener = $container->get(LoggerInterface::class);
        /** @var ErrorHandler $errorHandler */
        $errorHandler = $callback();
        $errorHandler->attachListener($listener);

        return $errorHandler;
    }
}
