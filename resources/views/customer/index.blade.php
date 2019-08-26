@extends('layouts.layout')

@section('content')
    <h2>My customers</h2>

    <div>
        <form action="{{ route('customer.index') }}" method="GET" id="filter-form">
            <select name="sf" id="list-filter">
                <option value="">{{ __('--All--') }}</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}"
                            @if ($company->id === intval(session('company_filter'))) selected @endif>{{ $company->name }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="my-3">
        <a href="{{ route('customer.add') }}">ADD </a>
        <a href="#" id="button-trash">&nbsp; DELETE</a>
    </div>

    <div>
        <form id="selected-form" method="POST" action="{{ route('customer.delete') }}">
            @csrf
            @method('DELETE')

            <table class="table table-responsive table-striped">
                <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Comment</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $customer->id }}">&nbsp;
                            <a href="{{ route('customer.edit', ['id' => $customer->id]) }}">{{ 'Edit' }}</a>
                        </td>
                        <td>
                            <a href="{{ route('customer.view', ['id' => $customer->id] )}}">{{ $customer->company->name }} </a>
                        </td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->surname }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->comment }}</td>
                        <td>{{ $customer->company->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>

{{--        <div class="pagination pagination-sm justify-content-center">--}}
{{--            {{ $customers->links('vendor.pagination.bootstrap-4') }}--}}
{{--        </div>--}}
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Trash form submit
            document.getElementById('button-trash').addEventListener('click', function () {
                document.getElementById('selected-form').submit();
            });
            // Select all checkbox
            document.getElementById('select-all').addEventListener('click', function () {
                check = this.checked;
                boxes = document.querySelectorAll('input[name="selected[]"]:not(:disabled)');
                boxes.forEach(function (item) {
                    item.checked = check;
                });
            });
            // Filter form submit on select change
            document.getElementById('list-filter').addEventListener('change', function () {
                document.getElementById('filter-form').submit();
            });
        }, false);
    </script>
@endsection
