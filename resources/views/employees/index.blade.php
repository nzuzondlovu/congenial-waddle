@extends('layouts.app')

@section('title', 'Home')

@section('content')
<a href="/">Dashboard</a><br>
<a href="/employees/create">Create New employee</a>
<table>
    <thead>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Contact Number</th>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
        <tr>
            <td>
                <a href="/employees/{{ $employee->id }}">{{ $employee->first_name }}</a>
            </td>
            <td>{{ $employee->last_name }}</td>
            <td>{{ $employee->email_address }}</td>
            <td>{{ $employee->contact_number }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $employees->links() }}
@endsection