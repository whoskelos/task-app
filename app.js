$(function () {
    let edit = false;
    console.log("Jquery is working!");
    //pinto todas las tareas al iniciar la app
    showTasks();
    $("#task-result").hide();
    //evento para el buscador
    $("#search").keyup(() => {
        if ($("#search").val()) {
            let search = $("#search").val();
            $.ajax({
                url: "task-search.php",
                type: "POST",
                data: { search },
                success: function (response) {
                    searchTask(response);
                },
            });
        }
    });

    //evento para add tarea
    $("#task-form").submit((e) => {
        let taskName = $("#name").val();
        let taskDescription = $("#description").val();
        let url = edit === false ? "task-add.php" : "task-edit.php";
        if (taskName != "" && taskDescription != "") {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    name: taskName,
                    description: taskDescription,
                    id: $("#taskId").val(),
                },
                success: function (response) {
                    $("#task-form").trigger("reset");
                    showTasks();
                },
            });
        }
        e.preventDefault();
    });

    function searchTask(data) {
        let tasks = JSON.parse(data);
        let template = "";
        tasks.forEach((task) => {
            template += `<li>${task.name}</li>`;
        });
        $("#container").html(template);
        $("#task-result").show();
    }

    function showTasks() {
        $.ajax({
            url: "task-list.php",
            type: "GET",
            success: function (response) {
                let tasks = JSON.parse(response);
                let template = "";
                tasks.forEach((task) => {
                    template += `<tr taskId="${task.id}">
                        <td>${task.id}</td>
                        <td><a href="#" class="task-item">${task.name}</a></td>
                        <td>${task.description}</td>
                        <td>
                            <button class="btn btn-danger task-delete"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>`;
                    $("#tasks").html(template);
                });
            },
        });
    }

    //evento para eliminar tarea
    $(document).on("click", ".task-delete", function () {
        if (confirm("Are you sure you want to delete it?")) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr("taskId");
            $.post("task-delete.php", { id }, function (response) {
                console.log(response);
                showTasks();
            });
        }
    });

    //evento para editar
    $(document).on("click", ".task-item", function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr("taskId");
        $.post("task-single.php", { id }, function (response) {
            let task = JSON.parse(response);
            $("#name").val(task.name);
            $("#description").val(task.description);
            $("#taskId").val(task.id);
            edit = true;
        });
    });
});
