<?php

namespace App\Internet;

class InternetLoader implements LoaderInterface
{
    public function load()
    {
        sleep(4);

        return ['kittens', 'unicorns'];
    }
}
