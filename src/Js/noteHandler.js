$(document).ready(function() {
    
    $("#add-note").click(function(event) {
        event.preventDefault();
        var formData = $(".notepad-form").serializeArray();
        console.log(formData);

        // Form validation
        var isEmpty = false;
        var data = {};
        formData.forEach(el => {
            if (!el.value) {
                isEmpty = true;
                return;
            }
            data[el.name] = el.value;
        });
        if(isEmpty) {
            addResponseMessage("Please fill all the empty filed", "text-danger");
        }
        else {
            $.post(
                '/addNote.php',
                data,
                function(data, success) {
                    data = JSON.parse(data);
                    if (data.status === 'success') {
                        addResponseMessage(data.message, "text-success");
                        setTimeout(function() {
                            window.location.href = "/index.php";
                        }, 500)
                    }
                    else if (data.status === 'failed') {
                        addResponseMessage(data.message, "text-danger");
                    }
                    else {
                        window.location.href = "/error.php";
                    }
                }
            )
        }

    });

    $("#update-note").click(function(event) {
        event.preventDefault();
        var formData = $(".notepad-form").serializeArray();
        console.log(formData);

        // Form validation
        var isEmpty = false;
        var data = {};
        formData.forEach(el => {
            if (!el.value) {
                isEmpty = true;
                return;
            }
            data[el.name] = el.value;
        });
        if(isEmpty) {
            addResponseMessage("Please fill all the empty filed", "text-danger");
        }
        else {
            $.post(
                '/updateNote.php',
                data,
                function(data, success) {
                    data = JSON.parse(data);
                    if (data.status === 'success') {
                        addResponseMessage(data.message, "text-success");
                        setTimeout(function() {
                            window.location.href = "/index.php";
                        }, 500)
                    }
                    else if (data.status === 'failed') {
                        addResponseMessage(data.message, "text-danger");
                    }
                    else {
                        window.location.href = "/error.php";
                    }
                }
            )
        }

    });

    $("#delete-note").click(function(event) {
        event.preventDefault();
        var formData = $(".notepad-form").serializeArray();
        console.log(formData);

        // Form validation
        var isEmpty = false;
        var data = {};
        formData.forEach(el => {
            if (!el.value) {
                isEmpty = true;
                return;
            }
            data[el.name] = el.value;
        });
        if(isEmpty) {
            addResponseMessage("Please fill all the empty filed", "text-danger");
        }
        else {
            $.post(
                '/deleteNote.php',
                data,
                function(data, success) {
                    data = JSON.parse(data);
                    if (data.status === 'success') {
                        addResponseMessage(data.message, "text-success");
                        setTimeout(function() {
                            window.location.href = "/index.php";
                        }, 500)
                    }
                    else if (data.status === 'failed') {
                        addResponseMessage(data.message, "text-danger");
                    }
                    else {
                        window.location.href = "/error.php";
                    }
                }
            )
        }
    });

    $(".read-more").click(function(event) {
        var data = {};
        data.note_id = $(this).attr("note_id");
        $.post(
            '/readMore.php',
            data,
            function(data, success) {
            }
        )
    });

    function addResponseMessage(message, cssClass) {
        $("#response-msg").html(message);
        $("#response-msg").removeClass("text-danger");
        $("#response-msg").removeClass("text-success");
        $("#response-msg").addClass(cssClass);
        if (cssClass == "text-success") {
            setTimeout(function() {
                $("#response-msg").html("");
            },5000);
        }
    }
})