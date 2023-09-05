@extends('components._partials.default')
@section('content')
    <label for="start-date">Start Date:</label>
    <input type="date" id="start-date" name="start-date" min="2023-09-01" max="2023-09-30">

    <label for="end-date">End Date:</label>
    <input type="date" id="end-date" name="end-date" min="2023-09-01" max="2023-09-30">
@endsection
