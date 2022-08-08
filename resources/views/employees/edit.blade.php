@extends('layouts.app')

@section('title', 'Update Employee - ')

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

<form action="/employees/{{ $employee->id }}" method="post">
    @csrf
    <p>Basic Info</p>
    <label>First Name</label>
    <input name="first_name" type="text" value="{{ $employee->first_name }}">
    <label>Last Name</label>
    <input name="last_name" type="text" value="{{ $employee->last_name }}"><br>
    <label>Contact Number</label>
    <input name="contact_number" type="text" value="{{ $employee->contact_number }}"><br>
    <label>Email Address</label>
    <input name="email_address" type="email" value="{{ $employee->email_address }}"><br>
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
    <select name="country">
        @foreach ($countries as $country)
        @if ($employee->country_id == $country->id)
        <option value="{{ $country->id }}" @selected(true)>{{ $country->name }}</option>
        @else
        <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endif
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
            @if ($employee->skills)
            @foreach ($employee->skills as $item)
            <tr>
                <td>
                    <select name="skills[]">
                        @foreach ($skills as $skill)
                        @if ($item->id == $skill->id)
                        <option value="{{ $skill->id }}" @selected(true)>{{ $skill->name }}</option>
                        @else
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="years[]" value="{{ $item->pivot->years }}">
                </td>
                <td>
                    <select name="rating[]">
                        @foreach ($ratings as $key => $rating)
                        @if ($item->pivot->seniority_rating == $key)
                        <option value="{{ $key }}" @selected(true)>{{ $rating }}</option>
                        @else
                        <option value="{{ $key }}">{{ $rating }}</option>
                        @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <a class="btn btn-danger" id="remove">Remove</a>
                </td>
            </tr>
            @endforeach
            @else

            @endif
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