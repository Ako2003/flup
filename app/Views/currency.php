<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="container">
        <?php
            include 'navbar/navbar.php';
        ?>
    </nav>

    <div class="container">
        <h1 class="text-center">Create a currency</h1>
    </div>
    <div class="container">
        <form action="/api/currency" id='add_currency' method="post">
            <div class="container">
                <div class="mb-3">
                    <label for="currency" class="form-label text-center">Currency</label>
                    <input type="text" class="form-control" id="currency" name="currency" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<script>
    $('#add_currency').submit(function(e){
        e.preventDefault();
        var url = $(form).attr('action');
        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: new FormData(this),
            cache: false,
            success: function(data)
            {
                alert('Currency added successfully');
                location.reload();
            }
        });
    });
</script>