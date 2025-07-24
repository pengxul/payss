<?php

declare(strict_types=1);

namespace Pengxul\Pays\Service;

use Pengxul\Pays\Contract\ConfigInterface;
use Pengxul\Pays\Contract\ServiceProviderInterface;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Pay;
use Pengxul\Supports\Config;

class ConfigServiceProvider implements ServiceProviderInterface
{
    private array $config = [
        'logger' => [
            'enable' => false,
            'file' => null,
            'identify' => 'yansongda.pay',
            'level' => 'debug',
            'type' => 'daily',
            'max_files' => 30,
        ],
        'http' => [
            'timeout' => 5.0,
            'connect_timeout' => 3.0,
            'headers' => [
                'User-Agent' => 'yansongda/pay-v3',
            ],
        ],
        'mode' => Pay::MODE_NORMAL,
    ];

    /**
     * @param mixed $data
     *
     * @throws ContainerException
     */
    public function register($data = null): void
    {
        $config = new Config(array_replace_recursive($this->config, $data ?? []));

        Pay::set(ConfigInterface::class, $config);
    }
}
