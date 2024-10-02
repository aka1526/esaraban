<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainMenuController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DocgroupController;
use App\Http\Controllers\SectionINController;
use App\Http\Controllers\SectionEXController;
use App\Http\Controllers\SettingDocController;
use App\Http\Controllers\ProjectController;


use App\Http\Controllers\DocumentRecController;
use App\Http\Controllers\DocumentSendController;
use App\Http\Controllers\DocumentCenterController;
use App\Http\Controllers\UploadFileController;
use App\Models\Docgroup;

Route::get('/', function () {
    return redirect('/document-rec');
});

Route::controller(MainMenuController::class)->prefix('mainmenu')->name('mainmenu.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    // Route::post('/purchase/grip/save', 'save')->name('grip.save');
    // Route::get('/purchase/grip/edit/{UNID}', 'edit')->name('grip.edit');
    // Route::post('/purchase/grip/update','update')->name('grip.update');
    // Route::post('/purchase/grip/delete',  'delete')->name('grip.delete');


});

Route::controller(PositionController::class)->prefix('position')->name('position.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    Route::get('/edit/{UNID}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'delete')->name('delete');
});

Route::controller(DocgroupController::class)->prefix('docgroup')->name('docgroup.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    Route::get('/edit/{UNID}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'delete')->name('delete');

});

Route::controller(ProjectController::class)->prefix('project')->name('project.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    Route::get('/edit/{UNID}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'delete')->name('delete');

});


Route::controller(SettingDocController::class)->prefix('setting')->name('setting.')->group(function(){
     Route::match(array('GET', 'POST'),'/','index')->name('index');
     Route::post('/save', 'save')->name('save');

});




Route::controller(SectionINController::class)->prefix('section-internal')->name('sec-in.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    Route::get('/edit/{UNID}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'delete')->name('delete');

});


Route::controller(SectionEXController::class)->prefix('section-external')->name('sec-ex.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    Route::get('/edit/{UNID}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'delete')->name('delete');

});

Route::controller(DocumentRecController::class)->prefix('document-rec')->name('docrec.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    Route::get('/edit/{UNID}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'delete')->name('delete');

});

Route::controller(DocumentSendController::class)->prefix('document-send')->name('docsend.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    Route::get('/edit/{UNID}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'delete')->name('delete');

});

Route::controller(DocumentCenterController::class)->prefix('document-center')->name('doccenter.')->group(function(){
    Route::match(array('GET', 'POST'),'/','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    Route::get('/edit/{UNID}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'delete')->name('delete');

});


Route::controller(UploadFileController::class)->prefix('upload')->name('upload.')->group(function(){
    Route::post('/deletefile', 'deletefile')->name('deletefile');

});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
