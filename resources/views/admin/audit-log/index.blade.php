@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<div class="container-fluid">
    
    @include('admin.layouts.inc.breadcrumb')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-centered table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Action</th>
                          <th>Model</th>
                          <th>Description</th>
                          <th>Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($auditLogs as $log)
                        <tr>
                            <td>{{ $log->user->name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($log->action_type) }}</td>
                            <td>{{ $log->model_name }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div> <div class="card-footer">
                    {{ $auditLogs->links() }}
                </div>
            </div> </div></div>
    </div> @endsection