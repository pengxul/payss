<?php

declare(strict_types=1);

namespace Pengxul\Payss;

use Pengxul\Payss\Contract\ConfigInterface;
use Pengxul\Payss\Contract\LoggerInterface;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\InvalidConfigException;
use Pengxul\Payss\Exception\ServiceNotFoundException;

/**
 * @method static void emergency($message, array $context = [])
 * @method static void alert($message, array $context = [])
 * @method static void critical($message, array $context = [])
 * @method static void error($message, array $context = [])
 * @method static void warning($message, array $context = [])
 * @method static void notice($message, array $context = [])
 * @method static void info($message, array $context = [])
 * @method static void debug($message, array $context = [])
 * @method static void log($message, array $context = [])
 */
class Logger
{
    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     * @throws InvalidConfigException
     */
    public static function __callStatic(string $method, array $args): void
    {
        if (!Pay::hasContainer() || !Pay::has(LoggerInterface::class)
            || false === Pay::get(ConfigInterface::class)->get('logger.enable', false)) {
            return;
        }

        $class = Pay::get(LoggerInterface::class);

        if ($class instanceof \Psr\Log\LoggerInterface || $class instanceof \Pengxul\Supports\Logger) {
            $class->{$method}(...$args);

            return;
        }

        throw new InvalidConfigException(Exception\Exception::LOGGER_CONFIG_ERROR);
    }
}
