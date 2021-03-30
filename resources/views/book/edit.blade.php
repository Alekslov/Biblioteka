


@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Books list</div>

               <div class="card-body">
                <form method="POST" action="{{route('book.update',[$book])}}">




                        <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="book_title"  class="form-control" value="{{old('book_title', $book->title)}}">
                        <small class="form-text text-muted">Please enter books name</small>
                        </div>
                      


                      <div class="form-group">
                        <label>ISBN: </label>
                        <input type="text" class="form-control" name="book_isbn" value="{{old('book_isbn',$book->isbn)}}">
                        <small class="form-text text-muted">Please enter ISBN</small>
                      </div>


                      <div class="form-group">
                        <label>Pages: </label>
                        <input type="text" class="form-control" name="book_pages" value="{{$book->pages}}" value="{{old('book_pages',$book->pages)}}" >
                        <small class="form-text text-muted">Please enter pages count</small>
                      </div>

                      <div class="form-group">
                        <label>About: </label>
                        <textarea name="book_about" id="summernote">{{$book->about}}</textarea>
                        <small class="form-text text-muted">About this book</small>
                      </div>

                      <label>Author: </label>
                    <select name="author_id">
                        @foreach ($authors as $author)
                            <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                                {{$author->name}} {{$author->surname}}
                            </option>
                        @endforeach
                </select>
                    @csrf
                    <button type="submit" class="btn btn-primary">EDIT</button>
                </form>
                
               </div>
           </div>
       </div>
   </div>
</div>
<script>
  window.addEventListener('DOMContentLoaded', (event) => {
      $('#summernote').summernote();
  });
  </script>
  
    
@endsection
