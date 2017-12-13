<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Language;
use App\Module;
use App\Translation;

use Validator;

class TranslationController extends Controller
{

	public function create($id_module, $id_language){

		$module = Module::find($id_module);
		$language = Language::find($id_language);

		if($module && $language){
			return view('translations.create', ['module' => $module, 'language' => $language ]);
		}else{
			return redirect()->back()->with('status', "Module not found.");
		}
	}


	public function store(Request $request){

		$this->validate($request,[
			'item' => "required",
    		"translation" => "required"
    	]);

		$translation = new Translation;
		$translation->id_item = $request->item;
		$translation->id_language = $request->language;
		$translation->value = $request->translation;

		if($translation->save()){
			return redirect('/modules/'.$request->module)->with('status', "Translation stored successfully.");
		}else{
			return redirect()->back()->with('status', "Error trying to store translation.");
		}

	}


	public function edit($id_module, $id_translation){
		
		$translation = Translation::find($id_translation);

		if($translation){
			$module = Module::find($id_module);
			$language = Language::find($translation->id_language);

			if($module){
				return view("translations.edit",["translation" => $translation, 'module' => $module, 'language' => $language]);
			}else{
				return redirect()->back()->with('status', "Error trying to get translation.");
			}
		}else{
			return redirect()->back()->with('status', "Translation not found.");
		}
	}


	public function update(Request $request, $id){

		$this->validate($request,[
			'item' => "required",
    		"translation" => "required"
    	]);

		$translation = Translation::find($id);

		if($translation){
			$translation->id_item = $request->item;
			$translation->value = $request->translation;

			if($translation->save()){
				return redirect('/modules/'.$request->module)->with('status', "Translation updated successfully.");
			}else{
				return redirect()->back()->with('status', "Error trying to update translation.");
			}

		}else{
			return redirect()->back()->with('status', "Error trying to update translation.");
		}
	}


	public function destroy(Request $request){

		$translation = Translation::find($request->id);

		if($translation){
			if($translation->delete()){
				return redirect()->back()->with('status', "Translation deleted successfully.");
			}else{
				return redirect()->back()->with('status', "Error trying to delete translation.");
			}

		}else{
			return redirect()->back()->with('status', "Translation not found.");
		}
	}

}
