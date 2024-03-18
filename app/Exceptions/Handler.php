<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Auth;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // $this->renderable(function (\Exception $e) {
        //     if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
        //         return back()->with('csrfTokenError', 'Sorry\n');
        //     };
        // });
    }
    public function render($request, Throwable $exception)
    {
        
        // Always redirect to the index page when an exception occurs
        if($exception->getMessage() != ""){
            session()->flash('errormessage', '未知錯誤，請重試一次');
            $data = fopen("/var/www/ClaMEISR/app/Exceptions/weberrorlog.txt", "a");
            try{
                $account = Auth::user()->username;
                $TeacherName = session('TeacherName');
                $SchoolCode = session('schoolcode');
                $errorlog = "Username：".$account." SchoolCode：".$SchoolCode." TeacherName：".$TeacherName." Error Log：".$exception->getMessage()."  Date：".date("Y/m/d H:i:s",strtotime('8 hour')).PHP_EOL;
                fwrite($data, strval($errorlog));
            }catch(Exception $e){
                $errorlog = "ErrorLog：".$exception->getMessage()."  Date：".date("Y/m/d").PHP_EOL;
                fwrite($data, strval($errorlog));
            }
            fclose($data);
        }
        return redirect('front');

        // You can also customize the response further if needed
        // For example, return a specific view
        // return response()->view('errors.custom_error_view', [], 500);

        // Or you can call the parent render method for default behavior
        // return parent::render($request, $exception);
    }
}
