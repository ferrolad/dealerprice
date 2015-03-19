<!-- End of Header -->
            <div id="pageHeader">
                <div id="innerPageHeader">
                    <div id="mainMenuBtn">
                        <span id="allCatBtn">
                            <i class="fa fa-th-large"></i><a href="#">All Categories</a>
                        </span>
                    </div>
                    <!-- End of Main Menu Button -->
                    <div id="breadcrumb">

						<div id="breadcrumbItm">
                            <span id="bcPnt"><?=CHtml::link("Home", array('/site/index')); ?></span> <span class="nextItm">&gt;</span> <span class="bcItm lastItm"><?=CHtml::link('My Account', array('/customer/default/index')); ?></span>
                        </div>
						
                    </div>
                    <!-- End of Breadcrumb -->
                </div>    
            </div>
            <div id="pageMegaMenu">
                <div id="megaMenu" class="pageMenu">
               		<?php $this->beginContent('//layouts/mega-menu'); $this->endContent(); ?>
                </div>  
                <!-- End of Mega Menu -->
            </div>
            <!-- End of Menu and Slider -->
			<div id="pageContents" class="page">
                <div id="menuPanel">
                    <div id="menuPanelItems">
                    	<ul>
                            <li><a href="<?=$this->createUrl('/customer/default/index')?>">My Account</a></li>
                            <li><a href="<?=$this->createUrl('/customer/default/wishlist')?>">Wishlist</a></li>
                            <li><a href="<?=$this->createUrl('/site/logout')?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div id="contentPanel">
                    <div id="panelContents">
                        <div id="contentPanelMenu">
                            <ul>
                                <li><a href="<?=$this->createUrl('/customer/default/index')?>" >Personal Details</a></li>
                                <li><a href="<?=$this->createUrl('/customer/default/changepass')?>"  id="actCntPnlMenu">Change Password</a></li>
                                <li><a href="<?=$this->createUrl('/customer/default/changemail')?>">Change Email</a></li>
                            </ul>
                        </div>
                        <div id="errorSum"></div>
                        <?php $u= Users::model()->with('profiles')->findByPk(Yii::app()->user->id); ?>
                        <form id="personalDetails" class="accountForms" method="post" action="<?=$this->createAbsoluteUrl('/customer/default/changepass')?>">
                        	<label><span>Email</span>
                            <input type="email" id="email" name="email" required readonly value="<?=$u->email?>" class="readOnlyInput"></label>
                        	<label><span>Old Password*</span>
                            <input type="password" id="oldPassword" name="old_password" required value="<?=$u->provider != 'Own' ? $u->password : ''?>"></label>
                            <label><span>New Password*</span>
                            <input type="password" id="newPassword" name="new_password" required></label>
                            <label><span>Retype New Password*</span>
                            <input type="password" id="rNewPassword" name="r_new_password" required></label>
<?php echo CHtml::ajaxSubmitButton('SAVE CHANGES',CHtml::normalizeUrl(array('/customer/default/changepass')),
             array(
                 'dataType'=>'json',
                 'type'=>'post',
                 'success'=>'function(data) {
                    $("#submitProfile").removeAttr("disabled");
                    if(data.status=="success")
                    $("#errorSum").text("Password successfully updated but changes will reflect next time.").css({"color": "green", "display":"block"}).delay(5000).fadeOut();
                    else
                    $("#errorSum").text("Something went wrong.").css({"color": "red", "display":"block"}).delay(3000).fadeOut();
                }',
                'beforeSend'=>'function(){ if($("#newPassword").val().length < 6) {                                                  $("#errorSum").text("Password is very short.").css({"color": "red", "display":"block"}).delay(3000).fadeOut();                                     return false; }                                                                                                    $("#submitProfile").attr("disabled","disabled");  }'),array('id'=>'submitProfile','class'=>'accSubmits', 'name'=>'submitAcc')); ?>
                        </form>
                    </div>
                </div>
			</div>
			<!-- End of Page Contents -->