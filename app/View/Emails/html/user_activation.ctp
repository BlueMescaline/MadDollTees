<h1>Hello!</h1>
<p>Please click on the link below to activate your account!</p>

<a href="http://<?= $_SERVER['HTTP_HOST'];?>/shirtshop/users/activate/<?= $code.'XCB'.$id ?>/">Click here to activate your account!</a>
<hr />
<p>Alternatively, you can also copy paste the below link into your browser:
</p>
<p>http://<?= $_SERVER['HTTP_HOST']; ?>/shirtshop/users/activate/<?= $code.'XCB'. $id ?>/</p>
