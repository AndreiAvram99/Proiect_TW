<div id=<?php echo $this->get_id();?> class="filter-container">
    
    <div class="filter-container-title">
        <p> <?php echo $this->get_title();?> </p>
    </div>
    
    <div class="filter-container-rows">
        <?php 
            foreach($this->rows as $row)
                $row->show();
        ?>
    </div>
</div>
