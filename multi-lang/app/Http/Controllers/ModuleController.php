<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Module;
use App\Translation;

use Validator;

class ModuleController extends Controller
{

	public function index(){

	}


	public function create(){
		return view('modules.create');
	}


	public function store(Request $request){
		$this->validate($request,[
    		"name" => "required"
    	]);

		$module = new Module;
		$module->name = $request->name;

    	if($module->save()){
    		return redirect('/panel')->with('status', "Module stored successfully.");
    	}else{
    		return redirect()->back()->with('status', "Error trying to store module.");
    	}
	}


	public function edit($id){
		$module = Module::find($id);

		if($module){
			return view('modules.edit', ['module' => $module]);
		}else{
			return redirect()->back()->with('status', "Module not found.");
		}
	}



	public function update(Request $request, $id){

		$this->validate($request,[
    		"name" => "required"
    	]);

    	$module = Module::find($id);

    	if($module){
    		$module->name = $request->name;
    		$module->save();
    		
    		return redirect('/panel')->with('status', "Module updated successfully.");
    	}else{
    		return redirect()->back()->with('status', "Module not found.");
    	}
	}



	public function show($id){
		
		$module = Module::find($id);

		if($module){
			$items = Item::where('id_module',$module->id)->get();
			foreach($items as $item){
				$item->translation = Translation::where('id_item',$item->id)->get();
			}
			
			return view('modules.show', ['module' => $module, 'items' => $items]);
		}else{
			return redirect('/panel')->with('status', "Module not found.");
		}
	}



    public function destroy(Request $request){

    	$module = Module::find($request->id);

    	if($module){
    		$items = Item::where('id_module', $module->id)->get();

    		foreach($items as $item){
    			$translations = Translation::where('id_item', $item->id)->get();
    			foreach($translations as $translation){
	    			$translation->delete();
	    		}
    		}

			$module->delete();

			return redirect()->back()->with('status', "Module delete successfully.");
    	}else{
    		return redirect()->back()->with('status', "Module not found.");
    	}
    }
}
