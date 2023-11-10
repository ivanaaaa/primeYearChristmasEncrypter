$(document).ready(function () {
    $('#getPrimeYearsData').click(function () {
        $.ajax({
            url: 'prime-years',
            method: 'GET',
            success: function (data) {
                // Update the HTML table with the fetched data
                $('#resultTable').empty();
                $('#resultTable').append('<tr><th>Year</th><th>Christmas Day</th></tr>');
                data.forEach(function (record) {
                    $('#resultTable').append('<tr><td>' + record.year + '</td><td>' + record.day + '</td></tr>');
                });
            },
            error: function () {
                alert('Error fetching data');
            }
        });
        $('#getPrimeYearsData').click(function () {
            fetchData(); // Initial button click behavior

            setTimeout(fetchData, 1000);
        });
    });
});
