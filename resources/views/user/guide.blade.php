@extends('layouts.user')
@section('content')
    <navbar></navbar>
    <post-articles :articles="{{ $articles }}"></post-articles>
@endsection