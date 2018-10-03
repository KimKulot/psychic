<?= html_entity_decode($content) ?>
<div id="wrapper">
    <figure>
        <div class="mis-stage">
            <ol class="mis-slider">
                <?php foreach($readers as $reader) { 
                    $reader_name = strtolower($reader['username']);?>
                <li class="mis-slide">
                    <a href="/readers/<?php echo $reader['id'];?>" class="mis-container">
                        <figure>
                            <img id="<?php echo $reader_name;?>" src="/public_html/images/readers/slider/<?php echo $reader_name . ".png";?>" alt="<?php echo $reader_name; ?>" width="180" height="240">
                            <figcaption><?php echo $reader['username']; ?><br/>PIN: <?php echo $reader['pin']; ?></figcaption>
                        </figure>
                    </a>
                </li>

                <?php }?>

            </ol>
        </div>
    </figure>
</div>
<?= html_entity_decode($content2) ?>

