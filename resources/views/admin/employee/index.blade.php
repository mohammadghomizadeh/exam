@extends('layouts.app')
@section('style')
<style>
.delbtn{
    border:none;
    background:transparent;
color:red;
    float:left;  
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee</div>
                <div class="card-header text-right">
                    <a href="/Employees/create" class="btn btn-primary">Add New Employee</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('Deleted'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('Deleted') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Company</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i=1@endphp
                        @foreach($employees as $employee)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$employee->firstname}}&nbsp;{{$employee->lastname}}</td>
                                <td>{{$employee->email}}</td>
                                <td><?php if(isset($employee->company->name)){echo $employee->company->name;}else{echo 'Default';}?></td>
                                <td>
                                <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button class="delbtn"  type="submit">Delete</button>  
                                    </form>
                                    
                                <a href="/Employees/{{$employee->id}}/edit">Edit</a>
                                </td>
                            </tr>
                        @php $i++ @endphp
                        @endforeach
                        </tbody>
                        </table>
                        {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
