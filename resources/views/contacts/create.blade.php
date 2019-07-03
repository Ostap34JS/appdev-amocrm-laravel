@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('contacts.store') }}" class="tile">
        @csrf

        @if(!empty($errors->first()))
            <div class="row col-lg-12">
                <div class="alert alert-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <h1>Add new contact</h1>

                <div class="alert alert-dismissible alert-info">
                    <button class="close" type="button" data-dismiss="alert">×</button>
                    <strong>Note:</strong>
                    This contact will be available in the AmoCRM, to show it in the contact list - you will need to import.
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="name"
                           placeholder="Enter name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="lead">Lead (selected from AmoCRM available deals)</label>
                    <select class="form-control" id="lead" name="lead_id">
                        <option>Select lead</option>
                        @foreach($leads as $lead)
                            <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label">Salary</label>
                    <div class="form-group">
                        <label class="sr-only" for="salary">Amount (in dollars)</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input class="form-control" id="salary" type="text" name="salary"
                                   placeholder="Amount" value="{{ old('salary') }}">
                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
                        </div>
                    </div>
                    @error('salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="company">Company</label>
                    <input class="form-control" id="company" type="text" name="company"
                           placeholder="Enter company" value="{{ old('company') }}">
                </div>

                <div class="form-group">
                    <label for="position">Position</label>
                    <input class="form-control" id="position" type="text" name="position"
                           placeholder="Enter position" value="{{ old('position') }}">
                </div>
            </div>
        </div>
        <div class="tile-footer">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
@endsection