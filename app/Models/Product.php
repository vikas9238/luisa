<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'image',
        'descriptions',
        'created_at',
        'updated_at',
    ];

    public function species()
    {
        return $this->belongsTo('App\Models\Species', 'species_id');
    }

    public function fetch()
    {
        $resultSets = self::get();
        return $resultSets;
    }

    public function addProduct($request)
    {
        $obj = new $this;
        $obj->name = $request->name;
        $obj->species_id = $request->species;
        $obj->price = $request->price;
        $obj->descriptions = $request->descriptions;
        $obj->image = $request->image_file_name;
        $obj->save();
        return $obj;
    }

    public function updateProduct($id, $request)
    {
        $obj = self::find($id);
        $obj->name = $request->name;
        $obj->species_id = $request->species;
        $obj->product_type_id = $request->type;
        $obj->price = $request->price;
        $obj->descriptions = $request->descriptions;
        $obj->image = $request->image;
        $obj->save();
        return $obj;
    }

}
