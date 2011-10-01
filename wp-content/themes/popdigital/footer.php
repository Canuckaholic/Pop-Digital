
    </div><!-- #main -->
    
    <?php
    
    // action hook for placing content above the footer
    thematic_abovefooter();
    
    ?>    

	<div id="footer_wrapper">
    <div id="footer">
    
        <?php
        
        // action hook creating the footer 
        thematic_footer();
        
        ?>
        
	</div><!-- #footer -->
    </div><!-- #footer_wrapper -->
	
    <?php
    
    // action hook for placing content below the footer
    thematic_belowfooter();
    
    if (apply_filters('thematic_close_wrapper', true)) {
    	echo '</div><!-- #wrapper .hfeed -->';
    }
    
    ?>  

<?php 

// calling WordPress' footer action hook
wp_footer();

// action hook for placing content before closing the BODY tag
thematic_after(); 

?>

</body>
</html>