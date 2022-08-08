@extends('layouts.app')

@section('title', "View Employee - $employee->first_name")

@section('content')
<a href="/">Back to employees</a>
<h1>{{ $employee->first_name }} {{ $employee->last_name }}</h1>
<h3>employee Details</h3>
<h5><a href="/employees/{{ $employee->id }}/edit">Edit employee</a></h5>
<form action="/employees" method="post">
    @csrf
    <p>Basic Info</p>
    <label>First Name</label>
    <input name="first_name" type="text" value="{{ $employee->first_name }}">
    <label>Last Name</label>
    <input name="last_name" type="text" value="{{ $employee->last_name }}"><br>
    <label>Contact Number</label>
    <input name="contact_number" type="text" value="{{ $employee->contact_number }}"><br>
    <label>Email Address</label>
    <input name="email_address" type="text" value="{{ $employee->email_address }}"><br>
    <label>Date of Birth</label>
    <input name="date_of_birth" type="text" value="{{ $employee->date_of_birth }}">
    <p>Address Info</p>
    <label>Street Address</label>
    <input name="street_address" type="text" value="{{ $employee->street_address }}"><br>
    <label>City</label>
    <input name="city" type="text" value="{{ $employee->city }}">
    <label>Postal Code</label>
    <input name="postal_code" type="text" value="{{ $employee->postal_code }}">
    <label>Country</label>
    <input name="country" type="text" value="{{ $employee->country->name }}">
    <p>Skills</p>
    <table id="tbody">
        <thead>
            <tr>
                <th>Skill</th>
                <th>Yrs Exp</th>
                <th>Seniority Rating</th>
            </tr>
        </thead>
        <tbody>
            @if ($employee->skills)
            @foreach ($employee->skills as $item)
            <tr>
                <td>
                    <input type="text" value="{{ $item->name }}">
                </td>
                <td>
                    <input type="text" value="{{ $item->pivot->years }}">
                </td>
                <td>

                    <input type="text"
                        value="{{ \App\Enums\SeniorityRating::coerce($item->pivot->seniority_rating) }}">
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <br>

</form>
@endsection