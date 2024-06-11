$(document).ready(function(){
    loadEmployees();

    function loadEmployees() {
        $.ajax({
            url: 'modelo/get_employees.php',
            method: 'POST',
            success: function(response) {
                $('#employeeTable tbody').html(response);
            }
        });
    }
});

$(document).ready(function() {
    function fetchEmployees(search = '') {
        $.ajax({
            url: 'modelo/get_employees.php',
            type: 'GET',
            data: { search: search },
            success: function(data) {
                $('#employeeTable tbody').html(data);
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }

    // Fetch initial data
    fetchEmployees();

    // Search employees
    $('#searchInput').on('keyup', function() {
        let search = $(this).val();
        fetchEmployees(search);
    });
});
