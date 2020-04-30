<div  id=<?php echo $this->get_id();?> class="filter-container">
    <?php 
        foreach($this->rows as $row)
            $row->show();
    ?>
</div>
