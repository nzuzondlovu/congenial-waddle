@extends('layouts.app')

@section('title', 'Update Employee - ')

@section('content')
<a href="/">Back to employees</a>
<h3>Employee Update</h3>

<form action="/employees/{{ $employee->id }}/update" method="post">
    <label>First Name</label>
    <input name="first_name" type="text" value="{{ $employee->first_name }}"><br>
    <label>Last Name</label>
    <input name="last_name" type="text" value="{{ $employee->last_name }}"><br>
    <label>Email Address</label>
    <input name="email_address" type="email" value="{{ $employee->email_address }}"><br>
    <label>Skills</label>
    <select name="skills" multiple>
        @foreach ($employee->skills as $skill)
        <option value="">{{ $skill->name }}</option>
        @endforeach
    </select><br>

    <button type="submit">Submit</button>
</form>
@endsection