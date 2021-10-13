@extends('layouts.home')

@section('title',' Previous Due')

@section('Purchase Previous Due')
    active    
@endsection

{{-- @section('Master-unit')
    active    
@endsection --}}

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Previous Due</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('previous_due')}}">Previous Due</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            @foreach ($errors->all() as $error)
                @if ($error)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Error!</strong> {{ $error }}
                    </div>
                @endif
            @endforeach

            
            <div class="card card-muted">
              <div class="card-header card-border">
                <h3 class="card-title text-secondary">Add Previous Due </h3>
              <a href="{{route('previous_due')}}"><button type="submit" class="btn btn-info pull-right">Back</button></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="POST" action="{{route('purcahse_pre_due.store_pre_due')}}" >
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group {{ $errors->has('purchaser_id') ? ' has-error' : '' }}">
                            <label>Purchaser </label>
                            {{-- <div class="input-group">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="purchaser_id">
                                    <i class="fa fa-user"></i>
                                </label>
                              </div> --}}
                              <select required class="form-control select2" id="purchaser_id" name="purchaser_id">
                                <option selected="" disabled="">Select purchasers</option>
                                @foreach($purchasers as $purchaser)
                                <option value="{{$purchaser->purchaser_id}}">{{$purchaser->purchaser_name}}</option>
                                @endforeach
                              </select>
                            {{-- </div> --}}
                          </div>
                        </div>
                        {{-- Due Date --}}
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('previous_due_date') ? ' has-error' : '' }}">
                              <label>Previous Due Date <span style="color: red;">*</span></label>
                              {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="datepicker">
                                    <i class="fa fa-calendar"></i>
                                  </label>
                                </div> --}}
                                <input type="text" name="previous_due_date" class="form-control datepicker" id="datepicker" required="" placeholder="dd-mm-yyyy">
                                @if ($errors->has('previous_due_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('previous_due_date') }}</strong>
                                </span>
                                @endif
                              {{-- </div> --}}
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="previous_due_amount">Previous Due Amount <span style="color: red;">*</span></label>
                            <input type="text" name="previous_due_amount" class="form-control {{$errors->has('previous_due_amount') ? 'is-invalid' : ''}}" id="previous_due_amount" required="" placeholder="Enter Amount" value="{{ old('previous_due_amount')}}">
                        </div>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Add </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
            </div>
            <!-- /.card -->
@endsection             
@section('scripts')
<script>
  defaultDate()
</script> 
@endsection 