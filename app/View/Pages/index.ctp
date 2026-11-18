<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">All Pages</h3>
            </div>
            <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">   
                            <table class="table table-bordered">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Page Title</th>
                                    <th>Slug</th>
                                    <th>Page Content</th>
                                   
                                    <th>Actions</th>
                                </tr>
                                <?php
                                $page = $this->request->params['paging']['Page']['page'];
                                $limit = $this->request->params['paging']['Page']['limit'];
                                $srno = ($page-1) * $limit;
                                //$srno=1;
                                foreach($pages as $page)
                                {
                                     $srno++;
                                ?>
                                <tr>
                                    <td><?php echo $srno;?></td>    
                                    <td>
                                        <?php 
                                        
                                        
                                         echo $page['Page']['title'];
                                         ?>
                                    </td>
                                    <td><?php echo $page['Page']['slug']?></td>
                                    <td><?php
                                    echo $this->Text->truncate(
                                                                   $page['Page']['content'],
                                                                    50,
                                                                    array(
                                                                        'ellipsis' => '...',
                                                                        'exact' => true
                                                                    )
                                                                    );
                                   ?></td>
                                   
                                    <td>
                                          <?php
                                            if($this->Session->read('ACL1.Pages.edit') )
                                            {?>
                                            <?php echo $this->Html->link(false, array('action' => 'edit', $page['Page']['id']), array( 'class'=>"fa fa-fw fa-edit",'title'=>'Edit Page Details')); ?>
                                            <?php
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <?php
                                   
                                }
                                ?>
                            </table>
                            <?php if($this->params['paging']['Page']['pageCount'] > 1){ ?>
				<div class="row">
                                    <div class="col-md-12">
					<div class="pull-right">
						<div class="paging_bootstrap">
							<ul class="pagination">
								<?php
								echo $this->Paginator->first("First", array('escape' => false, 'tag' => 'li'),  '<a href="#">First</a>', array('class' => 'first disabled', 'escape' => false, 'tag' => 'li'));
								echo $this->Paginator->prev("&larr; Previous", array('escape' => false, 'tag' => 'li'), '<a href="#">&larr; Previous</a>', array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));

								echo '&nbsp;' . $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active','currentTag'=>'a href="#"'));
								echo $this->Paginator->next("Next &rarr;", array('escape' => false, 'tag' => 'li'), '<a href="#">Next &rarr;</a>', array('class' => 'next disabled', 'escape' => false, 'tag' => 'li'));
								echo $this->Paginator->last("Last", array('escape' => false, 'tag' => 'li'), '<a href="#">Last</a>', array('class' => 'last disabled', 'escape' => false, 'tag' => 'li'));
								?>
							</ul>
						</div>
					</div>
                                    </div>
				</div>
				<?php } ?>
                        </div>
                    </div>    
                </div>
        </div>
    </div>
</div>