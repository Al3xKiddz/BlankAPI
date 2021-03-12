<?php


namespace App\Action;


use App\Domain\User\Service\LivreUpdater;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LivreUpdateAction
{
    private $livreUpdater;

    public function __construct(LivreUpdater $livreUpdater)
    {
        $this->livreUpdater = $livreUpdater;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getQueryParams();
        // Invoke the Domain with inputs and retain the result
        $livreId = $this->livreUpdater->UpdateLivre($data);

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