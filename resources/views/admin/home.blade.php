@extends('layouts.app')

@section('content')
<dashboard :user="{{ Auth::user() }}"></dashboard>
@endsection
