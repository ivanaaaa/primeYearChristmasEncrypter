<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Years Information</title>
    <link href="{{ asset('css/form-and-table-styles.css') }}" rel="stylesheet">
</head>
<body>
<form action="{{ route('handleInput') }}" method="POST">
    @csrf
    <label for="year">Input Year:</label>
    <input type="number" name="year" id="year" required>
    <button type="submit">Submit</button>
</form>

<button id="getPrimeYearsData">Get Prime Years Data</button>

<!-- Display results in an HTML table -->
<table id="resultTable">
</table>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('js/primeyear.js') }}"></script>
@if(session('success') === true)
    <script>
        $(document).ready(function () {
            // Simulate a click event on the button on saving
            $('#getPrimeYearsData').click();
        });
    </script>
@endif
</body>
</html>
