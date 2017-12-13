<?php

function getLocalLanguage(){
	$lang = App\Language::where('active',1)->first();
	
	if($lang)
		return $lang;
	else
		return '';
}

function getTranslation($item){
    $language = App\Language::where('active',1)->first();
    $item = App\Item::where('name', $item)->first();

    if ($language && $item) {

        $translation = App\Translation::where(['id_language' => $language->id, 'id_item' => $item->id])->first();

        if($translation){
            return $translation->value;
        }
    }

    return '';
}