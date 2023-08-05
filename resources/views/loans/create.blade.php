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
    <title>Add New Loan</title>
</head>

<body>
    <h4>Loan > New</h4>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br><br>

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
                    <select name="type" id="type" required>
                        <option value="">Please select</option>
                        <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Home Loan</option>
                        <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Personal Loan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="amount">Amount (RM)</label></td>
                <td><input type="number" name="amount" id="amount" value="{{ old('amount') }}" required></td>
            </tr>
            <tr>
                <td><label for="duration">Duration (Months)</label></td>
                <td><input type="number" name="duration" id="duration" value="{{ old('duration') }}" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">Submit</button>
                </td>
            </tr>
        </table>
    </form>

    <br><br>
    <a href="{{ route('loans.index') }}"><button type="button">Back to List</button></a>
</body>
</html>
