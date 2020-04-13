<div  class = "event" id="event">
    <div class = "eventHeader">
        <p class = "eventTitle" id="title">
            <?php echo $this->get_title()?>
        </p>
    </div>

    <div class = "eventBody">
        <p class = "eventDescription" id="description">
            <?php echo $this->get_description()?>
        </p>
    </div>

    <div class = "eventFooter">
        <div class = "eventFooterLeft">
            <span class="author">
                <span class="fas fa-user"></span>
                <span>
                    <a class="linkColor" title="Post author" href="#" id="author">
                        <?php echo $this->get_author()?>
                    </a>
                </span>
            </span>
        </div>
        <div class = "eventFooterRight">
            <a href="../HTML/eventDescription.html"><button type="button" class = "eventSeeMoreButton" id = "seeMore"> See more</button></a>
        </div>
    </div>
</div>