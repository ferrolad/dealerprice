<div id="adminDashboard">
<?php if(Yii::app()->user->hasFlash('crawler')){ ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('crawler'); ?>
</div>

<?php } ?>
    				<div id="dashboardIcons">
                        <div class="adminIcon" id="categories">
                            <a href="<?=$this->createUrl('/admin/categories/admin')?>">Categories</a>
                        </div>
                        <div class="adminIcon" id="subcategories">
                            <a href="<?=$this->createUrl('/admin/subcategories/admin')?>">Sub-Categories</a>
                        </div>
						<div class="adminIcon" id="productType">
                            <a href="<?=$this->createUrl('/admin/producttype/admin')?>">Product Type</a>
                        </div>
                        <div class="adminIcon" id="brands">
                            <a href="<?=$this->createUrl('/admin/brands/admin')?>">Brands</a>
                        </div>
						<div class="adminIcon" id="stores">
                            <a href="<?=$this->createUrl('/admin/stores/admin')?>">Stores</a>
                        </div>
                        <div class="adminIcon" id="products">
                            <a href="<?=$this->createUrl('/admin/products/admin')?>">Products</a>
                        </div>
						<div class="adminIcon" id="crawler">
                            <a href="<?=$this->createUrl('/admin/default/crawler')?>">Update Inventory</a>
                        </div>
						<div class="adminIcon" id="storeClicks">
                            <a href="<?=$this->createUrl('/admin/affiliatetracking/admin')?>">Store Clicks</a>
                        </div>
                        <div class="adminIcon" id="reviews">
                            <a href="<?=$this->createUrl('/admin/productreviews/admin')?>">Reviews</a>
                        </div>
                        <div class="adminIcon" id="users">
                            <a href="<?=$this->createUrl('/admin/users/admin')?>">Users</a>
                        </div>
						 <div class="adminIcon" id="systemUsers">
                            <a href="<?=$this->createUrl('/admin/users/systemusers')?>">System Users</a>
                        </div>
                        <div class="adminIcon" id="emailList">
                            <a href="<?=$this->createUrl('/admin/newsletter/admin')?>">Email List</a>
                        </div>
                        <div class="adminIcon" id="config">
                            <a href="<?=$this->createUrl('/admin/settings/admin')?>">Config</a>
                        </div>
                        <div class="adminIcon" id="sms">
                            <a href="<?=$this->createUrl('/admin/messages/sms')?>">SMS</a>
                        </div>
                        <div class="adminIcon" id="emailAdmin">
                            <a href="<?=$this->createUrl('/admin/messages/email')?>">Email</a>
                        </div>
                        <div class="adminIcon" id="submitTicket">
                            <a href="<?=$this->createUrl('/admin/messages/ticket')?>">Submit Ticket</a>
                        </div>
						<div class="adminIcon" id="sms">
                            <a href="<?=$this->createUrl('/admin/pushnotification/notification')?>">Push Notification</a>
                        </div>
                        <div style="clear:both;"></div>
    				</div>
</div>
