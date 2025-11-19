@extends('layouts.app')

@section('content')
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px; 
            height: auto; /* 100vh ki jagah content-specific height */
            margin: 20px;
        }

        .right, .center, .left {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .right {
            align-items: flex-end;
        }

        .left {
            align-items: flex-start;
        }

        .center {
            justify-content: center;
        }
    </style>

    @include('add.Social')
    @include('add.Native') 
    <div class="container">
        <!-- Left section -->
        <div class="left">
            @include('add.Banner_160x600')
        </div>

        <!-- Center section -->
        <div class="center">
            @include('add.Banner_300x250')
            @include('add.Banner_320x50')
            @include('add.Banner_468x60')
            @include('add.Banner_728x90')
        </div>

        <!-- Right section -->
        <div class="right">
            @include('add.Banner_160x300')
        </div>
    </div>

    @include('add.Popunder')
    @include('add.Social')
@endsection
