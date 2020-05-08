<div class="container-row">
    <label> <?php echo ($this->get_value().' min: ');?>
        <input type="number" name=<?php echo $this->get_name().'_min';?> min="-10000" max="10000"><br>
    </label>
    
    <label> <?php echo ($this->get_value().' max: ');?>
        <input type="number" name=<?php echo $this->get_name().'_max';?> min="-10000" max="10000">
    </label>
</div>