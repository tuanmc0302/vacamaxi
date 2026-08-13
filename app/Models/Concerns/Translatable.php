<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\App;

trait Translatable
{
    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (isset($this->translatable) && is_array($this->translatable) && in_array($key, $this->translatable)) {
            $locale = App::getLocale();
            if ($locale === 'en') {
                $enKey = $key . '_en';
                if (array_key_exists($enKey, $this->attributes) && !empty($this->attributes[$enKey])) {
                    return parent::getAttribute($enKey);
                }
            }
        }

        return parent::getAttribute($key);
    }
}
