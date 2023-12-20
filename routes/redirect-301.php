<?php

use Illuminate\Support\Facades\Route;

$redirectLinks = [
	'resources' => 'our-resources'
];

Route::get('/{uri}', function (string $uri) use ($redirectLinks) {
    return redirect($redirectLinks[$uri]);
})->where('uri', implode('|', array_keys($redirectLinks)));
