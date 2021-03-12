<?php


namespace App\Action;


use App\Domain\User\Service\LivreReader1;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LivreRead1Action
{
    private $livreReader1;

    public function __construct(LivreReader1 $livreReader1)
    {
        $this->livreReader1 = $livreReader1;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getQueryParams();
        // Invoke the Domain with inputs and retain the result
        $livreId = $this->livreReader1->readLivre($data);

        // Transform the result into the JSON representation
        $result = [
            'livreId' => $livreId['id'],
            'titre' => $livreId['titre'],
            'genreId' => $livreId['genreId']
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}