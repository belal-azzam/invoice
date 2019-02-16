<?php
namespace App\Repositories;
use App\Models\Client;
use App\Models\Invoice;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface {
    function __construct(Client $client)
    {
        parent::__construct($client);
    }
}