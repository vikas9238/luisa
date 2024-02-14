<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{

    public $table = 'species';

    public function addSpecies($request)
    {
        $obj = new $this;
        $obj->name = $request->name;
        $obj->image = $request->image_file_name;
        $obj->descriptions = $request->descriptions;
        $obj->save();
        return $obj;
    }

    public function updateSpecies($id, $request)
    {
        $obj = self::find($id);
        $obj->name = $request->course_name;
        $obj->image = $request->image_file_name;
        $obj->descriptions = $request->descriptions;
        $obj->save();
        return $obj;
    }

    public function fetch()
    {
        return self::get();
    }

    public function listSpeciesName()
    {
        return self::pluck('name', 'id')->toArray();
    }

}
