@extends('layouts.user')
@section('content')
<navbar></navbar>
<items :sub_category="{{ $items }}"></items>
@endsection()