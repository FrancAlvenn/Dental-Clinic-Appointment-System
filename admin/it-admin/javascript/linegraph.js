$(document).ready(function(){
    loadAppointmentTrend();
});

function loadAppointmentTrend(){
    $.ajax({
        url : "http://localhost/DentalClinicAppointment_SAD/admin/php/appointment-trend.php",
        type : "GET",
        success : function(data){
            var currentDate = new Date();
            var currentMonth = currentDate.getMonth() + 1;
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var currentMonthName = months[currentDate.getMonth()];


            let _month = [];
            let _total_appointments = [];
            let _confirmed_appointment = [];
            let _pending_appointment = [];

            for(let i in data) {
                _month.push(data[i].month);
                _total_appointments.push(data[i].total_appointment);
                _confirmed_appointment.push(data[i].confirmed_appointment);
                _pending_appointment.push(data[i].pending_appointment);
				if(data[i].month == currentMonthName){
					let totalAppointment = document.getElementById("total_appointments"),
					confirmedAppointment = document.getElementById("confirmed_appointments"),
					pendingAppointment = document.getElementById("pending_appointments");

					totalAppointment.innerHTML = data[i].total_appointment;
					confirmedAppointment.innerHTML = data[i].confirmed_appointment;
					pendingAppointment.innerHTML = data[i].pending_appointment;
				}
            }


            // Update chart data
            LineGraph.data.labels = _month;
            LineGraph.data.datasets[0].data = _total_appointments;
            LineGraph.data.datasets[1].data = _confirmed_appointment;
            LineGraph.data.datasets[2].data = _pending_appointment;

            // Redraw the chart
            LineGraph.update();
        },
        error : function(data) {

        }
    });
}

// Initialize the chart
let ctx = $("#mycanvas");
let LineGraph = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: "Total Appointments",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "rgba(59, 89, 152, 1)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
            data: []
        }, {
            label: "Confirmed Appointments",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(104, 205, 86, 0.75)",
            borderColor: "rgba(104, 205, 86, 1)",
            pointHoverBackgroundColor: "rgba(104, 205, 86, 1)",
            pointHoverBorderColor: "rgba(104, 205, 86, 1)",
            data: []
        }, {
            label: "Pending Appointments",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(211, 72, 54, 0.75)",
            borderColor: "rgba(211, 72, 54, 1)",
            pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
            pointHoverBorderColor: "rgba(211, 72, 54, 1)",
            data: []
        }]
    },
    options: {
        responsive: true,
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Month (2024)'
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true // Ensure y-axis starts at 0
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Count'
                }
            }]
        }
    }
});

// Set interval to update the graph data every 5 seconds
setInterval(loadAppointmentTrend, 500);
