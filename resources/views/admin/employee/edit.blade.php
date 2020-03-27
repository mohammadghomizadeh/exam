
@extends('layouts.app')
@section('style')
<style>
.btnupload{
    background: #e9ecef;
    border: none;
    padding: 6px;
    cursor: pointer;
}

#blah{
width:40%;
height:200px;

}

    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Employee</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <!--StartContent-->

                        
                        <form method="POST" action="/Employees/{{$employee->id}}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-6 my-1">
                                            <label class="sr-only "  for="inlineFormInputName">FirstName</label>
                                            <input type="text" class="form-control" value="{{$employee->firstname}}" name="firstname" placeholder="FirstNAme" >
                                        </div>
                                        <div class="col-sm-6 my-1">
                                            <label class="sr-only " for="inlineFormInputName">LastName</label>
                                            <input type="text" class="form-control" value="{{$employee->lastname}}" name="lastname" placeholder="LastName" >
                                        </div>
                                        <div class="col-sm-6 my-1">
                                            <label class="sr-only " for="inlineFormInputName">Phone</label>
                                            <input type="text" class="form-control" value="{{$employee->phone}}" name="phone" placeholder="phone" >
                                        </div>
                                        <div class="col-sm-6 my-1">
                                            <label class="sr-only" for="inlineFormInputGroupUsername">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                                </div>
                                                <input type="email" class="form-control" value="{{$employee->email}}" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 my-1">
                                        <select id="inputState" class="form-control" name="company">
                                            <option value="{{$employee->company->id}}" selected>{{$employee->company->name}}</option>
                                            @foreach($companies as $company) 
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                       
                                        <div class="col-auto my-1">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                       
                                    </div>
                                    @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                        </form>

                        <!--EndContent-->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('script')
<script>

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

</script>
@endsection