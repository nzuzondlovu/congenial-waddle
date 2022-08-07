@extends('layouts.app')

@section('title', 'Update Employee - ')

@section('content')
<a href="/employees">Back to employees</a>
<h3>Employee Details</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/employees/store" method="post">
    @csrf
    <label>First Name</label>
    <input name="first_name" type="text" value="{{ old('first_name') }}"><br>
    <label>Last Name</label>
    <input name="last_name" type="text" value="{{ old('last_name') }}"><br>
    <label>Email Address</label>
    <input name="email_address" type="email" value="{{ old('email_address') }}"><br>
    <label>skills</label>
    <select name="skills[]" multiple>
        @foreach ($skills as $skill)
        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
        @endforeach
    </select><br>

    <button type="submit">Submit</button>
</form>
@endsection