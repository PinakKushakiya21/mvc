
<!doctype html>
<html lang="en">
  <head>
    <title>Add Customer</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"> </script> 
        <script src="https://cdn.tiny.cloud/1/krxtmava3rbfbh6xktd048nd8i41usepo5kmtnbrksyew15w/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>  
    
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name'
    });
</script>
  </head>
  <body>
    <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post">
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
                  <p class="h2 text-center">Update CMS Page Details</p><br>
            <?php else: ?>
                    <p class="h2 text-center">Add CMS Page Details</p><br>
            <?php endif;?>
            </h4>
            <?php $cms = $this->getCms(); ?>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s4">
                    <input id="fname" name="cms[title]" value="<?php echo $cms->title ?>" type="text" class="validate">
                    <label for="fname">Title</label>
                    </div>
                    <div class="input-field col s4">
                    <input id="lname" id="identifier " name="cms[identifier]" value="<?php echo $cms->identifier ?>" type="text" class="validate">
                    <label for="lname">Last Name</label>
                    </div>
                    <div class="input-field col s4">
                        <div class="switch">
                            <label>
                            Disabled
                            <?php if($cms->status):
                                    $label = 'checked'; 
                                else:
                                        $label = '!checked';  
                                endif;
                                ?>
                            <input name='customer[status]' type='checkbox'  name='cms[status]'  <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col s12">
                            <label for="content"></label>
                            <textarea id="content" name="cms[content]" class="form-control"><?php echo $cms->content; ?></textarea>               
                    </div>
                </div>

                  
                <?php if(!$this->getRequest()->getGet('id')): ?>
                <button class="btn btn-primary" type="submit" name="add">Add CMS Page
                    
                </button>
                <?php else: ?>
                  <button class="btn btn-warning" type="submit" name="add">Update CMS Page
                   
                </button>
                <?php endif; ?>
                <button class="btn btn-danger" type="reset" name="cancel">Cancel
                   
                </button>
                </div>
            </div>  
            </p>
          </div>
        </div>
    </div>
    </form>
 
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
