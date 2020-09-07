<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_photo','product_name','product_price','properties','product_id'];
    protected $casts = [
        'properties' => 'array'
    ];
    /**
     * @var mixed
     */
    private $product_photo;
    /**
     * @var mixed
     */
    private $product_name;
    /**
     * @var mixed
     */
    private $product_price;
    /**
     * @var mixed
     */
    private $properties;
    /**
     * @var mixed
     */
    private $product_id;

    public function getPropertiesAttribute($value)
   {
//        $this->attributes['properties'] = json_decode($value,true);
//
        return json_decode($value);
    }

    public function setPropertiesAttribute($value)
    {
        $properties = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $properties[] = $array_item;
            }
        }
        $this->attributes['properties'] = json_encode((array) $properties);
    }
}
