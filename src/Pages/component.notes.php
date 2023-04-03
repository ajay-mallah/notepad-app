<div class="notes container">
    <?php if ($notes) { 
        foreach($notes as $note) { ?>
            <div class="note">
                <h4 class="title"><?php echo $note['title'] ? $note['title'] : ""?></h4>
                <p class="content"><?php echo $note['text'] ? $note['text'] : ""?></p>
                <button class="btn btn-outline-primary" <?php echo $note['id'] ? $note['id'] : null ?> id="read-more">read more</button>
            </div>
        <?php }
    }?>
</div>