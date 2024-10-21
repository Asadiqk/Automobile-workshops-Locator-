function searchWorkshops() {
    var city = document.getElementById("searchCity").value;

    fetch('api.php?city=' + city)
    .then(response => response.json())
    .then(data => {
        var results = document.getElementById("results");
        results.innerHTML = '';

        if(data.length > 0) {
            data.forEach(workshop => {
                results.innerHTML += `
                    <div class="workshop-item">
                        <h5>${workshop.name}</h5>
                        <p>${workshop.address}, ${workshop.city}, ${workshop.state}</p>
                        <p>Phone: ${workshop.phone}</p>
                    </div>
                `;
            });
        } else {
            results.innerHTML = '<p>No workshops found in this city.</p>';
        }
    })
    .catch(error => {
        console.error('Error fetching workshops:', error);
        document.getElementById("results").innerHTML = '<p>Error fetching data. Please try again.</p>';
    });
}
