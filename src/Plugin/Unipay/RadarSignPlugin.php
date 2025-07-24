<?php

declare(strict_types=1);

namespace Pengxul\Pays\Plugin\Unipay;

use Closure;
use GuzzleHttp\Psr7\Utils;
use Pengxul\Pays\Contract\PluginInterface;
use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\InvalidConfigException;
use Pengxul\Pays\Exception\ServiceNotFoundException;
use Pengxul\Pays\Logger;
use Pengxul\Pays\Rocket;
use Pengxul\Pays\Traits\GetUnipayCerts;
use Pengxul\Supports\Collection;

use function Pengxul\Pays\get_unipay_config;

class RadarSignPlugin implements PluginInterface
{
    use GetUnipayCerts;

    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     * @throws InvalidConfigException
     */
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[unipay][PreparePlugin] 插件开始装载', ['rocket' => $rocket]);

        $this->sign($rocket);

        $this->reRadar($rocket);

        Logger::info('[unipay][PreparePlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }

    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws ServiceNotFoundException
     */
    protected function sign(Rocket $rocket): void
    {
        $payload = $rocket->getPayload()->filter(fn ($v, $k) => 'signature' != $k);
        $config = $this->getConfig($rocket->getParams());

        $rocket->mergePayload([
            'signature' => $this->getSignature($config['certs']['pkey'] ?? '', $payload),
        ]);
    }

    protected function reRadar(Rocket $rocket): void
    {
        $body = $this->getBody($rocket->getPayload());
        $radar = $rocket->getRadar();

        if (!empty($body) && !empty($radar)) {
            $radar = $radar->withBody(Utils::streamFor($body));

            $rocket->setRadar($radar);
        }
    }

    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws ServiceNotFoundException
     */
    protected function getConfig(array $params): array
    {
        $config = get_unipay_config($params);

        if (empty($config['certs']['pkey'])) {
            $this->getCertId($params['_config'] ?? 'default', $config);

            $config = get_unipay_config($params);
        }

        return $config;
    }

    protected function getSignature(string $pkey, Collection $payload): string
    {
        $content = $payload->sortKeys()->toString();

        openssl_sign(hash('sha256', $content), $sign, $pkey, 'sha256');

        return base64_encode($sign);
    }

    protected function getBody(Collection $payload): string
    {
        return $payload->query();
    }
}
