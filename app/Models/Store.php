<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Shetabit\Visitor\Traits\Visitable;

class Store extends Model
{
    use Visitable;

    protected $fillable = [
        'name',
        'email',
        'store_theme',
        'domains',
        'enable_storelink',
        'enable_subdomain',
        'subdomain',
        'enable_domain',
        'content',
        'item_variable',
        'about',
        'tagline',
        'slug',
        'lang',
        'storejs',
        'currency',
        'currency_code',
        'currency_symbol_position',
        'currency_symbol_space',
        'whatsapp',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'google_analytic',
        'facebook_pixel',
        'footer_note',
        'enable_shipping',
        'address',
        'city',
        'state',
        'zipcode',
        'country',
        'logo',
        'invoice_logo',
        'is_stripe_enabled',
        'stripe_key',
        'stripe_secret',
        'is_paypal_enabled',
        'paypal_mode',
        'paypal_client_id',
        'paypal_secret_key',
        'mail_driver',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
        'mail_from_name',
        'is_active',
        'created_by',
        'enable_whatsapp',
        'whatsapp_number',
        'enable_telegram',
        'telegrambot',
        'telegramchatid',
        'custom_field_title_1',
        'custom_field_title_2',
        'custom_field_title_3',
        'custom_field_title_4',
    ];

    public static function create($data)
    {
        $domain = parse_url(config('app.url'))['host'];
        $obj          = new Utility();
        $table        = with(new Store)->getTable();
        $data['slug'] = $obj->createSlug($table, $data['name']);
        $data['subdomain'] = $data['slug'] . '.' . $domain;
        $store        = static::query()->create($data);

        return $store;
    }

    public function currentLanguage()
    {
        return $this->lang;
    }

    public function store_user()
    {
        return $this->hasOne(UserStore::class, 'store_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(ProductCategorie::class, 'id', 'id');
    }

    public function link()
    {
        if ($this->enable_domain == 'on') {
            return $this->domains . '/store';
        }
        return $this->subdomain . '/store';
    }
}
