@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">

            <form action="{{ route('subscribers.update', $subscriber->id) }}" method="POST" >
                @csrf
            <div class="card">
                <div class="card-header">
                    {{ __('Update Subscriber') }}

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
                                <input type="text" class="form-control" id="" name="name" value="{{ (old('name')) ? old('name') : $subscriber->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Email address</label>
                                    <input type="email" class="form-control" name="email" placeholder="name@kelvin.com" value="{{ (old('email')) ? old('email') : $subscriber->email }}">
                                </div>
                                <div class="form-group">
                                  <label for="">Source</label>
                                  <select class="form-control" name="source">
                                    <option value="">- select -</option>
                                    <option value="Facebook" {{ ($subscriber->source == 'Facebook') ? 'selected' : ''}}>Facebook</option>
                                    <option value="Google" {{ ($subscriber->source == 'Google') ? 'selected' : ''}}>Google</option>
                                    <option value="LinkedIn" {{ ($subscriber->source == 'LinkedIn') ? 'selected' : ''}}>LinkedIn</option>
                                    <option value="Instagram" {{ ($subscriber->source == 'Instagram') ? 'selected' : ''}}>Instagram</option>
                                    <option value="Youtube" {{ ($subscriber->source == 'Youtube') ? 'selected' : ''}}>Youtube</option>
                                  </select>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="yes" name="is_newsletter" {{ ($subscriber->is_newsletter == 1) ? 'checked' : ''}}>
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
