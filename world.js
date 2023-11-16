document.addEventListener('DOMContentLoaded',function() {

$(document).ready(function () {
    var lookupButton = $('#lookup');
    var countryInput = $('#country');
    var resultDiv = $('#result');

    lookupButton.on('click', function () {
        // Get the value entered in the country input field
        var country = countryInput.val();

        console.log('Sending AJAX request with country:', country);

        // Send an AJAX request to world.php with the selected country
        $.ajax({
            url: 'world.php',
            method: 'GET',
            data: { country: country },
            success: function (data) {
                console.log('Received data from server:', data);

                // Update the resultDiv with the fetched data
                resultDiv.html(data);
            },
            error: function (xhr, status, error) {
                // Handle any errors
                console.error('Error fetching data:', error);
            }
        });
    });
});

});
