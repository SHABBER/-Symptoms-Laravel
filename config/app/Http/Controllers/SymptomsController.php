<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomsController extends Controller
{
    /**
     * The index function retrieves a list of symptoms from the database, groups them alphabetically by
     * the first letter of their name, and passes the grouped symptoms to the view.
     * 
     * @author Jeevan
     * 
     * @return a view called 'symptoms.index' and passing the variable 'groupedSymptoms' to the view.
     */
    public function index() {

        $symptoms = Symptom::orderBy('name')->get();

        /*It is grouping the symptoms retrieved from the database alphabetically by the
        first letter of their name. */
        $groupedSymptoms = $symptoms->groupBy(function ($symptom) {
            return strtoupper(substr($symptom->name, 0, 1));
        });

        return view('symptoms.index', compact('groupedSymptoms'));
    }

    /**
     * The function saves symptoms from a request into the database and returns an array of newly
     * created symptom names.
     * 
     * @author Jeevan
     * 
     * @param Request request The `` parameter is an instance of the `Request` class, which is
     * typically used to retrieve data from the HTTP request made to the server. In this case, it is
     * used to retrieve the value of the `symptoms` parameter from the request.
     * 
     * @return an array of symptom names that were recently created or already existed in the database.
     */
    public function save(Request $request) {
        //seprate request by comma and remove space if any before keyword
        $symptoms = array_map('trim', explode(',', $request->symptoms));
        $symptomDataArr = [];
        foreach($symptoms as $symptom)
        {
            $symptomData = Symptom::firstOrCreate(['name' => $symptom]);
            if($symptomData->wasRecentlyCreated){
                $symptomDataArr[] = $symptomData->name;
            }
        }
        return $symptomDataArr;
    }
}
