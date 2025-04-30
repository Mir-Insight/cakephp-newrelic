<?php
declare(strict_types=1);

namespace NewRelic;

use Cake\Core\BasePlugin;
use Cake\Core\ContainerInterface;
use Cake\Core\PluginApplicationInterface;
use Cake\Event\EventManager;
use NewRelic\Service\NewRelicService;
use NewRelic\Service\NewRelicServiceInterface;

class Plugin extends BasePlugin
{
    /**
     * Load all the plugin configuration and bootstrap logic.
     */
    public function bootstrap(PluginApplicationInterface $app): void
    {
        // Register the NewRelic service in the container
        $app->getContainer()->add(NewRelicServiceInterface::class, NewRelicService::class);
    }

    /**
     * Register container services.
     */
    public function services(ContainerInterface $container): void
    {
        $container->add(NewRelicServiceInterface::class, NewRelicService::class);
    }
} 