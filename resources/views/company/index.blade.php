@extends('layouts.layout')

@section('content')
    <h2>My companies</h2>

{{--    <div>--}}
{{--        <form action="{{ route('company.index') }}" method="GET" id="filter-form">--}}
{{--            <select name="sf" id="list-filter">--}}
{{--                <option value="">{{ __('--All--') }}</option>--}}
{{--                @foreach ($statuses as $status)--}}
{{--                    <option value="{{ $status->id }}"--}}
{{--                            @if ($status->id === intval(session('status_filter'))) selected @endif>{{ $status->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </form>--}}
{{--    </div>--}}

    <div class="my-3">
        <a href="{{ route('company.add') }}">ADD </a>
        <a href="#" id="button-trash">&nbsp; DELETE</a>
    </div>

    <div>
        <form id="selected-form" method="POST" action="{{ route('company.delete') }}">
            @csrf
            @method('DELETE')

            <table class="table table-responsive table-striped">
                <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Company</th>
                    <th>Address</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $company->id }}">&nbsp;
                            <a href="{{ route('company.edit', ['id' => $company->id]) }}">{{ 'Edit' }}</a>
                        </td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->address }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>

        <div class="pagination pagination-sm justify-content-center">
            {{ $companies->links('vendor.pagination.bootstrap-4') }}
        </div>
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
