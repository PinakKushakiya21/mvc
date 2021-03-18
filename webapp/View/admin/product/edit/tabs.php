<?php 

  $tabs = $this->getTabs();
  foreach ($tabs as $key => $value):
    
?>
<div class="list-group" >
  <a href="<?php echo  $value['label'] == "Group Price" ? $this->getUrl()->getUrl('index',null,["tab"=>$key])  : $this->getUrl()->getUrl('form',null,["tab"=>$key]); ?>" class="p-4 list-group-item list-group-item-action flex-column align-items-start orange"  style="background-color: #1fb8ff; color:white">
    <p class="mb-1 font-weight-bold"><?php echo $value['label'] ?></p>
  </a>
</div>

<?php endforeach; ?>
