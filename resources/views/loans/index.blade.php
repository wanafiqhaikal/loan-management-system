<!DOCTYPE html>
<html>
<head>
    <title>List of Loans</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <h4>Loan > List</h4>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <br><br>

    <a href="{{ route('loans.create') }}"><button type="button">Add New</button></a>
    <br><br>


    <table>
        <thead>
            <tr>
                <th>View</th>
                <th>Edit</th>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Type</th>
                <th>Amount (RM)</th>
                <th>Duration (Months)</th>
                <th>Installment (auto)</th>
                <th>Delete</th>
            </tr>
        </thead>
        @if ($loans->isEmpty())
        <tbody>
            <tr>
                <td colspan="9" align="center">No Data Available
            </td></tr>
        </tbody>
        @else
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>
                        <a href="{{ route('loans.show', $loan->loan_id) }}"><button type="button">View</button></a>
                    </td>
                    <td>
                        <a href="{{ route('loans.edit', $loan->loan_id) }}"><button type="button">Edit</button></a>
                    </td>
                    <td>{{ $loan->loan_id }}</td>
                    <td>{{ $loan->name }}</td>
                    <td>{{ $loan->type === 1 ? 'Home Loan' : 'Personal Loan' }}</td>
                    <td>{{ number_format($loan->amount / 100, 2) }}</td>
                    <td>{{ $loan->duration }}</td>
                    <td>{{ number_format($loan->installment / 100, 2) }}</td>
                    <td>
                        <form action="{{ route('loans.destroy', $loan->loan_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this loan?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Delete Loan">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @endif
    </table>
</body>
</html>
