# CakePHP NewRelic Plugin

A CakePHP 5 plugin for NewRelic integration that provides automatic transaction tracking, error reporting, and custom metrics.

## Requirements

- PHP 8.1 or higher
- CakePHP 5.0 or higher
- NewRelic PHP extension

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

```bash
composer require mir-insight/cakephp-newrelic
```

## Configuration

1. Load the plugin in your `config/bootstrap.php`:

```php
// Load the plugin
$app->addPlugin('NewRelic');
```

2. Configure the plugin in your `config/app.php` or create a new file `config/newrelic.php`:

```php
return [
    'NewRelic' => [
        'enabled' => true,
        'appName' => 'My Application',
        'captureParams' => true,
        'customParameters' => [
            'environment' => 'production',
            'version' => '1.0.0',
        ],
    ],
];
```

## Usage

The plugin automatically integrates with your CakePHP application and provides the following features:

1. Automatic transaction tracking for all HTTP requests
2. Exception tracking
3. Custom parameter and metric tracking
4. Custom tracer methods

### Using the NewRelic Service

You can access the NewRelic service in your controllers, components, or other services:

```php
use NewRelic\Service\NewRelicServiceInterface;

class MyController extends AppController
{
    public function index(NewRelicServiceInterface $newRelic)
    {
        // Add custom parameters
        $newRelic->addCustomParameter('user_id', $this->Auth->user('id'));
        
        // Add custom metrics
        $newRelic->addCustomMetric('custom/feature_usage', 1.0);
        
        // Record exceptions
        try {
            // Your code here
        } catch (\Throwable $e) {
            $newRelic->recordException($e);
            throw $e;
        }
    }
}
```

### Custom Tracers

You can add custom tracer methods in your configuration:

```php
return [
    'NewRelic' => [
        'customTracers' => [
            'App\Model\Table\UsersTable::findActive',
            'App\Service\CacheService::get',
        ],
    ],
];
```

## Features

- Automatic transaction tracking
- Exception tracking
- Custom parameter tracking
- Custom metric tracking
- Custom tracer methods
- Middleware integration
- Service container integration
- Configuration options

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
