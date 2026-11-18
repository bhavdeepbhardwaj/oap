<!-- <script>
$(function() {
             blinkeffect('.txtblnk');
             })
function blinkeffect(selector) {
                                $(selector).fadeOut('slow', function() {
                                                                        $(this).fadeIn('slow', function() {
                                                                                                           blinkeffect(this);
                                                                                                           }
																					   );
                                                                       } 
												    );
                               }
</script> -->
<section class="">
	<div class="container text-center">
		<blockquote>
		<h2>Welcome to Online Application Portal For Major Ports</h2>
		<footer>Ministry of shipping (Govt. of India)</footer>
		</blockquote>
		<!--<p class="p__mod">
		  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 

			text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
		 It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
		 It was popularised in the 1960s with the release of Letraset
 		sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
		 including versions of Lorem Ipsum.
		</p>-->
		
		
	</div>
	<?php //pr($vacancies); ?>
	<div class="container">
		<div class="row" id="drag">
			<div class="col-md-6">
				<section class="well animated bounceInRight">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<figure class="btn btn-app bg-head-blue">
					    			<i class="fa fa-clock-o font-white"></i>
					
					  		</figure>
						</div>
						<div class="col-md-8 col-xs-8">
							<h3>Vacancy Circulars</h3>
						</div>
				
					</div>	
					<div class="row">
						<div class="col-md-12">
						    <?php foreach ($notices as $notice): ?>
				 			<ul class="todo-list">
							<li><i class="fa fa-clock-o text-yellow"></i><a href="<?php echo h($this->Html->url(array('action'=>'notices'))); ?>"><span class="text"><?php echo ucfirst(h($notice['Notice']['advt_name'])); ?></span></a></li>
						    </ul>
							<?php endforeach; ?>
						</div>
					</div>
				</section>			
			</div>
			<div class="col-md-6">
				<section class="well animated bounceInRight">
					<div class="row">
						<div class="col-md-4 col-xs-4 ">
							<figure class="btn btn-app bg-head-orange">
					    			<i class="fa fa-bell font-white"></i>
					
					  		</figure>
						</div>
						<div class="col-md-8 col-xs-8">
							<h3>Vacancies</h3>
						</div>
				
					</div>
					<div class="row">
						<div class="col-md-12">
				 			<ul class="todo-list clearfix">
							<?php foreach($vacancies as $vacancy):?>
							   
							<li>
							   <i class="fa fa-bell text-yellow"></i>
							   <a href="<?php echo h($this->Html->url(array('action'=>'vacancies'))); ?>">
							   <span class="text"><?php echo ucfirst(h($vacancy['Notice']['advt_name'])); ?></span></a>
							   <span class="text" style="color:rgb(178,73,38)">(Closing Date : <?php echo h(date('d-M-Y',strtotime($vacancy['Notice']['closing_date']))); ?>)</span>
							</li>
						    <?php endforeach;?>
							</ul>
						</div>
					</div>
				</section>
			</div>
			<!--div class="col-md-4">
					<section class="well">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<figure class="btn btn-app bg-head-blue">
					    			<i class="fa fa-bullhorn font-white"></i>
					
					  		</figure>
						</div>
						<div class="col-md-8 col-xs-8">
							<h3>News</h3>
						</div>
				
					</div>
					<div class="row">
						<div class="col-md-12">
				 			<ul class="todo-list">
							<li><i class="fa fa-bullhorn text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bullhorn text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bullhorn text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bullhorn text-yellow"></i> <span class="text">Chrome</span></li>
						      	</ul>
						</div>
					</div>	
				</section>			
			</div-->
		</div>
		<?php echo $this->element('sql_dump'); ?>
	</div>
	</section>