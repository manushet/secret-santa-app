<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Secret Santa App</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1 class="mt-5">Add Participants</h1>
            <form method="post">
                <div class="form-group">
                    <textarea class="form-control" id="emails" name="emails" rows="3" placeholder="Input email addresses of participants"></textarea>
                    <p class="small text-muted">Please use a space, line break, or any of the given symbols <,;> as a delimiter</p>
                </div>
                <button type="submit" class="btn btn-primary">Generate pairs</button>
            </form>
            
            <h3 class="mt-5">Secret Santa Pairs</h3>
            <div class="list-group">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php elseif (isset($pairs) && !empty($pairs)): ?>
                    <?php foreach ($pairs as $pair): ?>
                        <a href="#" class="list-group-item list-group-item-action">
                            <?= $pair['gifter'] ?> send gift to <?= $pair['receiver']?>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">The list is empty. To create a list of Secret Santa participants, please, enter more than 1 email addresses and press "Generate pairs" button.</p>    
                <?php endif; ?>
            </div> 
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>