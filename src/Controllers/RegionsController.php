<?php

namespace JaymesKat\UgandaGeography;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegionsController extends Controller
{
    //
    public function all(){
        echo 'All regions';
    }

    public function single($id){
        echo 'Region with id '.$id;
    }
}
