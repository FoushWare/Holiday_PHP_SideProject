<?php
$pageTitle="Members";
include 'init.php';

?>

<div class="container">
<form class="form-horizontal">
<!-- Start username Field-->
    <div class="form-group form-group-lg">
            <label  class="col-sm-2 control-label">UserName</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" autocomplete="off" required="required" placeholder="Username"/>
            </div>

    </div>
<!-- End username Field-->

<!-- Start Email Field-->
    <div class="form-group form-group-lg">
        <label  class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" autocomplete="off" required="required" placeholder="Email"/>
        </div>
    </div>
<!-- End Email Field-->

<!-- Start Password Field-->
    <div class="form-group form-group-lg">
        <label  class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control col-sm-10" autocomplete="new-password" required="required" placeholder="password"/>
        </div>

    </div>
<!-- End Password Field-->

<!-- End FullName Field-->

    <div class="form-group form-group-lg">
        <label  class="col-sm-2 control-label">FullName</label>
        <div class="col-sm-10">
            <input type="text" class="form-control col-sm-10" autocomplete="off" required="required" placeholder="FullName"/>
        </div>

    </div>

<!-- End FullName Field-->

</form>
</div>  <!--End of container-->


<?php
include $tpl.'footer.php';

?>
