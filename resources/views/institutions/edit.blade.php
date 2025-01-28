
@extends('layouts.app')

@section('content')
    <h1>Edit Institution</h1>
    <form action="{{ route('institutions.update', $institution->institutions_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="institutions_name">Name</label>
            <input type="text" name="institutions_name" id="institutions_name" value="{{ $institution->institutions_name }}" required>
        </div>
        <div>
            <label for="institutions_terms">Terms</label>
            <input type="text" name="institutions_terms" id="institutions_terms" value="{{ $institution->institutions_terms }}" required>
        </div>
        <div>
            <label for="institutions_dateRegist">Date Registered</label>
            <input type="date" name="institutions_dateRegist" id="institutions_dateRegist" value="{{ $institution->institutions_dateRegist }}" required>
        </div>
        <div>
            <label for="interests_rate">Interest Rate</label>
            <input type="number" step="0.01" name="interests_rate" id="interests_rate" value="{{ $institution->interests->first()->interests_rate ?? '' }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection