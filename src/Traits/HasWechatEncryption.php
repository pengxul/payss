<?php

declare(strict_types=1);

namespace Pengxul\Pays\Traits;

use Pengxul\Pays\Exception\ContainerException;
use Pengxul\Pays\Exception\Exception;
use Pengxul\Pays\Exception\InvalidConfigException;
use Pengxul\Pays\Exception\InvalidParamsException;
use Pengxul\Pays\Exception\InvalidResponseException;
use Pengxul\Pays\Exception\ServiceNotFoundException;

use function Pengxul\Pays\get_wechat_config;
use function Pengxul\Pays\reload_wechat_public_certs;

trait HasWechatEncryption
{
    /**
     * @throws ContainerException
     * @throws InvalidConfigException
     * @throws InvalidParamsException
     * @throws InvalidResponseException
     * @throws ServiceNotFoundException
     */
    public function loadSerialNo(array $params): array
    {
        $config = get_wechat_config($params);

        if (empty($config['wechat_public_cert_path'])) {
            reload_wechat_public_certs($params);

            $config = get_wechat_config($params);
        }

        if (empty($params['_serial_no'])) {
            mt_srand();
            $params['_serial_no'] = strval(array_rand($config['wechat_public_cert_path']));
        }

        return $params;
    }

    /**
     * @throws ContainerException
     * @throws InvalidParamsException
     * @throws ServiceNotFoundException
     */
    public function getPublicKey(array $params, string $serialNo): string
    {
        $config = get_wechat_config($params);

        $publicKey = $config['wechat_public_cert_path'][$serialNo] ?? null;

        if (empty($publicKey)) {
            throw new InvalidParamsException(Exception::WECHAT_SERIAL_NO_NOT_FOUND, 'Wechat serial no not found: '.$serialNo);
        }

        return $publicKey;
    }
}
