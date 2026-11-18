<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php 
if($this->Session->read('Auth.User.id')>0)
$this->layout = 'default'; 
else

$this->layout = 'home'; 

?>
<?php 
if(!($this->Session->read('Auth.User.id')>0))
{
?>
<div class="container">
	<section class="content">
<?php
}
?>	
		<div class="box box-warning">
			<div class="box-header">
				<h4><?php echo $message; ?></h4>
			</div>
			<div class="box-body">
			
				<div class="callout callout-danger ">
					<p>
					<strong><?php echo __d('cake', 'Error'); ?>: </strong>
					<?php echo __d('cake', 'An Internal Error Has Occurred.'); ?>
					</p>
				</div>
				<?php
				if (Configure::read('debug') > 0):
					echo $this->element('exception_stack_trace');
				endif;
				?>
			</div>
		</div>
<?php 
if(!($this->Session->read('Auth.User.id')>0))
{
?>		
	</section>
</div>

<?php
}
?>


