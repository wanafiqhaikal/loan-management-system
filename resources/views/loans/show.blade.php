<!DOCTYPE html>
<html>
<style>
    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
    }
</style>

<head>
    <title>Loan Details</title>
</head>

<body>
    <h4>Loan > View</h4>

    <table>
        <tr>
            <td><strong>Name</strong></td>
            <td>{{ $loan->name }}</td>
        </tr>
        <tr>
            <td><strong>Type</strong></td>
            <td>{{ $loan->type === 1 ? 'Home Loan' : 'Personal Loan' }}</td>
        </tr>
        <tr>
            <td><strong>Amount (RM)</strong></td>
            {{-- <td>{{ $loan->amount }}</td> --}}
            <td>{{ number_format($loan->amount / 100, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Duration</strong></td>
            <td>{{ $loan->duration }}</td>
        </tr>
        <tr>
            <td><strong>Installment</strong></td>
            <td>{{ number_format($loan->installment / 100, 2) }}</td>
        </tr>
    </table>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>View/Download</th>
                <th>File Name</th>
                <th>Extension</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr>
                    <td align="center"><a href="{{ route('loans.download', ['file' => $document->file_name]) }}">X</a>
                    </td>
                    <td>{{ $document->file_name }}</td>
                    <td>{{ $document->extension }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <a href="{{ route('loans.index') }}"><button type="button">Back to List</button></a>
</body>

</html>
