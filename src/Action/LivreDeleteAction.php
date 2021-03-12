<?php


namespace App\Action;

use App\Domain\User\Service\LivreDeleter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LivreDeleteAction
{
    private $livreDeleter;

    public function __construct(LivreDeleter $livreDeleter)
    {
        $this->livreDeleter = $livreDeleter;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getQueryParams();
        // Invoke the Domain with inputs and retain the result
        $livreId = $this->livreDeleter->deleteLivre($data);

        // Transform the result into the JSON representation
        $result = [
            'livre_id' => $livreId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}