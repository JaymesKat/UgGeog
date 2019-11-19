<?php
Route::get('districts', function(){
	echo 'This should return all districts';
});

Route::get('regions/', 'JaymesKat\UgandaGeography\RegionsController@all');

Route::get('regions/{id}', 'JaymesKat\UgandaGeography\RegionsController@single');
