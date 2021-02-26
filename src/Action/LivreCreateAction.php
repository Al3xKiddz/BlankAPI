<?php


namespace App\Action;

use App\Domain\User\Service\LivreCreator;
use App\Domain\User\Service\UserCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LivreCreateAction
{
    private $livreCreator;

    public function __construct(LivreCreator $livreCreator)
    {
        $this->livreCreator = $livreCreator;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();
        // Invoke the Domain with inputs and retain the result
        $livreId = $this->livreCreator->createLivre($data);

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