<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Module;
use App\Translation;

use Validator;

class ItemController extends Controller
{
    public function create($id){

    	$module = Module::find($id);

    	if($module){
			return view('items.create', ['module' => $module]);
    	}else{
    		return redirect()->back()->with('status', "Error trying to create item.");
    	}
	}


	public function store(Request $request){

		$this->validate($request,[
    		"name" => "required|alpha_dash",
    		"description" => "required"
    	]);

		$item = new Item;
		$item->id_module = $request->module;
		$item->name = $request->name;
		$item->description = $request->description;

    	if($item->save()){
    		return redirect('/modules/'.$item->id_module)->with('status', "Item stored successfully.");
    	}else{
    		return redirect()->back()->with('status', "Error trying to store item.");
    	}
	}


	public function edit($id){
		$item = Item::find($id);

		if($item){
			return view('items.edit', ['item' => $item]);
		}else{

			return redirect()->back()->with('status', "Item not found.");
		}
	}


	public function update(Request $request, $id){

		$this->validate($request,[
    		"name" => "required|alpha_dash",
    		"description" => "required"
    	]);

		$item = Item::find($id);

		if($item){
			$item->name = $request->name;
			$item->description = $request->description;
			$item->save();

			return redirect('/modules/'.$item->id_module)->with('status', "Item updated successfully.");

		}else{
			return redirect()->back()->with('status', "Error trying to update item.");
		}
	}


	public function destroy(Request $request){
		$item = Item::find($request->id);

		if($item){
			$translations = Translation::where('id_item', $item->id)->get();
			foreach($translations as $translation){
				$translation->delete();
			}

			$item->delete();

			return redirect()->back()->with('status', "Item deleted successfully.");

		}else{
			return redirect()->back()->with('status', "Item not found.");
		}
	}
}
