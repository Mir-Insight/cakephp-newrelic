<?php
declare(strict_types=1);

namespace NewRelic\Service;

interface NewRelicServiceInterface
{
    /**
     * Check if NewRelic extension is loaded
     */
    public function isEnabled(): bool;

    /**
     * Set the application name
     */
    public function setApplicationName(string $name): void;

    /**
     * Start a new transaction
     */
    public function startTransaction(?string $name = null): void;

    /**
     * End the current transaction
     */
    public function endTransaction(bool $ignore = false): void;

    /**
     * Ignore the current transaction
     */
    public function ignoreTransaction(): void;

    /**
     * Ignore the current apdex
     */
    public function ignoreApdex(): void;

    /**
     * Enable/disable parameter capture
     */
    public function setCaptureParams(bool $enabled): void;

    /**
     * Add a custom parameter to the transaction
     */
    public function addCustomParameter(string $key, mixed $value): void;

    /**
     * Add a custom metric
     */
    public function addCustomMetric(string $key, float $value): void;

    /**
     * Add a custom tracer method
     */
    public function addCustomTracer(string $method): void;

    /**
     * Record an exception
     */
    public function recordException(\Throwable $exception): void;

    /**
     * Set user attributes
     */
    public function setUserAttributes(string $user, string $account, string $product): void;
} 