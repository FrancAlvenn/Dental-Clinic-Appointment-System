$(document).ready(function(){
	$.ajax({
		url : "http://localhost/DentalClinicAppointment_SAD/admin/followersdata.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var _month = [];
			var _total_appointments = [];
			var _new_patient_appointment = [];
			var _followup_appointments = [];

			var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

			for(var i in data) {
				_month.push(months[i]);
				_total_appointments.push(data[i].total_appointments);
				_new_patient_appointment.push(data[i].new_patient_appointment);
				_followup_appointments.push(data[i].followup_appointments);
				console.log(_month[i], _total_appointments[i], _new_patient_appointment[i], _followup_appointments[i]);
			}

			var chartdata = {
				labels: _month,
				datasets: [
					{
						label: "Total Appointments",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: _total_appointments
					},
					{
						label: "New Patient Appointments",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(29, 202, 255, 0.75)",
						borderColor: "rgba(29, 202, 255, 1)",
						pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
						pointHoverBorderColor: "rgba(29, 202, 255, 1)",
						data: _new_patient_appointment
					},
					{
						label: "Follow-up Appointments",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(211, 72, 54, 0.75)",
						borderColor: "rgba(211, 72, 54, 1)",
						pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
						pointHoverBorderColor: "rgba(211, 72, 54, 1)",
						data: _followup_appointments
					}
				]
			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
					responsive: true,
					scales: {
						xAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Month'
							}
						}],
						yAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Count'
							}
						}]
					}
				}
			});
		},
		error : function(data) {

		}
	});
});