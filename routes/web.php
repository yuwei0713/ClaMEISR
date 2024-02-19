<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenController;


use App\Http\Controllers\QuestionnaireController;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\NewOpenController; //測試用Controller
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [OpenController::class, 'frontdirect']);
Route::get('/front', [OpenController::class, 'index'])->name('front.show');


Route::group(['middleware' => ['guest']], function () {
    /**
     * Register Routes
     */
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');
    /**
     * Login Routes
     */
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
});

Route::group(['middleware' => ['auth']], function () {
    /**
     * Teacher Basic Data Insert Route
     */
    Route::post('/teacherdata', [OpenController::class, 'ReceiveTeacherData'])->name('user.teacherdata.Receive');
    /**
     * Teacher Basic Data Update Route
     */
    Route::post('/updateteacherdata', [OpenController::class, 'ReceiveTeacherData'])->name('user.teacherdata.Update');
    /**
     * Logout Routes
     */
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
    /** 
     *  Questionnaire Route
     */
    Route::get('ClaMEISER', [QuestionnaireController::class, 'PushClaMEISER'])->name('user.ClaMEISER.show');
    Route::post('ClaMEISER', [QuestionnaireController::class, 'ReceiveClaMEISER'])->name('user.Receive');
    /** 
     *  Child Information Route
     */
    Route::get('ChildInformation', [OpenController::class, 'PushChildInformation'])->name('child.infromation.show');
    Route::post('ChildInformation', [OpenController::class, 'ReceiveChildInformation'])->name('child.infromation.perform');
    /**
     *  Child Information Delete/Recover Route
     */
    Route::post('ChildInformation/Delete', [OpenController::class, 'DeleteChildInformation'])->name('child.information.delete');
    /**
     *  Child Information History Route
     */
    Route::get('InformationHistory/Child', [OpenController::class, 'PushHistoryChildInformation'])->name('child.history.information.show');
    Route::post('InformationHistory/Child', [OpenController::class, 'ReceiveHistoryChildInformation'])->name('child.history.information.perform');
    /**
     * Questionnaire And Result Unify Route
     */
    Route::get('InformationHistory',[QuestionnaireController::class, 'PushClaUnify'])->name('cla.unify.show');
    /**
     *  Questionnaire History Route
     */
    Route::post('InformationHistory/Questionnaire',[QuestionnaireController::class, 'PushHistoryClaMEISER'])->name('questionnaire.history.Receive');
    /**
     *  Questionnaire Count Result Route
     */
    Route::get('InformationHistory/CountResult', [QuestionnaireController::class, 'PushResult'])->name('questionnaire.result.show');
    /**
     *  Questionnaire Count Detail Result Route
     */
    Route::get('InformationHistory/DetailResult', [QuestionnaireController::class, 'PushDetailResult'])->name('questionnaire.detailresult.show');
    /**
     * Questionnaire History Result Compare Route
     */
    Route::get('InformationHistory/Compare', [QuestionnaireController::class, 'CompareResult'])->name('questionnaire.result.compare.show');
    });
