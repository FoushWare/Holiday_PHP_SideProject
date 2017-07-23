<?php
session_start();
$pageTitle='Dashboard';
include "init.php";

//for latest num users
$latestNum=5;
$latestUsers=getLatest("*","users",'UserID',$latestNum);
?>
<div class="container main-state">
        <h1 class="text-center">Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="text-center state memb_state">
                    Total Members
                    <span>
                       <a href="members.php?do=Manage">
                             <?php echo countItems('UserID','users')?>
                       </a>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center state pend_state">
                    Pending Members
                    <span>
                        <a href="members.php?d=Manage&&page=Pending">
                            <?php
                                   echo checkItem('RegStatus','users',0);

                            ?>
                        </a>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class=" text-center state items_state">
                    Totatl items
                    <span>
                        <a href="categories.php?do=Manage">
                            <?php
                                echo $count=countItems('ID','categories');
                             ?>
                       </a>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center state comment_state">
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
                        <i class="fa fa-users"></i> Latest <?php echo $latestNum;?> registed users
                    </div>
                    <div class="panel-body">
                       <ul class="list-unstyled latest-users">
<?php

foreach($latestUsers as $latest){
    echo "<li>";
    echo$latest['Username'];
    /*start Edit link*/
        echo '<a href="members.php?do=Edit&&userid='.$latest['UserID'].'">';
            echo '<span class="btn btn-primary pull-right">';
                    echo"<i class='fa fa-edit'></i>";
                    echo 'Edit';
            echo '</span>';
        echo '</a>';
    /*End Edit link*/

    /*start Delete link*/
        echo '<a href="members.php?do=Delete&&userid='.$latest['UserID'].'">';
            echo '<span class="btn btn-danger pull-right confirm">';
                    echo"<i class='fa fa-close'></i>";
                    echo 'Delete';
            echo '</span>';
        echo '</a>';
    /*End Delete link*/

    /* start add Activate button when there is pending users in db*/
        if($latest['RegStatus']==0){
            echo '<a href="members.php?do=Activate&&userid='.$latest['UserID'].'">';
                 echo '<span class="btn btn-info pull-right ">';
                     echo"<i class='fa fa-close'></i>";
                     echo 'Activate';
                echo '</span>';
            echo '</a>';

        }

    /* End add Activate button when there is pending users in db*/

    echo "</li>";

}
?>


                        </ul>
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
