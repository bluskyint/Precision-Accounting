<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait AirtableTrait
{

    protected function insertNewRow($tableId, $data){
        // Airtable API key and base ID
        $apiKey  = 'patM4pusO4P74srnS.2b34e96f3cdc5cdbe546088844dabf062e8ac963d8c2c1e86317c64d6d53fbc0';
        $baseId  = 'appX4RdWKnV1JQaqh';

        // URL for the Airtable API endpoint
        $url = "https://api.airtable.com/v0/{$baseId}/{$tableId}";


        // Send the POST request to create a new record
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$apiKey}",
            'Content-Type'  => 'application/json',
        ])->post($url, $data);
            // return $response;
        // Check if the request was successful
        if ($response->successful()) {
            // Record created successfully
            return view('submission');
        } else {
            // Handle the error
            return response()->json(['error' => 'Failed to create record'], $response->status());
        }
    }

}
