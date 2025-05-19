@extends('layout')

@section('content')

<div class="card">
  <div class="card-header">Add New Payment</div>
  <div class="card-body">

    <form action="{{ url('payments') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="enrollment_id">Enrollment No</label>
        <select name="enrollment_id" id="enrollment_id" class="form-control">
          @foreach($enrollments as $id => $enroll_no)
            <option value="{{ $id }}">{{ $enroll_no }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="paid_date">Paid Date</label>
        <input type="date" name="paid_date" id="paid_date" class="form-control"/>
      </div>

      <div class="form-group">
        <label for="amount">Amount</label>
        <input type="text" name="amount" id="amount" class="form-control"/>
      </div>

      <button type="submit" class="btn btn-success">Save</button>
    </form>

  </div>
</div>

@endsection
