<?php

use App\Helpers\ActiveStore;

function store()
{
    return app(ActiveStore::class)->getStore();
}
