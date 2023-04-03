$(document).ready(function() {
    $("#addNote").click(function(event) {
        event.preventDefault();
        var formData = $(".notepad-form").serializeArray();

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
            console.log(data);
            return ;
            $.post(
                '/notepad/create',
                data,
                function(data, success) {
                    console.log(data);
                    if (data.status === 'success') {
                        addResponseMessage(data.message, "text-success");
                        setTimeout(function() {
                            window.location.href = "/";
                        }, 300)
                    }
                    else if (data.status === 'failed') {
                        addResponseMessage(data.message, "text-danger");
                    }
                    else {
                        window.location.href = "/error";
                    }
                }
            )
        }

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