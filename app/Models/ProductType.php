<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\UTMHelper;

class ProductType extends Model
{

    const DOSE_FIRST = 1;
    const DOSE_SECOND = 2;
    const DOSE_BOOSTER = 3;
    const DOSE = [
        self::DOSE_FIRST => "First",
        self::DOSE_SECOND => "Second",
        self::DOSE_BOOSTER => "Booster",
    ];

    public $table = 'student_vaccinations';

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function vaccine()
    {
        return $this->belongsTo('App\Models\Vaccine', 'vaccine_id');
    }

    public function addVaccination($id, $request)
    {
        $obj = new $this;
        $obj->student_id = $id;
        $obj->vaccine_id = $request->vaccine;
        $obj->vaccination_date = UTMHelper::formatMysqlDateTime($request->vaccination_date);
        $obj->dose = $request->dose;
        $obj->save();
        return $obj;
    }

    public function fetchByStudent($id)
    {
        $resultSets = self::where('student_id', $id)->get();
        return $resultSets;
    }

}
