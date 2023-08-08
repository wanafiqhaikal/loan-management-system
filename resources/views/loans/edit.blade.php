<!DOCTYPE html>
<html>

<head>
    <title>Edit Loan | Loan Management System</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
    <div class="breadcrumb custom-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('loans.index') }}">Home</a>
        <span class="breadcrumb-item">Edit</span>
    </div>
</head>

<body>

    @if ($errors->any())
        <div class="container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>

    <h3 class="container">Update Loan</h3>

    <form action="{{ route('loans.update', $loan->loan_id) }}" method="POST" enctype="multipart/form-data"
        onsubmit="return confirm('Are you sure you want to update this loan?');">
        @csrf
        @method('PUT')

        <table>
            <tr>
                <td><strong><label for="loan_id">ID</label></strong></td>
                <td><strong>{{ $loan->loan_id }}</strong></td>
            </tr>
            <tr>
                <td><strong>Customer Name</strong></td>
                <td><input type="text" name="name" id="name" value="{{ $loan->name }}" required></td>
            </tr>
            <tr>
                <td><strong>Type</strong></td>
                <td>
                    <select name="type" id="type" required oninput="updateInstallment()">
                        <option value="1" {{ $loan->type === 1 ? 'selected' : '' }}>Home Loan</option>
                        <option value="2" {{ $loan->type === 2 ? 'selected' : '' }}>Personal Loan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Amount (RM)</strong></td>
                <td><input type="number" name="amount" id="amount" value="{{ $loan->amount / 100 }}" required
                        oninput="updateInstallment()"></td>
            </tr>
            <tr>
                <td><strong>Duration (Months)</strong></td>
                <td><input type="number" name="duration" id="duration" value="{{ $loan->duration }}" required
                        oninput="updateInstallment()"></td>
            </tr>
            <tr>
                <td><strong>Installment</strong></td>
                <td><strong><span id="installmentValue">RM
                            {{ number_format($loan->installment / 100, 2) }}</span><strong></td>
            </tr>
        </table>
        <br><br>

        <div class="container">
            <h3>Uploaded Document</h3>
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
                        </td>
                    </tr>
                </tbody>
            @else
                <tbody>
                    @foreach ($documents as $document)
                        <tr>
                            <td align="center">
                                <a href="{{ route('loans.download', ['file' => $document->file_name]) }}">
                                    <button class="btn btn-primary">Download</button>
                                </a>
                            </td>
                            <td>{{ $document->file_name }}</td>
                            <td>{{ $document->extension }}</td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
        <br>

        <div class="container">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('loans.index') }}"><button type="button" class="btn btn-secondary">Cancel</button></a>
        </div>

    </form>
</body>
<script>
    function updateInstallment() {
        const type = parseInt(document.getElementById('type').value);
        const amount = parseFloat(document.getElementById('amount').value);
        const duration = parseInt(document.getElementById('duration').value);
        let installment = "";

        if (!isNaN(type) && !isNaN(amount) && !isNaN(duration)) {
            if (type === 1) { // Home Loan
                const interest = 0.005;
                installment = (amount * interest * Math.pow(1 + interest, duration)) / (Math.pow(1 + interest,
                    duration) - 1);
            } else { // Personal Loan
                const durationYear = duration / 12;
                installment = (amount * 0.08 * durationYear + amount) / duration;
            }

            const formattedInstallment = "RM " + (installment).toFixed(2);
            document.getElementById('installmentValue').innerText = formattedInstallment;
        } else {
            document.getElementById('installmentValue').innerText = installment;
        }
        document.getElementById('type').addEventListener('change', updateInstallment);
    }
</script>
@include('footer')

</html>
