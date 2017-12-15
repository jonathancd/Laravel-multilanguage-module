<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public static function getTranslation($item){

	    $language = Language::where('active',1)->first();
	    $item = Item::where('name', $item)->first();

	    if ($language && $item) {

	        $translation = Translation::where(['id_language' => $language->id, 'id_item' => $item->id])->first();

	        if($translation){
	            return $translation->value;
	        }
	    }

	    return '';
	}
}
