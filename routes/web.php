<?php

Auth::routes();

$this->group(['middleware' => ['auth']], function() {
    
    $this->get('/', 'HomeController@index');

    $this->get('/home', 'HomeController@index')->name('home');
    $this->match(['get', 'post'], '/imovel', 'ImovelController@create')->name('imovel');
    $this->post('/store/{source}','ImovelController@store')->name('store');
    $this->get('/listagem','ImovelController@listing')->name('listing');
    $this->get('/imovel/{id}/edit','ImovelController@edit')->name('edit');
    $this->put('/update/{id}','ImovelController@update')->name('update');
    $this->any('/delete/{id}','ImovelController@delete')->name('delete');
    $this->get('/view/{id}','ImovelController@view')->name('view');
    $this->any('/pesquisa','ImovelController@searchImmobile')->name('searchImmobile');
    $this->match(['get', 'post'], '/import','ImovelController@createImportXML')->name('import');
});