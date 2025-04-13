<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Tareas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   
</head>
<body>

<div class=" col form-group">

    <h1>Tareas del Usuario</h1>
    
    <div class="col row">
        <label for="labeluserId"><strong> Nro usuario a buscar: </strong></label> &nbsp;
        <input type="number" class="form-control col-sm-2" id="userId" placeholder="ID del Usuario">&nbsp;
        <button class="btn btn-outline-info" onclick="getTasks()">
            Obtener Tareas
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </div>
    
    <div class="col">
        <table border="1" id="taskTable" style="margin-top:20px;" class="table">
            <thead class="thead-light">
                <tr>
                    <th>Proyecto</th>
                    <th>Descripción</th>
                    <th>Horas</th>
                    <th>Tarifa</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        function getTasks() {
            let userId = $('#userId').val();
            $.ajax({
                url: `../api/get_user_tasks.php?user_id=${userId}`,
                method: 'GET',
                success: function(data) {
                    let rows = '';
                    data.forEach(task => {
                        rows += `
                            <tr>
                                <td>${task.project_name}</td>
                                <td>${task.task_description}</td>
                                <td>${task.hours_worked}</td>
                                <td>$${task.rate}</td>
                                <td>$${task.total_value}</td>
                            </tr>
                        `;
                    });
                    $('#taskTable tbody').html(rows);
                },
                error: function(err) {
                    alert("Error obteniendo tareas");
                }
            });
        }
    </script>

</div>

</body>
</html>
