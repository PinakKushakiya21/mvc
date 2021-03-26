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
                    <p class="h2 text-center">Media</p><br>
                </h4>
                <form method="post" action="<?php echo $this->getUrl()->getUrl('check', 'media'); ?>">
                    <div class="text-right">
                        <button class="btn btn-warning yellow" type="submit" name="update">Update
                            
                        </button>
                        <button class="btn btn-danger red" type="submit" name="delete">Delete
                            
                        </button>
                    </div>
                    <p class="card-text">
                    <div class="row">

                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Label</th>
                                    <th>Small</th>
                                    <th>Thumb</th>
                                    <th>Base</th>
                                    <th>Gallery</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $imageData = $this->getImageData($this->getRequest()->getGet('id'));
                                $id = $this->getRequest()->getGet('id');
                                    if(!$imageData):
                                    ?>
                                    <tr>
                                        <th colspan="5" class="text-center">No Images Uploaded For This Product</th>                                    
                                    </tr>
                                    <?php
                                        else:
                                        foreach ($imageData->getData() as $key => $value) :
                                    ?>
                                    <tr>
                                        <td><img src="./Media/Images/Product/<?php echo "{$id}/". $value->imageName ?>" height="100px" width="100px" alt=""></td>
                                        <td><input type="text" name="image[<?php echo $value->productGalleryId; ?>][imagelabel]" value="<?php echo $value->imagelabel; ?>"> </td>
                                        <td> 
                                            <label>
                                                <input value="<?php echo $value->productGalleryId; ?>" name="image[small]" type="radio" <?php echo $value->small ? "checked" : "" ?> />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input value="<?php echo $value->productGalleryId; ?>" name="image[thumb]" type="radio" <?php echo $value->thumb ? "checked" : "" ?> />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input value="<?php echo $value->productGalleryId; ?>" name="image[base]" type="radio" <?php echo $value->base ? "checked" : "" ?> />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="image[<?php echo $value->productGalleryId; ?>][gallery]" <?php echo $value->gallery ? "checked" : "" ?> />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="image[<?php echo $value->productGalleryId; ?>][remove]" />
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                <?php 
                                    endforeach;    
                                    endif; 
                                ?>
                            </tbody>

                        </table>

                        </p>
                    </div>

                </form>
                <form method="post" action="<?php echo $this->getUrl()->getUrl('save', 'media'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">

                    </div>
                    <button class="btn btn-primary pink" type="submit" name="add">Upload
                        
                    </button>

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
