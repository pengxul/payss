<?php

declare(strict_types=1);

namespace Pengxul\Payss\Contract;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Pengxul\Payss\Exception\ContainerException;
use Pengxul\Payss\Exception\InvalidParamsException;
use Pengxul\Payss\Exception\ServiceNotFoundException;
use Pengxul\Supports\Collection;

interface ProviderInterface
{
    /**
     * @return null|array|Collection|MessageInterface
     *
     * @throws ContainerException
     * @throws InvalidParamsException
     * @throws ServiceNotFoundException
     */
    public function pay(array $plugins, array $params);

    /**
     * @param array|string $order
     *
     * @return array|Collection
     */
    public function find($order);

    /**
     * @param array|string $order
     *
     * @return array|Collection|void
     */
    public function cancel($order);

    /**
     * @param array|string $order
     *
     * @return array|Collection|void
     */
    public function close($order);

    /**
     * @return array|Collection
     */
    public function refund(array $order);

    /**
     * @param null|array|ServerRequestInterface $contents
     */
    public function callback($contents = null, ?array $params = null): Collection;

    public function success(): ResponseInterface;
}
