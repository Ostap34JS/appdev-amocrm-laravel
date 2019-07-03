@extends('layouts.app')

@section('content')
    <div class="btn-group">
        <a href="{{ route('import.contacts') }}" class="btn btn-info">Import</a>
        <a href="{{ route('contacts.create') }}" class="btn btn-success">Create</a>
    </div>

    @if (Session::has('message'))
        <div class="alert alert-dismissible alert-info mt-2">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <strong>Note:</strong>
            {{ Session::get('message') }}
        </div>
    @endif

    @if($contacts->isEmpty())
        <h2>
            No data.
        </h2>
    @else
        <table class="table table-responsive-lg table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>Position</th>
                <th>Salary</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <th>{{ $contact->id }}</th>
                    <th>{{ $contact->name }}</th>
                    <th>{{ $contact->company }}</th>
                    <th>{{ $contact->position }}</th>
                    <th>{{ $contact->salary }}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $contacts->links() !!}
    @endif
@endsection