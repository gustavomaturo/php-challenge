<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Person;
use App\Models\Phone;

use EntityManager;

class PeopleController extends Controller
{
    public function get(Request $request) {
        return response()->json(['success' => true]);
    }
    
    public function create(Request $request) {
        libxml_use_internal_errors(true); 
        $people = simplexml_load_string(File::get($request->file('file')->path()));
        $code = 400;
        
        if($people) {
            foreach($people as $person) {
                
                $personModel = new Person((int)$person->personid, $person->personname);

                foreach((array)$person->phones->phone as $number) {
                    $personModel->addPhone(new Phone($number));
                }
                
                EntityManager::persist($personModel);
                EntityManager::flush();
                
            }
            $code = 200;
        }
        return response()->json(['success' => false], $code);
    }
}
