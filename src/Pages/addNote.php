<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="./src/Js/authenticate.js"></script>
</head>
<body>
    <div class="form-container container d-flex justify-content-center align-items-center">
        <form action="/addNote.php" class="notepad-form d-flex flex-column justify-content-start align-items-start">
            <p class="error text-danger" id="response-msg"></p>
            <label for="title">title</label>
            <input type="text" name="title">
            <label for="text">Content</label>
            <textarea name="text" id="content" cols="30" rows="10"></textarea>
            <button type="submit" id="addNote" class="btn btn-outline-primary">create</button>
        </form>
    </div>
</body>
</html>