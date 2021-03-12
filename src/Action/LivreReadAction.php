<?php


namespace App\Action;


use App\Domain\User\Service\LivreReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LivreReadAction
{
    private $livreReader;

    public function __construct(LivreReader $livreReader)
    {
        $this->livreReader = $livreReader;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        //$data = (array)$request->getParsedBody();
        // Invoke the Domain with inputs and retain the result
        $livreId = $this->livreReader->readLivre();

        // Transform the result into the JSON representation
        $result = [
            'premier' => $livreId[0],
            'deuxieme' => $livreId[1],
            'optionnel' => $livreId[2]
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}