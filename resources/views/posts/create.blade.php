@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add A Post</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group ">
                                <label for="caption" >caption</label>

                                <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="form-groupe">
       
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                        <label class="custom-file-label" for="inputGroupFile04">Choose An Image</label>

                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong> 
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                            </div>



                                <button type="submit" class="btn btn-primary mt-4">
                                    Add My Post
                                </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
