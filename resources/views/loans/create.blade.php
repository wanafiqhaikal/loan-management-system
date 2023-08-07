<!DOCTYPE html>
<html>

<head>
    <title>Add New Loan | Loan Management System</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
</head>

<body>
    <h4>Loan > New</h4>

    @if ($errors->any())
        <div class="container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br><br><br>

    <h3 class="container">Create New Loan</h3>
    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td><label for="name">Name</label></td>
                <td><input type="text" name="name" id="name" value="{{ old('name') }}" required></td>
            </tr>
            <tr>
                <td><label for="type">Type</label></td>
                <td>
                    <select name="type" id="type" required oninput="updateInstallment()">
                        <option value="">Please select</option>
                        <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Home Loan</option>
                        <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Personal Loan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="amount">Amount (RM)</label></td>
                <td><input type="number" name="amount" id="amount" value="{{ old('amount') }}" required
                        oninput="updateInstallment()"></td>
            </tr>
            <tr>
                <td><label for="duration">Duration (Months)</label></td>
                <td><input type="number" name="duration" id="duration" value="{{ old('duration') }}" required
                        oninput="updateInstallment()"></td>
            </tr>
            <tr>
                <td><label>Installment</label></td>
                <td><strong><span id="installmentValue">RM </span><strong></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">Submit</button>
                </td>
            </tr>
        </table>
    </form>

    <br><br>
    <div class="container">
        <a href="{{ route('loans.index') }}"><button type="button">Back to List</button></a>
    </div>
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
