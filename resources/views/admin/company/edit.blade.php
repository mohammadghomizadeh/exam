
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
                <div class="card-header">Company</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <!--StartContent-->

                        <form method="POST" action="/Companies/{{$company->id}}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-6 my-1">
                                            <label class="sr-only " for="inlineFormInputName">Name</label>
                                            <input type="text" class="form-control" value="{{$company->name}}" name="name" placeholder="Name" >
                                        </div>
                                        <div class="col-sm-6 my-1">
                                            <label class="sr-only" for="inlineFormInputGroupUsername">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                                </div>
                                                <input type="email" class="form-control" value="{{$company->email}}" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <label class="sr-only" for="inlineFormInputName">WebSite</label>
                                            <input type="text" class="form-control" value="{{$company->website}}" name="website" placeholder="WebSite">
                                        </div>
                                        <div class="col-sm-12 my-1">
                                        <input type="file" id="imgupload" name="logo" onchange="readURL(this);" style="display:none"/> 
                                        <button onclick="event.preventDefault();$('#imgupload').trigger('click');"class="col-sm-12 btnupload" id="OpenImgUpload">Logo Upload</button>
                                        </div>
                                        <div class="col-sm-12 my-1 text-center">

                                        <img id="blah" src="/storage/{{$company->logo}}"/>
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