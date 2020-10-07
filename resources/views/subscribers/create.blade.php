@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">

            <form action="{{ route('subscribers.store') }}" method="POST" >
                @csrf
                <div class="card">
                    <div class="card-header">
                        {{ __('Add New Subscriber') }}

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Kelvin ED">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email address</label>
                                        <input type="email" class="form-control" name="email" placeholder="name@kelvin.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Source</label>
                                        <select class="form-control" name="source">
                                            <option value="">- select -</option>
                                            <option value="Facebook" selected>Facebook</option>
                                            <option value="Google">Google</option>
                                            <option value="LinkedIn">LinkedIn</option>
                                            <option value="Instagram">Instagram</option>
                                            <option value="Youtube">Youtube</option>
                                        </select>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" name="is_newsletter">
                                        <label class="form-check-label" for="">
                                            Want daily newspaper?
                                        </label>
                                      </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-muted">
                        <a href="{{ route('subscribers.index') }}" class="btn btn-secondary btn-md float-left">Cancel</a>
                        <button class="btn btn-success float-right btn-md">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
