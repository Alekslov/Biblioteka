
 @extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Authors edit</div>

               <div class="card-body">
                <form method="POST" action="{{route('author.update',[$author->id])}}">
                   

                    <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" name="author_name" value="{{old('author_name',$author->name)}}">
                        <small class="form-text text-muted">Please enter authors name</small>
                      </div>

                      <div class="form-group">
                        <label>Surname: </label>
                        <input type="text" class="form-control" name="author_surname" value="{{old('author_surname',$author->surname)}}">
                        <small class="form-text text-muted">Please enter authors surname</small>
                      </div>
                    
                   
                    <button type="submit" class="btn btn-primary">EDIT</button>
                    @csrf
                    
               
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
