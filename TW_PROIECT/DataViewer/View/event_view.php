<link rel="stylesheet" type="text/css" href="../CSS/components_style/event_style.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src = "https://kit.fontawesome.com/a076d05399.js"></script>

<div  class = "event">
    <div class = "event-header">
        <p class = "event-title">
            <?php echo $this->get_title()?>
        </p>
    </div>

    <div class = "event-body">
        <p class = "event-description">
            <?php echo $this->get_description()?>
        </p>
    </div>

    <div class = "event-footer">
        <div class = "event-footer-left">
            <span class="author">
                <span class="fas fa-user"></span>
                <span>
                    <a class="link-color" title="Post author" href="#">
                        <?php echo $this->get_author()?>
                    </a>
                </span>
            </span>
        </div>
    </div>
</div>