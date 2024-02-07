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
        <h1 class="text-center">The Table of Content</h1>
    </div>
    <div class="container d-flex align-items-baseline my-3 justify-content-between">
            <div id="filter" class="d-flex align-items-baseline gx-2 col-1" style="cursor:pointer">
                <img src="filter.svg" class="img-fluid" alt="Filter">
                <p>Filter</p>
            </div>
            <div class="col-7">
                <form action="/api/filter" class="d-flex justify-content-between visually-hidden" id="filtering">
                        <div>
                            <label for="payment_type">Payment type:</label>
                            <select name="payment_type" id="payment_type" class="form-select">
                                <option value="all" selected>All</option>
                                <?php foreach ($paymentTypeData as $row) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="currency">Currency:</label>
                            <select name="currency" id="currency" class="form-select">
                                <option value="all" selected>All</option>
                                <?php foreach ($currencyData as $row) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="type">Type:</label>
                            <select name="type" id="type" class="form-select">
                                <option value="all" selected>All</option>
                                <option value="Income">Income</option>
                                <option value="Expense">Expense</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                </form>
            </div>
            <div class="d-flex justify-content-end col-4">
                <a href="/payment" class="btn btn-primary">Add Payment</a>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <table class="table table-striped my-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Payment type</th>
                    <th scope="col">Currency</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Type</th>
                    <th scope="col">Feedback</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <th scope="row"><?= $row['id'] ?></th>
                        <td><?= $row['payment_type_name'] ?></td>
                        <td><?= $row['currency_name'] ?></td>
                        <td><?= $row['amount'] ?></td>
                        <td><?= $row['type'] ?></td>
                        <td><?= $row['feedback'] ?></td>
                        <td><?= $row['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <th>Total</th>
                        <td></td>
                        <td></td>
                        <!-- if the value of balance is less than 0 make it red otherwise green -->
                        <td class="<?= $balance < 0 ? 'text-danger' : 'text-success' ?>"><?= $balance ?></td>
                    </tr>
            </tbody>
    </div>

</body>
</html>


<script>
    // After cliking to filter div show all filters
    document.getElementById('filter').addEventListener('click', function() {
        document.getElementById('filtering').classList.toggle('visually-hidden');
    });

    // After submitting the form send the data to the server
    $('#filtering').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: new FormData(this),
            cache: false,
            success: function(data)
            {
                location.reload();
            }
        });
    })

</script>