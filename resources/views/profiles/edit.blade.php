@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modify my Information</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profiles.update' , ['user' => $user]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group ">
                                <label for="title" >Title</label>

                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}"  autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>


                            <div class="form-group ">
                                <label for="name" >description</label>

                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" autofocus> {{ old('description') ?? $user->profile->description }} </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>



                            <div class="form-group ">
                                <label for="url" >URL</label>

                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url  }}"  autocomplete="url" autofocus>

                                @error('url')
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
                                    Modify
                                </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
