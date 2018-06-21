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
            <img src="{{URL::asset('assets/img/logo.png')}}" alt="profile Pic" height="100" width="100">
                <div class="title m-b-md">
                   </br> Bussiness Internal
                </div>
                <div class="title m-b-md">
                   </br>Memorandum Approval</br></br>
                </div>
                     <button type="button" class="btn btn-info waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"><b>Time Deposit Special Rate</b></button>
                
                
                     <button type="button" disable="true" class="btn btn-grey waves-effect m-r-20">PPJS</button>
               
                     <button type="button" class="btn btn-grey waves-effect m-r-20">Credit Rate</button>
                </div>
             <!-- Default Size -->
            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Deposan Status ?</h4>
                        </div>
                        <div class="modal-body">
                        <a href="{{URL::to('td/create')}}" class="btn btn-info  waves-effect"><b>NEW</b></a>
                       <!--  <a href="{{URL::to('td/create')}}" class="btn btn-primary waves-effect">Registration</a> -->
                    <button type="button" class="btn btn-link waves-effect"><b>EXISTING</b></button>
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
