@extends('master-welcome')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    

        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Paperless System 
                </div>
                <div class="links">
                <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">Time Deposit Special Rate</button>
            </div>
             <!-- Default Size -->
            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                        <a href="{{URL::to('customer/create')}}" class="btn btn-primary  waves-effect">NEW</a>
                    <button type="button" class="btn btn-link waves-effect">EXISTING</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 
                <div class="links">
                    <a href="test">Time Deposit Special Rate</a>
                    <a href="https://laracasts.com">Dashboard/a>
                    <a href="https://laravel-news.com">Lalala</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> -->


         
            </div>
        </div>
    </body>
</html>