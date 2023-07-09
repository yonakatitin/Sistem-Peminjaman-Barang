// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
fetch('/get/users') // Replace '/api/getData' with the actual endpoint URL
  .then(response => response.json())
  .then(data => {
    var ctx = document.getElementById("barUsers").getContext("2d");

    var labels = Object.keys(data);
    var values = Object.values(data);

    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: "Count",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: values,
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'pengguna'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: 50,
              maxTicksLimit: 5
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });
  })
  .catch(error => {
    // Handle any errors
    console.error(error);
  });
