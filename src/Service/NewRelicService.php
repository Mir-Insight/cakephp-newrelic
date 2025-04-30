<?php
declare(strict_types=1);

namespace NewRelic\Service;

use Cake\Log\Log;
use InvalidArgumentException;

class NewRelicService implements NewRelicServiceInterface
{
    private ?string $currentTransactionName = null;

    public function isEnabled(): bool
    {
        return extension_loaded('newrelic');
    }

    public function setApplicationName(string $name): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_set_appname($name);
    }

    public function startTransaction(?string $name = null): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_start_transaction(NEW_RELIC_APP_NAME);

        if ($name !== null) {
            $this->currentTransactionName = $name;
            newrelic_name_transaction($this->currentTransactionName);
        }
    }

    public function endTransaction(bool $ignore = false): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_end_transaction($ignore);
    }

    public function ignoreTransaction(): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_ignore_transaction();
    }

    public function ignoreApdex(): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_ignore_apdex();
    }

    public function setCaptureParams(bool $enabled): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_capture_params($enabled);
    }

    public function addCustomParameter(string $key, mixed $value): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        if (!is_scalar($value)) {
            $value = json_encode($value);
        }

        newrelic_add_custom_parameter($key, (string)$value);
    }

    public function addCustomMetric(string $key, float $value): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_custom_metric($key, $value);
    }

    public function addCustomTracer(string $method): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_add_custom_tracer($method);
    }

    public function recordException(\Throwable $exception): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        try {
            newrelic_notice_error(null, $exception);
        } catch (\Throwable $e) {
            Log::error('Failed to record exception in NewRelic: ' . $e->getMessage());
        }
    }

    public function setUserAttributes(string $user, string $account, string $product): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        newrelic_set_user_attributes($user, $account, $product);
    }
} 