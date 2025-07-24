<?php

declare(strict_types=1);

namespace Pengxul\Pays\Service;

use Pengxul\Pays\Contract\ConfigInterface;
use Pengxul\Pays\Contract\LoggerInterface;
use Pengxul\Pays\Contract\ServiceProviderInterface;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Pay;
use Pengxul\Supports\Logger;

class LoggerServiceProvider implements ServiceProviderInterface
{
    /**
     * @param mixed $data
     *
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    public function register($data = null): void
    {
        /* @var ConfigInterface $config */
        $config = Pay::get(ConfigInterface::class);

        if (class_exists(\Monolog\Logger::class) && true === $config->get('logger.enable', false)) {
            $logger = new Logger(array_merge(
                ['identify' => 'yansongda.pay'],
                $config->get('logger', [])
            ));

            Pay::set(LoggerInterface::class, $logger);
        }
    }
}
