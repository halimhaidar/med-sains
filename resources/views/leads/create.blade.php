@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>{{ isset($lead) ? 'Edit' : 'Create' }} Lead</h2>
            <a class="btn btn-primary mb-3" href="{{ route('leads.index') }}">Back</a>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="max-w-md" method="GET" action="{{ route('leads.create') }}">
        <label for="contact_name">Contact Name:</label>
        <!-- <input type="search" id="search" name="search" value="{{ request('search') }}" placeholder="Contact Name" /> -->
        <select name="contact_id">
            <option value="">Contact Name</option>
            @foreach ($contactsAll as $item)
            <option value="{{ $item->id }}" {{ (isset($contact) && $item->id == $contact->id) ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
            @endforeach
        </select>
        <button type="submit">Choose</button>
    </form>

    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="contact_id">Contact ID:</label>
            <input type="text" name="contact_id" class="form-control" value="{{ isset($contact)?$contact->id:''}}">
        </div>

        <div class="form-group">
            <label for="contact_name">Contact Name:</label>
            <input type="text" name="contact_name" class="form-control" value="{{ isset($contact)?$contact->name:'' }}">
        </div>

        <div class="form-group">
            <label for="contact_phone">Contact Phone:</label>
            <input type="text" name="contact_phone" class="form-control" value="{{ isset($contact)?$contact->phone:''}}">
        </div>
        <div class="form-group">
            <label for="contact_company">Contact Eompany:</label>
            <input type="text" name="contact_company" class="form-control" value="{{ isset($contact)?$contact->company:''}}">
        </div>
        <div class="form-group">
            <label for="contact_email">Contact Email:</label>
            <input type="text" name="contact_email" class="form-control" value="{{ isset($contact)?$contact->email:''}}">
        </div>
        <div class="form-group">
            <label for="source">Lead Source:</label>
            <select name="source">
            <option value="" disabled selected>-Select Source-</option>
                <option value="WA">WA</option>
                <option value="Email">Email</option>
            </select>
        </div>
        <div class="form-group">
            <label for="segment">Segment:</label>
            <select name="segment">
            <option value="" disabled selected>-Select Segment-</option>
                <option value="Other">Other</option>
                <option value="Reseller">Reseller</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Lead Status:</label>
            <input type="text" name="status" class="form-control">
        </div>
        <div class="form-group">
            <label for="assign_to">Assign To:</label>
            <input type="text" name="assign_to" class="form-control" value="{{$user->fullname}}">
        </div>
        <button type="submit">Choose</button>
    </form>