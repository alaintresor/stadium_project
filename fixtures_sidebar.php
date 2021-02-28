<!--
@author: Vasilis Tsakiris
-->
 			<div class="listview_1_of_3 images_1_of_3">
					<h3>Live match(es)</h3>	
					<?php
          	 $today=date("Y-m-d");
          	$qry2=mysqli_query($con,"select * from  tbl_concert where status='0' order by rand() limit 3");

          	  while($m=mysqli_fetch_array($qry2))
                   {
                    ?>
         	<div class="content-left">
					<div class="listimg listimg_1_of_2">
						 <img src="images/vs1.jpg">
					</div>
					<div class="text list_1_of_2">
						  <div class="extra-wrap">
						  	<span style="text-color:#000" class="data"><strong><?php ?></strong><br>
						  	<span style="text-color:#000" class="data"><strong>MUKURA VC 0-1 MUHANGA FC<?php ?></strong><br>
                                <div class="data">Ended<?php ?></div>          
                                <span class="text-top">Stadium: Huye Stadium</span>
                          </div>
					</div>
					<div class="clear"></div>
				</div>
					
  	    <?php
  	    	}
  	    	?>
					
					
				
				
					
					
				
				
				
				
				</div>		
				<div class="clear"></div>		
			
