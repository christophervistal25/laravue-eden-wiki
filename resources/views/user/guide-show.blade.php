@extends('layouts.user')
@section('content')
    <navbar></navbar>
    <post :post="{{ $article }}"></post>
@endsection