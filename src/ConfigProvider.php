<?php

declare(strict_types=1);

namespace Goranzilla\Mezzio\Logger;

use Goranzilla\Mezzio\Logger\Listener\LoggerListenerFactory;
use Goranzilla\Mezzio\Logger\Listener\LoggingListenerDelegatorFactory;
use Laminas\Stratigility\Middleware\ErrorHandler;
use Psr\Log\LoggerInterface;

class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories'  => [
                LoggerInterface::class => LoggerListenerFactory::class,
            ],
            'delegators' => [
                ErrorHandler::class => [
                    LoggingListenerDelegatorFactory::class,
                ],
            ],
        ];
    }
}
