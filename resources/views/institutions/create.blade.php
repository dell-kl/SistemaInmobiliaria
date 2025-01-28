
@extends('layouts.app')

@section('content')
    <h1>Create Institution</h1>
    <form action="{{ route('institutions.store') }}" method="POST">
        @csrf
        <div>
            <label for="institutions_name">Name</label>
            <input type="text" name="institutions_name" id="institutions_name" required>
        </div>
        <div>
            <label for="institutions_terms">Terms</label>
            <input type="text" name="institutions_terms" id="institutions_terms" required>
        </div>
        <div>
            <label for="institutions_dateRegist">Date Registered</label>
            <input type="date" name="institutions_dateRegist" id="institutions_dateRegist" required>
        </div>
        <div>
            <label for="interests_rate">Interest Rate</label>
            <input type="number" step="0.01" name="interests_rate" id="interests_rate" required>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection