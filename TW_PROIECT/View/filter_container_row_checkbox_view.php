<div class="container-row">
    <label class="check-box-style"> <?php echo $this->get_value()?>
        <input type="checkbox" name=<?php echo $this->get_name();?> value=<?php echo $this->get_value();?> 
                                    <?php if ($this->get_value() == 'All') echo "checked='checked'"; ?>
        >
        <span class="box-checkmark"></span>
    </label>
</div>