<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use DB;
use Excel;

class ItemController extends Controller
{
    public function importExport()
    {
        return view('importExport');
    }
    public function importExcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    if($value->checkeds == 'x'){
                        $checked = true;
                    } else {
                        $checked = false;
                    }
                    $insert[] = ['default_hour' => $value->default_hours, 'checked' => $checked];
                }
                if(!empty($insert)){
                    DB::table('items')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }
        return back();
    }
}
