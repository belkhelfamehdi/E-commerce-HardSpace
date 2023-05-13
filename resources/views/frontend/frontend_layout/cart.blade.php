@extends('frontend.layout')
@section('js')
    @vite('resources/js/product.js')
@endsection
@section('content')
<style>
    @layer utilities {
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  }
</style>
    <livewire:cart />

@endsection