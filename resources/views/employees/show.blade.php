@extends('layouts.app')

@section('title', 'View Employee - ')

@section('content')
<a href="/employees">Back to employees</a>
<h1>{{ $employee->first_name }} {{ $employee->last_name }}</h1>
<h3>employee Details</h3>
<h5><a href="/employees/{{ $employee->id }}/edit">Edit employee</a></h5>
<form method="post">
    <label>First Name</label>
    <input name="first_name" type="text" value="{{ $employee->first_name }}"><br>
    <label>Last Name</label>
    <input name="last_name" type="text" value="{{ $employee->last_name }}"><br>
    <label>Email Address</label>
    <input name="email" type="email" value="{{ $employee->email }}"><br>
    <label>Skills</label>
    <select name="skills" multiple>
        @foreach ($employee->skills as $skill)
        <option value="">{{ $skill->name }}</option>
        @endforeach
    </select>
</form>
@endsection