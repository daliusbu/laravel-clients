@extends('layouts.layout')

@section('content')
    <h1>Company add</h1>
    @include('partials.form-errors')
    <div>
        <form action="{{ route('company.add.save') }}" method="POST">
            @csrf
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input class="col-sm-5 input-group-sm" type="text" name="name"
                               value="{{ request()->old('name') }}">
                    </td>
                    <td>
                        <input class="col-sm-5 input-group-sm" type="text" name="address"
                               value="{{ request()->old('address') }}">
                    </td>
                </tr>
                </tbody>
            </table>
            <div>
            </div>
            <div>
                <button type="submit">Add Company</button>&nbsp;<a href="{{ route('company.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('partials.ck-editor')
@endsection