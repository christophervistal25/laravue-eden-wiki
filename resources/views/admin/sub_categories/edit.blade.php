@extends('layouts.app')
@section('content')
    <sub-category-edit :categories="{{ $categories }}" :sub_category="{{ $sub_category }}"></sub-category-edit>
@endsection
