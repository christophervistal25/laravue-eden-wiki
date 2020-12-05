@extends('layouts.user')
@section('content')
<navbar></navbar>
<docs-menu :categories="{{ $categories }}"></docs-menu>
@endsection