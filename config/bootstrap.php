<?php
declare(strict_types=1);

use Cake\Core\Configure;
use Cake\Event\EventManager;
use NewRelic\Service\NewRelicServiceInterface;

// Load plugin configuration
Configure::load('NewRelic.newrelic', 'default', false);

// Register event listeners if NewRelic is enabled
if (Configure::read('NewRelic.enabled', true)) {
    $container = \Cake\Core\Container::getInstance();
    $newRelic = $container->get(NewRelicServiceInterface::class);

    if ($newRelic->isEnabled()) {
        // Set application name
        $appName = Configure::read('NewRelic.appName', 'CakePHP Application');
        $newRelic->setApplicationName($appName);

        // Configure parameter capture
        $captureParams = Configure::read('NewRelic.captureParams', true);
        $newRelic->setCaptureParams($captureParams);

        // Add event listeners for request lifecycle
        EventManager::instance()->on('Server.buildMiddleware', function ($event, $middleware) use ($newRelic) {
            $middleware->add(function ($request, $handler) use ($newRelic) {
                $newRelic->startTransaction($request->getPath());
                try {
                    $response = $handler->handle($request);
                    $newRelic->endTransaction();
                    return $response;
                } catch (\Throwable $e) {
                    $newRelic->recordException($e);
                    $newRelic->endTransaction();
                    throw $e;
                }
            });
        });
    }
} 