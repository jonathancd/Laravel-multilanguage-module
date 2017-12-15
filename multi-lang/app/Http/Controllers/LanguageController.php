<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Language;
use App\Translation;

use Validator;

class LanguageController extends Controller
{

    public function index(){
        return view('languages.index');
    }

    public function create(){
        return view('languages.create');
    }

    public function store(Request $request){

        $this->validate($request,[
            "iso" => 'required|alpha',
            "name" => "required"
        ]);

        $language = new Language;
        $language->code = $request->iso;
        $language->name = $request->name;
        $language->active = 0;

        if($language->save()){
            return redirect('/panel')->with('status', "Language stored successfully.");
        }else{
            return redirect()->back()->with('status', "Error trying to store module.");
        }
    }

    public function edit($id){
        $language = Language::find($id);

        if($language){
            return view('languages.edit', ['language' => $language]);
        }else{
            return redirect()->back()->with('status', "Language not found.");
        }
    }


    public function update(Request $request, $id){

        $this->validate($request,[
            "iso" => "required|alpha",
            "name" => "required"
        ]);

        $language = Language::find($id);
        
        if($language){
            $language->code = $request->iso;
            $language->name = $request->name;

            if($language->save()){
                return redirect('/panel')->with('status', "Language updated successfully.");
            }else{
                return redirect()->back()->with('status', "Error trying to update language.");
            }
        }else{
            return redirect()->back()->with('status', "Language not found.");
        }
    }


    public function destroy(Request $request){

        $language = Language::find($request->id);

        if($language){

            $translations = Translation::where('id_language', $language->id)->get();
            foreach($translations as $translation){
                    $translation->delete();
            }

            $language->delete();

            return redirect()->back()->with('status', "Language delete successfully.");
        }else{
            return redirect()->back()->with('status', "Language not found.");
        }
    }


    public function activate(Request $request){
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

    	return redirect()->back()->with('status', "Actual language updated successfully.");
    }
}
