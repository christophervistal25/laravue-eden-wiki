@extends('layouts.app')
@section('content')
<item-edit :sub_categories="{{ $sub_categories }}" :item="{{ $item }}"></item-edit>
@endsection