@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('List of Subscribers') }}
                    <a href="{{ route('subscribers.create') }}" class="btn btn-primary btn-sm float-right">Add New Subscriber</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="subscribers">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Source</th>
                                            <th>Newsletter</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('after-scripts')
<script>
  $(function () {

    var table = $('#subscribers').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('subscribers.index') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'emasil'},
            {data: 'source', name: 'Source'},
            {data: 'is_newsletter', name: 'Newsletter'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });



  });
  function deleteSub(id){

    }
</script>
@endpush
