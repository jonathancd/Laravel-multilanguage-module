<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Language;

use Validator;

class LanguageController extends Controller
{
    public function update(Request $request){
		$this->validate($request,[
    		"language" => "required"
    	]);

		foreach(Language::all() as $lang){
			$lang->active = 0;
			$lang->save();
		}

    	$language = Language::find($request->language);
    	$language->active = 1;
    	$language->save();

    	return redirect()->back()->with('status', "Language updated successfully.");
    }
}
