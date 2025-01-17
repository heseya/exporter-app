<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Exceptions\ApiAuthenticationException;
use App\Exceptions\ApiAuthorizationException;
use App\Exceptions\ApiClientErrorException;
use App\Exceptions\ApiConnectionException;
use App\Exceptions\ApiServerErrorException;
use App\Models\Api;
use Illuminate\Http\Client\Response;

interface ApiServiceContract
{
    /**
     * @throws ApiServerErrorException
     * @throws ApiConnectionException
     * @throws ApiAuthenticationException
     * @throws ApiAuthorizationException
     * @throws ApiClientErrorException
     */
    public function get(
        Api $api,
        string $url,
        array $parameters,
        array $headers,
    ): Response;

    /**
     * @throws ApiServerErrorException
     * @throws ApiConnectionException
     * @throws ApiAuthenticationException
     * @throws ApiAuthorizationException
     * @throws ApiClientErrorException
     */
    public function post(
        Api $api,
        string $url,
        array $data,
        array $headers,
        bool $tryRefreshing,
    ): Response;

    /**
     * @throws ApiServerErrorException
     * @throws ApiConnectionException
     * @throws ApiAuthenticationException
     * @throws ApiAuthorizationException
     * @throws ApiClientErrorException
     */
    public function patch(
        Api $api,
        string $url,
        array $data,
        array $headers,
        bool $tryRefreshing,
    ): Response;

    /**
     * @throws ApiServerErrorException
     * @throws ApiConnectionException
     * @throws ApiAuthenticationException
     * @throws ApiAuthorizationException
     * @throws ApiClientErrorException
     */
    public function delete(
        Api $api,
        string $url,
        array $data,
        array $headers,
        bool $tryRefreshing,
    ): Response;
}
