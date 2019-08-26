@extends('layouts.layout')

@section('content')
    <h1>Customer add</h1>
    @include('partials.form-errors')
    <div>
        <form action="{{ route('customer.add.save') }}" method="POST">
            @csrf
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input class="input-group-sm" type="text" name="name"
                               value="{{ request()->old('name') }}">
                    </td>
                    <td>
                        <input class="input-group-sm" type="text" name="address"
                               value="{{ request()->old('address') }}">
                    </td>
                    <td>
                        <input class="input-group-sm" type="text" name="phone"
                               value="{{ request()->old('phone') }}">
                    </td>
                </tr>
                </tbody>
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Company</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input class="input-group-sm" type="text" name="email"
                               value="{{ request()->old('email') }}">
                    </td>
                    <td>
                        <input class="input-group-sm" type="text" name="comment"
                               value="{{ request()->old('comment') }}">
                    </td>
                    <td>
                        <select name="company_id" id="student-filter">
                            <option value="">--All--</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"
                                        @if ($company->id == request()->old('company_id')) selected @endif>{{ $company->name }} </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <div>
            </div>
            <div>
                <button type="submit">Add Customer</button>&nbsp;<a href="{{ route('customer.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('partials.ck-editor')
@endsection