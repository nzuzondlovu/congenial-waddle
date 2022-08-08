@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
<a href="/">Back to employees</a>
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

<form action="/employees" method="post">
    @csrf
    <p>Basic Info</p>
    <label>First Name</label>
    <input name="first_name" type="text" value="{{ old('first_name') }}">
    <label>Last Name</label>
    <input name="last_name" type="text" value="{{ old('last_name') }}"><br>
    <label>Contact Number</label>
    <input name="contact_number" type="text" value="{{ old('contact_number') }}"><br>
    <label>Email Address</label>
    <input name="email_address" type="email" value="{{ old('email_address') }}"><br>
    <label>Date of Birth</label>
    <input name="date_of_birth" type="date" value="{{ old('date_of_birth') }}">
    <p>Address Info</p>
    <label>Street Address</label>
    <input name="street_address" type="text" value="{{ old('street_address') }}"><br>
    <label>City</label>
    <input name="city" type="text" value="{{ old('city') }}">
    <label>Postal Code</label>
    <input name="postal_code" type="text" value="{{ old('postal_code') }}">
    <label>Country</label>
    <select name="country">
        @foreach ($countries as $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>
    <p>Skills</p>
    <table id="tbody">
        <thead>
            <tr>
                <th>Skill</th>
                <th>Yrs Exp</th>
                <th>Seniority Rating</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="skills[]">
                        @foreach ($skills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="years[]">
                </td>
                <td>
                    <select name="rating[]">
                        @foreach ($ratings as $key => $rating)
                        <option value="{{ $key }}">{{ $rating }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <a class="btn btn-danger" id="remove">Remove</a>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <a class="btn btn-warning" id="addBtn">Add skill</a>

    <button type="submit">Submit</button>
</form>
@endsection

@push('scripts')
<script>
    $(document).on('click', '#remove', function(e) {
            e.preventDefault();
            var remove = confirm('Are you sure you wish to remove this line?');

            if (remove) {
                $(this).closest('tr').remove();
            }
        });

        $('#addBtn').on('click', function() {
            // Adding a row inside the tbody. 
            $('#tbody').append(`
            <tr>
                <td>
                    <select name="skills[]">
                        @foreach ($skills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="years[]">
                </td>
                <td>
                    <select name="rating[]">
                        @foreach ($ratings as $key => $rating)
                        <option value="{{ $key }}">{{ $rating }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <a class="btn btn-danger" id="remove">Remove</a>
                </td>
            </tr>
            `);
        });
</script>
@endpush