<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Smart ERP API',
    description: 'API documentation for Smart ERP system'
)]
#[OA\Server(
    url: 'http://127.0.0.1:8000',
    description: 'Local API Server'
)]
class SwaggerInfo
{
}