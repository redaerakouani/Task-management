@extends('layout')
@section('main-content')
<div class="m-3">
    <div class="float-start">
        <h4 class="pb-3">My Tasks</h4>
    </div>
    <div class="float-end">
        <a href="{{ route('task.create') }}"    class="btn btn-dark">
            <i class="fa fa-plus-circle"></i>
        Create task
        </a>
    </div>
    <div class="clearfix"></div>
</div>
 @foreach ($tasks as $task)
 <div class="card m-3">
    <h5 class="card-header" >
       @if ($task->status=='Todo')
            {{ $task->title }}
        @else 
        <del>{{ $task->title }}</del>                   
        @endif
       
        <span class="badge rounded-pill bg-warning text-dark py-2 px-3">
            {{ $task->created_at->diffForhumans() }}
        </span>
    </h5>
    <div class="card-body">
      <div class="card-text">
          <div class="float-start">
            @if ($task->status=='Todo')
            {{ $task->description }}
        @else 
        <del>{{ $task->description }}</del>                   
        @endif
        <br>
            <br>
            @if ($task->status==="Todo")            
                <span class="badge rounded-pill bg-secondary text-light py-2 px-3">Todo</span>           
            @else            
                <span class="badge rounded-pill bg-success text-light py-2 px-3">Done</span>          
            @endif
              <small>Last Updated -  {{ $task->updated_at->diffForhumans() }}</small>
          </div>
          
          <div class="float-end ">
              <a href="{{ route('task.edit',$task->id) }}" class="btn btn-success py-1 px-3">Edit</a>
              <form action="{{ route('task.destroy',$task->id) }}"  style="display: inline" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger  py-1 px-4"">Delete</button>
            </form>
              
          </div>
          <div class="clearfix"></div>
        
      </div>
    </div>
  </div>
 @endforeach       
  @if (count($tasks)===0)
      <div class="alert alert-danger p-2">
        No Task Found!! please create your task
        
    
      </div>
  @endif
@endsection