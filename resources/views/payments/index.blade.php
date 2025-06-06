@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Payments</h2>
        </div>
        <div class="card-body">
            <a href="{{ url('/payments/create') }}" class="btn btn-success btn-sm" title="Add New Payment">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
            <br/><br/>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Enrollment No</th>
                            <th>Paid Date</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->enrollment?->enroll_no ?? 'N/A' }}</td>
                                <td>{{ $item->paid_date }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>
                                    <a href="{{ url('/payments/' . $item->id) }}" title="View Payment">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fa fa-eye" aria-hidden="true"></i> View
                                        </button>
                                    </a>

                                    <a href="{{ url('/payments/' . $item->id . '/edit') }}" title="Edit Payment">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                        </button>
                                    </a>

                                    <form method="POST" action="{{ url('/payments/' . $item->id) }}" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>

                                    <a href="{{ route('report.pdf', $item->id) }}" class="btn btn-success btn-sm" target="_blank" title="Print Receipt">
                                        <i class="fa fa-print" aria-hidden="true"></i> Print
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
