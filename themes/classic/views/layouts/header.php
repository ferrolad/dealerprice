	<div class="header">	
      <div class="container"> 
      	<div class="header-top">
 			<div class="search" style="display: none;">
		        <form action="<?=$this->createUrl('/site/search')?>">
		           	<input type="text" name='q' value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" class="text">
					<input type="hidden" name='cat' value="all">
		            <input type="submit" value="">
		       </form>
		       <div class="close"><img src="<?=Yii::app()->theme->baseUrl?>/mob/images/search_close.png"></div>
		    </div>
   			<div class="logo"><a href="<?=$this->createUrl('/site/index')?>"><img src="<?=Yii::app()->theme->baseUrl?>/mob/images/logo.png" alt=""></a></div>
     		<div class="right"><button> </button></div>
		      <div class="clear"></div>
		    <script type="text/javascript">
		       $('.search').hide();
		        $('button').click(function (){
		            $('.search').show();
		            $('.text').focus();
		        }
		        );
		        $('.close').click(function(){
		            $('.search').hide();
		        });
		    </script>
	  </div>
	  <div id="page">
		<div id="header_nav">
			<a href="#menu"></a>
		</div>
	    <?php include('side-menu.php'); ?>
	   </div>
	 </div>     
	</div>