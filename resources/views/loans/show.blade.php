<!DOCTYPE html>
<html>
<head>
    <title>Loan Details</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
</head>

<body>
    <h4>Loan > View</h4>
    
    <br><br>
    <h3 class="header-container">Loan Details</h3>

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

    <h3 class="header-container">Uploaded Document</h3>
    <table>
        <thead>
            <tr>
                <th>View/Download</th>
                <th>File Name</th>
                <th>Extension</th>
            </tr>
        </thead>
        @if ($documents->isEmpty())
            <tbody>
                <tr>
                    <td colspan="9" align="center">No Data Available
                </td></tr>
            </tbody>
        @else
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
        @endif
    </table>

    <br><br>
    <div class="button-container">
        <a href="{{ route('loans.index') }}"><button type="button">Back to List</button></a>
    </div>
</body>
@include('footer')
</html>
