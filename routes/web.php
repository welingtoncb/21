<?php

$this->group(['middleware' => ['auth']],function(){
    
    $this->get('/home', 'HomeController@index')->name('home');
    
    $this->post('/imovel','ImovelController@create')->name('imovel');
    $this->get('/imovel','ImovelController@create')->name('imovel');
    $this->post('/store','ImovelController@store')->name('store');
    $this->get('/listagem','ImovelController@listing')->name('listing');
    $this->get('/imovel/{id}/edit','ImovelController@edit')->name('edit');
    $this->put('/update/{id}','ImovelController@update')->name('update');
    $this->any('/delete/{id}','ImovelController@delete')->name('delete');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();