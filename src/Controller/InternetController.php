<?php

namespace App\Controller;

use App\Internet\CachedInternetLoader;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Internet\InternetLoader;

class InternetController
{
    public function __invoke(CachedInternetLoader $internetLoader)
    {
        $internet = $internetLoader->load();

        return new JsonResponse($internet);
    }
}
