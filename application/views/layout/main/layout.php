<!DOCTYPE html>
<html lang="en">
    
    <?php $header->render() ?>

    <body>
    
    <section>   
        
        <?php $head->render() ?>
  
        <div class="mainpanel">

            <?php $headerbar->render()?> 
            
            <?php $pageheader->render()?> 
            
            <div class="contentpanel">

                <?php $content->render()?>
                
            </div><!-- contentpanel -->

        </div><!-- mainpanel -->
      
        <?php $tabpane->render()?>
      
    </section>

    <?php $footer->render()?>
    
    </body>
</html>