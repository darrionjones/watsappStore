<?php

namespace App\Helpers;

use App\Models\Store;
use Exception;

class ActiveStore
{
    public ?Store $store = null;

    public $initialized = false;

    public function initialize($store): Store
    {
        if ($this->initialized) {
            return $this->store;
        }

        if (!is_object($store)) {
            $storeId = $store;
            $store = Store::find($storeId);
        }

        if (is_null($store)) {
            throw new Exception('Store could not be identified');
        }

        $this->store = $store;

        $this->initialized = true;

        return $store;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }
}
