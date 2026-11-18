<div class="row">
    <div class="col-md-12">
	<?php echo $this->Session->flash(); ?>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo __('Edit Page'); ?></h3>
                <div class="asteriskLine"> Fields marked with * are mandatory.</div>
            </div>
                
                <?php echo $this->Form->create('Page', array('role' => "form",'class' => 'jquery-validation')); ?>
                <?php echo $this->Form->input('Page.id',array('type'=>'hidden')); ?>
            <div class="box-body">
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <div>
                                    <label class="text-light-blue">Page Title</label><span class="asterisk">* </span>
                            </div>
                            <?php echo $this->JqueryValidation->input('title', array('placeholder'=>'Page Title', "alphabetspace"=>true,'rangeLength'=>array(2,30),'label'=>false,'class'=>"form-control")); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div>
                                    <label class="text-light-blue">Page Slug</label><span class="asterisk">* </span>
                            </div>
                            <?php echo $this->JqueryValidation->input('slug', array('placeholder'=>'Page Slug', "alphanumeric"=>true,'rangeLength'=>array(2,20),'label'=>false,'class'=>"form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div>
                                    <label class="text-light-blue">Page content</label><span class="asterisk">* </span>
                            </div>
                            <?php echo $this->JqueryValidation->input('content', array('placeholder'=>'Page Content', 'label'=>false,'class'=>"form-control")); ?>
                        </div>
                    </div>
                </div>    
            <div class="row">
			    <div class="col-md-12">
						<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Update</button>							 
						</div>
				</div>
            </div>				
            <?php echo $this->Form->end(); ?>
		  </div>
        </div>
    </div>
</div>
<!--CK Editor -->
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <script type="text/javascript">
      $(function () {
        
        CKEDITOR.replace('PageContent');
        
      });
    </script>