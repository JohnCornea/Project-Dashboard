@extends('layouts.front')

@section('content')

    <div class="post-heading">
    <h1>{{$post->title}}</h1>
    <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
    <span class="meta">Posted by
      <a href="#">{{$post->user->name}}</a>
      {{$post->created_at->format('d-m-y')}}</span>
  </div>

@endsection