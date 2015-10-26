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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
    <title>Mad Doll Tees - <?php echo $title_for_layout; ?></title>

	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');


    echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link('Log in', array('admin' => false,'controller'=>'users','action'=>'login')); ?>
            or
            <?php echo $this->Html->link('Create an Account', array('admin' => false,'controller'=>'users','action'=>'register')); ?>
            <div id="right">
                <?php echo $this->Html->link(
                    $this->Html->image("cart2.jpg",array('height'=>'15')).''._(' Cart:'.$count.' Items'),
                    array('controller'=>'carts', 'action' => 'view'), array('escape' => false));?>

   <!--
    <input type="text" value="" name="data['Item']['title']" />
    <button>Search</button>

    -->

        <?php
        $formOptions=array(
            'div'=>false,'id'=>false,
                           'require'=>false,
                            );
    echo $this->form->create('Item', array('action'=>'search', $formOptions));
    echo $this->form->input('name', array('type'=>'text', 'label'=>false, 'require'=>false,'div'=>false,'id'=>'header input','class'=>false,));
    echo $this->form->submit('Search', array('id'=>'submit-button', 'div'=>false));
    echo $this->form->end();
    ?>
<!--    //Cart: X items ////
<?php echo $this->Html->link('<span></span> Shopping Cart <span>'.$count.'</span>',
                    array('controller'=>'carts','action'=>'view'),array('escape'=>false));?>
-->

    </div>
            </h1>
        </div>
        <div id="menu">
            <?php echo $this->Html->link(
                    $this->Html->image("index.png",array('height'=>'100')),
                        array('controller'=>'pages', 'action' => 'display', 'start'), array('escape' => false));?>



            <hr/>
            <?php echo $this->Html->link('Home', array('admin' => false,'controller'=>'pages','action'=>'display','start'));
                  echo $this->Html->link('Shop', array('admin' => false,'controller'=>'items','action'=>'index'));
                  echo $this->Html->link('Contact', array('controller'=>'pages','action'=>'display', 'contact'));
            ?>
            <?php   if(AuthComponent::user())
               {
                   echo $this->Html->link('Log out', array('admin'=>false,'controller'=>'users', 'action'=>'logout'));
               }
                   else echo $this->Html->link('Log in', array('admin'=>false,'controller'=>'users', 'action'=>'login'));
             ?>

            <hr/>
       </div>


        <div id="content">
            <?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>

    <?php //echo $this->element('sql_dump'); ?>
    <div id="footer">
        <hr/>
        <table>
            <tr>
                <td>
                    <b>Quick links</b><br/>
                    <?php echo $this->Html->link('Home','/'); ?><br/>
                    <?php echo $this->Html->link('Shop',array('controller'=>'items')); ?><br/>
                    <?php echo $this->Html->link('Contact',array('controller'=>'pages','action'=>'contact')); ?><br/>
                    <?php   if(AuthComponent::user())
                    {
                        echo $this->Html->link('Log out', array('admin'=>false,'controller'=>'users', 'action'=>'logout'));
                    }
                    else echo $this->Html->link('Log in', array('admin'=>false,'controller'=>'users', 'action'=>'login'));

                    ?><br/>

                    <?php echo $this->Html->link('Register',array('controller'=>'users','action'=>'register')); ?><br/>




                </td>
                <td>
                    <b>Follow Us</b><br/>
                    <?php echo $this->Html->link(
                        $this->Html->image('fblogo.gif', array('alt' => 'Follow us on Facebook!','height'=>'40')),
                        'https://www.facebook.com/maddolltees',
                        array('target' => '_blank','escape' => false)
                    );
                    ?>
                </td>
                <td align="right">
                    <b>Newsletter</b><br>
                    Email address, submit button<br><br>
                </td>
            </tr>
        </table>
        <!--
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered'),array('escape' => false)
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>   -->
        <p>Copyright &copy; 2015 &middot; All Rights Reserved &middot; <a href="http://mywebsite.com/" >Robert Szell</a></p>

    </div>

    ?>


</body>
</html>
