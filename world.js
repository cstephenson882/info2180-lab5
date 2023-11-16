document.addEventListener('DOMContentLoaded',function() {

// $(document).ready(function () {
    var lookupButton = $('#lookup'); // lookup_country button
    var countryInput = $('#country');
    var resultDiv = $('#result');

    

    var lookupCitiesButton = $('#lookupCities'); // lookup_cities button

    lookupButton.on('click', function () {
        // Get the value entered in the country input field
        var country_input = countryInput.val();

        console.log('Sending AJAX request with country:', country);

        // Send an AJAX request to world.php with the selected country
        $.ajax({
            url: 'world.php',
            method: 'GET',
            data: { country: country_input },
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

     // New code for cities lookup
     lookupCitiesButton.on('click', function () {
        var country_input = countryInput.val();

        // Send an AJAX request to world.php for cities lookup
        $.ajax({
            url: 'world.php',
            method: 'GET',
            data: {
                country: country_input,
                lookup: 'cities' // Additional parameter for cities lookup
            },
            success: function (data) {
                resultDiv.html(data);
                
            },
            error: function (xhr, status, error) {
                console.error('Error fetching city data:', error);
            }
            
        });
    });
// });

});
