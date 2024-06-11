$(document).ready(function(){
    loadEmployees();

    function loadEmployees() {
        $.ajax({
            url: 'modelo/get_employees.php',
            method: 'POST',
            success: function(response) {
                $('#employeeTable').html(response);
            }
        });
    }
});

