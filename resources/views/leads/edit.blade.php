@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit Lead</h2>
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
    <form class="max-w-md" method="GET" action="{{ route('leads.edit',$lead->id) }}">
        <label for="contact_name">Contact Name:</label>
       
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

    <form action="{{ route('leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="contact_id">Contact ID:</label>
            <input type="text" name="contact_id" class="form-control" value="{{ isset($contact)?$contact->id:''}}" readonly >
        </div>

        <div class="form-group">
            <label for="contact_name">Contact Name:</label>
            <input type="text" name="contact_name" class="form-control" value="{{ isset($contact)?$contact->name:'' }}" readonly>
        </div>

        <div class="form-group">
            <label for="contact_phone">Contact Phone:</label>
            <input type="text" name="contact_phone" class="form-control" value="{{ isset($contact)?$contact->phone:''}}" readonly>
        </div>
        <div class="form-group">
            <label for="contact_company">Contact Eompany:</label>
            <input type="text" name="contact_company" class="form-control" value="{{ isset($contact)?$contact->company:''}}" readonly>
        </div>
        <div class="form-group">
            <label for="contact_email">Contact Email:</label>
            <input type="text" name="contact_email" class="form-control" value="{{ isset($contact)?$contact->email:''}}" readonly>
        </div>
        <div class="form-group">
            <label for="source">Lead Source:</label>
            <select name="source">
                <option value="{{ $lead->source}}" disabled selected>{{ $lead->source}}</option>
                <option value="WA">WA</option>
                <option value="Email">Email</option>
            </select>
        </div>
        <div class="form-group">
            <label for="segment">Segment:</label>
            <select name="segment">
                <option value="{{ $lead->segment}}" disabled selected>{{ $lead->segment}}</option>
                <option value="Other">Other</option>
                <option value="Reseller">Reseller</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control" value="{{ $lead->description}}">
        </div>
        <div class="form-group">
            <label for="status">Lead Status:</label>
            <input type="text" name="status" class="form-control" value="{{ $lead->status}}">
        </div>
        @if(Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin') <!-- Check if the user is admin -->
        <div class="form-group">
            <label for="assign_to">Assign To drop:</label>
            <select class="form-control" id="assign_to" name="assign_to" >
                @foreach($user as $item)
                <option value="{{ $item->id }}" {{ (isset($lead) && $lead->assign_to == $item->id) ? 'selected' : '' }}>
                    {{ $item->fullname }}
                </option>
                @endforeach
            </select>
        </div>
        @else
        <div class="form-group">
            <label for="assign_to">Assign To:</label>
            <input type="text" name="assign_to" class="form-control" value="{{$user->fullname}}">
        </div>
        @endif
        <button type="submit">Update</button>
    </form>
