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
        <div class="notes container">
            <?php if ($note) { ?>
                <div class="note">
                    <h4 class="title"><?php echo $note['title'] ? $note['title'] : ""?></h4>
                    <p class="content"><?php echo $note['text'] ? $note['text'] : ""?></p>
                    <button class="btn btn-outline-primary" <?php echo $note['id'] ? $note['id'] : null ?> id="update">update</button>
                    <button class="btn btn-outline-primary" <?php echo $note['id'] ? $note['id'] : null ?> id="delete">delete</button>
                </div>
                <?php 
            }?>
        </div>
    </div>
</body>
</html>