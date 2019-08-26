@extends('layouts.layout')

@section('content')

    <h1>Company edit</h1>
    @include('partials.form-errors')
    <div>
        <form action="{{ route('company.edit.save', ['id' => $company->id]) }}" method="POST">
            @method('PUT')
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
                        <input class="" type="text" name="name" value="{{ $company->name }}">
                    </td>
                    <td>
                        <input class="" type="text" name="address" value="{{ $company->address }}">
                    </td>
                </tr>
                </tbody>
            </table>

            <div>
                <button type="submit">Edit</button>&nbsp;
                <a href="{{ route('company.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    @include('partials.ck-editor')
@endsection