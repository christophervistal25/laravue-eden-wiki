@extends('layouts.app')
@section('content')
<item-create :sub_categories="{{ $sub_categories }}"></item-create>
@endsection