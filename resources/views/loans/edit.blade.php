<!DOCTYPE html>
<html>
<head>
    <title>Edit Loan</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
</head>

<body>
    <h4>Loan > Edit</h4>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>

    <h3 class="header-container">Update Loan</h3>

    <form action="{{ route('loans.update', $loan->loan_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <table>
            <tr>
                <td><strong><label for="loan_id">ID</label></strong></td>
                <td>{{ $loan->loan_id }}</td>
            </tr>
            <tr>
                <td><strong>Customer Name</strong></td>
                <td><input type="text" name="name" id="name" value="{{ $loan->name }}" required></td>
            </tr>
            <tr>
                <td><strong>Type</strong></td>
                <td>
                    <select name="type" id="type" required>
                        <option value="1" {{ $loan->type === 1 ? 'selected' : '' }}>Home Loan</option>
                        <option value="2" {{ $loan->type === 2 ? 'selected' : '' }}>Personal Loan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Amount (RM)</strong></td>
                <td><input type="number" name="amount" id="amount" value="{{ $loan->amount / 100}}" required></td>
            </tr>
            <tr>
                <td><strong>Duration (Months)</strong></td>
                <td><input type="number" name="duration" id="duration" value="{{ $loan->duration }}" required></td>
            </tr>
            <tr>
                <td><strong>Installment</strong></td>
                <td>{{ number_format($loan->installment / 100, 2) }}</td>
            </tr>
        </table>
        <br><br>

        <h3 class="header-container">Uploaded Document</h3>

        <div class="button-container">
            <input type="file" class="form-control" name="uploadFile" id="uploadFile" />
        </div>
        <br><br>

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
                        <td align="center"><a
                                href="{{ route('loans.download', ['file' => $document->file_name]) }}">X</a></td>
                        <td>{{ $document->file_name }}</td>
                        <td>{{ $document->extension }}</td>
                    </tr>
                @endforeach
            </tbody>
            @endif
        </table>
        <br>

        <div class="button-container">
            <button type="submit">Save</button>
            <a href="{{ route('loans.index') }}"><button type="button">Cancel</button></a>
        </div>

    </form>
</body>
@include('footer')
</html>
