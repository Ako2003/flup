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
        <h1 class="text-center">Create a payment</h1>

    </div>
    <div class="container my-5">
        <form action="/api/payment" autocomplete="off" enctype="multipart/form-data" id='add_payment' method="post">
            <div class="container">
                <div class="my-5 justify-content-evenly row">
                    <section class="col-6">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.1" class="form-control" id="amount" name="amount" required>
                    </section>
                </div>
                <div class="mb-3 justify-content-evenly row">
                    <select class="col-3" id="payment_type_id" name="payment_type_id" class="form-select">
                    </select>
                    <select class="col-3" id="currency_id" name="currency_id" class="form-select">
                    </select>
                    <select class="col-3" id="type" name="type" class="form-select">
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                    </select>
                </div>
                <div class="mb-3 justify-content-evenly row">
                    <section class="col-6">
                        <label for="feedback" class="form-label">Feedback</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
                    </section>
                </div>
                <div class="text-center my-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Fetch Payment Types
    fetch('http://localhost:8080/api/payment-type')
        .then(response => response.json())
        .then(data => {
            data.forEach(payment_type => {
                var option = document.createElement('option');
                option.value = payment_type.id;
                option.text = payment_type.name;
                document.getElementById('payment_type_id').appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching payment types:', error));

    // Fetch Currencies
    fetch('http://localhost:8080/api/currency')
        .then(response => response.json())
        .then(data => {
            data.forEach(currency => {
                var option = document.createElement('option');
                option.value = currency.id;
                option.text = currency.name;
                document.getElementById('currency_id').appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching currencies:', error));
});


    $('#add_payment').submit(function(e){
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
                alert('Payment added successfully');
                location.reload();
            }
        });
    });
</script>