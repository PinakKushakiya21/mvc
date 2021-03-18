<?php
    
    $groupPrice = $this->getProduct();
    $customerGroup = $this->getCustomerGroup();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title">
                    <p class="h2 text-center">Group Price</p><br>
                </h4>
                <form method="post" action="<?php echo $this->getUrl()->getUrl('save','groupPrice'); ?>">
                    <div class="text-left">
                        <button class="btn btn-primary yellow" type="submit" name="update">Update
                            
                        </button>
                    </div>
                    <p class="card-text">
                    <div class="row">

                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>Group ID</th>
                                    <th>Group Name</th>
                                    <th>Price</th>
                                    <th>Group Price</th>
                                   
                                </tr>
                            </thead>
                            <?php 
                                foreach ($customerGroup->getData() as $key => $value):
                                $rowStatusData = $value->entityId ?'Exist':'New';
                            ?>
                            <tbody>
                                    <tr>
                                        <td><?php echo $value->group_id; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td> 
                                        <?php echo $value->price; ?>
                                        </td>
                                        <td>
                                        <input type="text" name="groupPrice[<?php echo $rowStatusData; ?>][<?php echo $value->group_id ?>]" value="<?php echo $value->groupPrice;  ?>"> 
                                        </td>
                                    </tr>
                            </tbody>
                            <?php endforeach; ?>
                        </table>

                        </p>
                    </div>

                </form>
        </div>
        <br>
        <br>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
