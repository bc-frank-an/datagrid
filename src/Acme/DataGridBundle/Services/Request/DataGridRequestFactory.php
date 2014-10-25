<?php


namespace Acme\DataGridBundle\Services\Request;

use Symfony\Component\HttpFoundation\Request;

class DataGridRequestFactory {

    public static function getInstance(Request $request)
    {
        if ($request->getMethod() == "GET") {
            return new DataGridGetRequest($request);
        } else if ($request->getMethod() == "POST") {
            return new DataGridPostRequest($request);
        }
        return null;

    }
} 