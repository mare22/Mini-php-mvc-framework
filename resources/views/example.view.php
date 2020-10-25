@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4 text-center">Html file is rendered!</h1>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>console.log('hello world')</script>
@endsection
