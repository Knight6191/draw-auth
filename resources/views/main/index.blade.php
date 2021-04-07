@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="/">Home</a>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Main Application
                </div>

                <div class="panel-body">
                <ul>
                    <li><a href="main/profile">Fill Profile Details</a></li>
                    <li><a href="main/auth">Generate Authorization Pattern</a></li>
                <ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
