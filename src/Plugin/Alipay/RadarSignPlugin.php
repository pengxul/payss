<?php

declare(strict_types=1);

namespace Pengxul\Payss\Plugin\Alipay;

use Closure;
use Pengxul\Payss\Contract\PluginInterface;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\Exception;
use Pengxul\Payss\Exception\InvalidConfigException;
use Pengxul\Payss\Exception\ServiceNotFoundException;
use Pengxul\Payss\Logger;
use Pengxul\Payss\Pay;
use Pengxul\Payss\Provider\Alipay;
use Pengxul\Payss\Request;
use Pengxul\Payss\Rocket;
use Pengxul\Supports\Collection;
use Pengxul\Supports\Str;

use function Pengxul\Payss\get_alipay_config;
use function Pengxul\Payss\get_private_cert;

class RadarSignPlugin implements PluginInterface
{
    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws ServiceNotFoundException
     */
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[alipay][RadarSignPlugin] 插件开始装载', ['rocket' => $rocket]);

        $this->sign($rocket);

        $this->reRadar($rocket);

        Logger::info('[alipay][RadarSignPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }

    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws ServiceNotFoundException
     */
    protected function sign(Rocket $rocket): void
    {
        $this->formatPayload($rocket);

        $sign = $this->getSign($rocket);

        $rocket->mergePayload(['sign' => $sign]);
    }

    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function reRadar(Rocket $rocket): void
    {
        $params = $rocket->getParams();

        $rocket->setRadar(new Request(
            $this->getMethod($params),
            $this->getUrl($params),
            $this->getHeaders(),
            $this->getBody($rocket->getPayload()),
        ));
    }

    protected function formatPayload(Rocket $rocket): void
    {
        $payload = $rocket->getPayload()->filter(fn ($v, $k) => '' !== $v && !is_null($v) && 'sign' != $k);

        $contents = array_filter($payload->get('biz_content', []), fn ($v, $k) => !Str::startsWith(strval($k), '_'), ARRAY_FILTER_USE_BOTH);

        $rocket->setPayload(
            $payload->merge(['biz_content' => json_encode($contents)])
        );
    }

    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws ServiceNotFoundException
     */
    protected function getSign(Rocket $rocket): string
    {
        $privateKey = $this->getPrivateKey($rocket->getParams());

        $content = $rocket->getPayload()->sortKeys()->toString();

        openssl_sign($content, $sign, $privateKey, OPENSSL_ALGO_SHA256);

        return base64_encode($sign);
    }

    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws ServiceNotFoundException
     */
    protected function getPrivateKey(array $params): string
    {
        $privateKey = get_alipay_config($params)['app_secret_cert'] ?? null;

        if (is_null($privateKey)) {
            throw new InvalidConfigException(Exception::ALIPAY_CONFIG_ERROR, 'Missing Alipay Config -- [app_secret_cert]');
        }

        return get_private_cert($privateKey);
    }

    protected function getMethod(array $params): string
    {
        return strtoupper($params['_method'] ?? 'POST');
    }

    /**
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    protected function getUrl(array $params): string
    {
        $config = get_alipay_config($params);

        return Alipay::URL[$config['mode'] ?? Pay::MODE_NORMAL];
    }

    protected function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
    }

    protected function getBody(Collection $payload): string
    {
        return $payload->query();
    }
}
