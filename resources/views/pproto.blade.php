@extends('layouts.app')

@section('title', '投稿画面')

@section('content')  
<?php
ini_set('display_errors',1);  
    <body>
         <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif 

            @csrf
            <div class="content">
                <div class="title m-b-md">
                    PProto~~
                </div>



            
        </div>
    </body>
</html>
