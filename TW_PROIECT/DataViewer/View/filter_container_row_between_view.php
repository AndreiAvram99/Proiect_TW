<div class="container-row">
    <label> <?php echo ($this->get_value().' min: ');?>
        <input type="number" name=<?php echo $this->get_name().'_min';?>
                             value=<?php echo $this->get_min();?> 
                             min=<?php echo $this->get_min();?>
                             max=<?php echo $this->get_max();?>
                             step="0.00001"
        >
    <br>
    </label>
    
    <label> <?php echo ($this->get_value().' max: ');?>
        <input type="number" name=<?php echo $this->get_name().'_max';?> 
                             value=<?php echo $this->get_max();?> 
                             min=<?php echo $this->get_min();?>
                             max=<?php echo $this->get_max();?>
                             step="0.00001"
        >
    </label>
</div>