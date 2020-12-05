@extends('layouts.user')
@section('content')
<navbar></navbar>

<a href="/dungeons">
    <button
class="bg-green-300 rounded-full shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 focus:outline-none mt-2"
>
<svg
  xmlns="http://www.w3.org/2000/svg"
  class="icon icon-tabler icon-tabler-arrow-narrow-left"
  width="44"
  height="44"
  viewBox="0 0 24 24"
  stroke-width="1.5"
  stroke="#000000"
  fill="none"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <line x1="5" y1="12" x2="19" y2="12" />
  <line x1="5" y1="12" x2="9" y2="16" />
  <line x1="5" y1="12" x2="9" y2="8" />
</svg>
</button>

</a>
<h1 class="text-gray-700 text-3xl uppercase font-bold tracking-widest border-b-2 border-green-200 border-dashed"># Dungeons</h1>


<div class="container shadow-md p-10 leading-10 tracking-wide font-light text-justify ">
    {!! html_entity_decode($dungeon->content) !!}
</div>

@endsection