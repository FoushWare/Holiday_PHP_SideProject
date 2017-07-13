<?php
session_start();
$pageTitle='Dashboard';
include "init.php";
?>
<div class="container main-state">
        <h1 class="text-center">Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="text-center state">
                    Total Members
                    <span>20</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center state">
                    Pending Members
                    <span>20</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class=" text-center state">
                    Totatl items
                    <span>30</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center state">
                         Total Comments
                        <span>500</span>
                </div>
            </div>
        </div>

</div>

<div class="container latest">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i>Latest registed users
                    </div>
                    <div class="panel-body">
                        Test
                    </div>
                </div>


            </div><!--End of col-md-6 -->

             <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i>Latest Items
                    </div>
                    <div class="panel-body">
                        Test
                    </div>
             </div>


            </div><!--End of col-md-6 -->



        </div><!--End of the row-->




</div> <!--End of latest container-->















<?php
include $tpl."footer.php";
?>
