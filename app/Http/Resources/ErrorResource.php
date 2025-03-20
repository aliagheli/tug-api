<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     schema="ErrorResource",
 *     title="Error Response",
 *     description="Standard error response format",
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Validation error"),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         example={"field_name": "Error message"}
 *     )
 * )
 */
class ErrorResource extends JsonResource
{
    public function __construct(
        private string $message,
        private int    $status,
        private array  $errors = [],
    ) {
        parent::__construct(null);
    }

    public function toArray($request): array
    {
        parent::toArray($request);

        return [
            'success' => false,
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }

    public function withResponse($request, $response): Response
    {
        $response->setStatusCode($this->status);
    }
}
