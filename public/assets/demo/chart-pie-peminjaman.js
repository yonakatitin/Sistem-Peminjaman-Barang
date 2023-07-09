// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("piePeminjaman").getContext("2d");

fetch('/get/peminjaman') // Replace '/api/getData' with the actual endpoint URL
  .then(response => response.json())
  .then(data => {
    var labels = Object.keys(data);
    var values = Object.values(data);

    var backgroundColors = ['#007bff', '#dc3545', '#ffc107', '#28a745', '#6c757d']; // Adjust colors as needed

    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: backgroundColors.slice(0, labels.length),
        }],
      },
    });
  })
  .catch(error => {
    // Handle any errors
    console.error(error);
  });