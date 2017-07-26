<?php
session_start();
$pageTitle='Categories';
if($_SESSION['Username']){

include 'init.php';

$do=isset($_GET['do'])?$_GET['do']:"Manage";


if($do=='Manage'){

    $sort="ASC";
    $sort_array=array('ASC','DESC');

    if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
        $sort=$_GET['sort'];
}



echo '<div class="container">';
      echo'<h1 class="text-center">Manage Categoreies</h1>';

/*START GET all the data in the categories table*/

$stmt=$con->prepare("SELECT * FROM categories ORDER BY ID  $sort");
$stmt->execute();
$row=$stmt->fetchAll();

/*END GET all the data in the categories table*/

echo'</div>';
?>
<div class="container">
    <div class="panel panel-default cat-panel">
        <div class="panel-heading">
        <i class="fa fa-edit"></i> Manage categoiries

        <div class="option pull-right">Ordering
                <i class="fa fa-sort"></i>[
                <a class="<?php if($sort =='ASC' ) echo 'active' ?>" href="?sort=ASC"> Asc | </a>
                <a class="<?php if($sort =='DESC' ) echo 'active' ?>" href="?sort=DESC"> | Dec  </a>
]      <i class="fa fa-eye"></i> View: [
               <span data-view="Full">Full |</span>
               <span data-view="Classic"> |Classic </span>]
        </div>



        </div>
        <div class="panel-body">
            <div class="categories">
                <?php
                    foreach($row as $cat){

                         echo'<div class="cat">';

                               echo'<div class="hidden-buttons">';
                                   echo' <a class="btn btn-success btn-sm Edit" href="categories.php?do=Edit&catId='.$cat['ID'].'">';
                                       echo"<i class='fa fa-edit'></i> Edit";
                                   echo '</a>';

                                   echo'<a class="btn btn-danger btn-sm Delete confirm" href="?do=Delete&catId='.$cat['ID'].'">';
                                        echo"<i class='fa fa-close'></i> Delete";
                                   echo '</a>';

                              echo'</div>';

                            echo'<h3>' .$cat['name']. '</h3>';

                            echo'<div class="full-view">';
                                    echo'<p>'.$cat['description'].'</p>';
                                    /* echo'<span>'."Ordering".$cat['ordering'].'</span>'; */
                                   if($cat['visibility'] == 1){ echo'<span class="cat-span visibility">'.'<i class="fa fa-eye"></i>'." Hidden".'</span>';}
                                    if($cat['Allow_Comment'] == 1){echo'<span class="cat-span commenting">'.'<i class="fa fa-close"></i>'."Commenting_disabled".'</span>';}
                                    if($cat['Allow_Ads'] == 1){echo'<span class="cat-span ads">'.'<i class="fa fa-close"></i>'."Ads_disable".'</span>';}
                            echo'</div>'; //end of full-view

                        echo'</div>';
                        echo'<hr>';
                    }

                ?>
            </div>
        </div>
    </div>



        <a class="btn btn-primary add-category-button " href="?do=Add"><i class="fa fa-plus"></i> Add category</a>

</div>




<?php
}//End brace of Manage

else if($do=="Add"){


?>

<div class="container">

    <h1 class="text-center">Add  Category</h1>

    <form class="form-horizontal main_form" action="categories.php?do=Insert" method="POST">

        <div class=" form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-6">
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Name of the category"
                       required="required"
                       value=""/>
           </div>

        </div> <!--End of form group-->

        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           name="description"
                           class="form-control"
                           placeholder="Describe the category"
                           required="required"
                           value=""/>
               </div>

        </div> <!--End of form group-->

         <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Ordering</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           name="ordering"
                           class="form-control"
                           placeholder="number to arrange the categories"
                           required="required"
                           value=""/>
               </div>

        </div> <!--End of form group-->
    <!--start Choose from radio button   visibility-->
        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Visibility</label>
                <div class="col-sm-10 col-md-6">
                    <div>
                        <input type="radio"
                               name="visibility"
                               id="vis-yes"
                               value="0"
                               checked />
                        <label for="vis-yes">Yes</label>
                    </div>

                    <div>
                        <input type="radio"
                               name="visibility"
                               id="vis-no"
                               value="1"
                                />
                        <label for="vis-no">No</label>
                    </div>

               </div>

        </div> <!--End of form group-->


    <!--End Choose from radio button visibility-->
    <!--start Choose from radio button allow_commenting-->
        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Allow_commenting</label>
                <div class="col-sm-10 col-md-6">
                    <div>
                        <input type="radio"
                               name="commenting"
                               id="comment-yes"
                               value="0"
                               checked />
                        <label for="comment-yes">Yes</label>
                    </div>

                    <div>
                        <input type="radio"
                               name="commenting"
                               id="comment-no"
                               value="1"
                                />
                        <label for="comment-no">No</label>
                    </div>

               </div>

        </div> <!--End of form group-->


    <!--End Choose from radio button allow_commenting-->

    <!--start Choose from radio button-->
        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Allow_ads</label>
                <div class="col-sm-10 col-md-6">
                    <div>
                        <input type="radio"
                               name="ads"
                               id="ads-yes"
                               value="0"
                               checked />
                        <label for="ads-yes">Yes</label>
                    </div>

                    <div>
                        <input type="radio"
                               name="ads"
                               id="ads-no"
                               value="1"
                                />
                        <label for="ads-no">No</label>
                    </div>

               </div>

        </div> <!--End of form group-->


    <!--End Choose from radio button-->

        <div class=" form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input
                type="submit"
                value="Add categore"
                class="btn btn-primary btn-lg"
                            />
            </div>
        </div>



    </form>






</div><!--End of the container-->




<?php
}//End brace of add

else if($do=="Insert"){

    /* check if the user came from form or direct*/
    if($_SERVER['REQUEST_METHOD']=='POST'){
        echo '<h1 class="text-center">Insert Page</h1>';
/*START collect the data from the form*/
        $name=$_POST['name'];
        $description=$_POST['description'];
        $ordering=$_POST['ordering'];
        $visibility=$_POST['visibility'];
        $allow_commenting=$_POST['commenting'];
        $allow_ads=$_POST['ads'];
        /*END collect the data from the form*/

        //check if the user is exits before in the db
       $count =checkItem("name",'categories',$name);
if($count == 0){

    $stmt= $con->prepare("INSERT INTO
                                    categories(name,
                                               description,
                                               ordering,
                                               visibility,
                                               Allow_Comment,
                                               Allow_Ads)
                                    VALUES(:Xname,
                                        :Xdescription,
                                        :Xordering,
                                        :Xvisibility,
                                        :Xcomment,
                                        :XAds)

");

$stmt->execute(array(

        'Xname'        => $name,
        'Xdescription' => $description,
        'Xordering'    => $ordering,
        'Xvisibility'  => $visibility,
        'Xcomment'     => $allow_commenting,
        'XAds'         => $allow_ads


));

$theMsg='<div class="alert alert-success text-center">The category have been inserted successful</div>';
redirectHome($theMsg);

?>

<?php
}//End of count condition
else{
    $theMsg='<div class="alert alert-danger text-center">The category is already exists</div>';
    redirectHome($theMsg);
}




}else{ //if the user get direct to insert page
    echo"<div class='container'>";
        echo"<br>";
        $theMsg='<div class="alert alert-danger text-center">YOU can not browse this page direct</div>';
        redirectHome($theMsg);
    echo"</div>";
}

}//End brace of Insert

else if($do=='Edit'){

    if( isset($_GET['catId']) ){
        $catId=$_GET['catId'];

/*Check if the category in db or not*/

$count=checkItem('ID','categories',$catId);

if($count>0){


    $stmt=$con->prepare("SELECT * FROM categories WHERE ID=?");
    $stmt->execute(array($catId));
    $row=$stmt->fetch();





?>
<div class="container">

    <h1 class="text-center">Edit  Category</h1>

    <form class="form-horizontal main_form" action="categories.php?do=Update" method="POST">

            <input
                     type="hidden"
                     name="catid"
                     value="<?php echo $catId; ?>"
             />

        <div class=" form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-6">
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Name of the category"
                       required="required"
                       value="<?php echo$row['name']; ?>"/>
           </div>

        </div> <!--End of form group-->

        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           name="description"
                           class="form-control"
                           placeholder="Describe the category"
                           required="required"
                           value="<?php echo $row['description']; ?>">
               </div>

        </div> <!--End of form group-->

         <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Ordering</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           name="ordering"
                           class="form-control"
                           placeholder="number to arrange the categories"
                           required="required"
                           value="<?php echo $row['ordering']; ?>"
                           />
               </div>

        </div> <!--End of form group-->
    <!--start Choose from radio button   visibility-->
        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Visibility</label>
                <div class="col-sm-10 col-md-6">
                    <div>
                        <input type="radio"
                               name="visibility"
                               id="vis-yes"
                               value="0"
                            <?php if($row['visibility']==0){ echo 'checked'; }?>
                                />
                        <label for="vis-yes">Yes</label>
                    </div>

                    <div>
                        <input type="radio"
                               name="visibility"
                               id="vis-no"
                               value="1"
                            <?php if($row['visibility']==1){ echo 'checked'; }?>
                                />
                        <label for="vis-no">No</label>
                    </div>

               </div>

        </div> <!--End of form group-->


    <!--End Choose from radio button visibility-->
    <!--start Choose from radio button allow_commenting-->
        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Allow_commenting</label>
                <div class="col-sm-10 col-md-6">
                    <div>
                        <input type="radio"
                               name="commenting"
                               id="comment-yes"
                               value="0"
                            <?php if($row['Allow_Comment']==0){ echo 'checked'; }?>
                                />
                        <label for="comment-yes">Yes</label>
                    </div>

                    <div>
                        <input type="radio"
                               name="commenting"
                               id="comment-no"
                               value="1"
                            <?php if($row['Allow_Comment']==1){ echo 'checked'; }?>
                                />
                        <label for="comment-no">No</label>
                    </div>

               </div>

        </div> <!--End of form group-->


    <!--End Choose from radio button allow_commenting-->

    <!--start Choose from radio button-->
        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Allow_ads</label>
                <div class="col-sm-10 col-md-6">
                    <div>
                        <input type="radio"
                               name="ads"
                               id="ads-yes"
                               value="0"
                            <?php if($row['Allow_Ads']==0){ echo 'checked'; }?>
                                />
                        <label for="ads-yes">Yes</label>
                    </div>

                    <div>
                        <input type="radio"
                               name="ads"
                               id="ads-no"
                               value="1"
                            <?php if($row['Allow_Ads']==1){ echo 'checked'; }?>
                                />
                        <label for="ads-no">No</label>
                    </div>

               </div>

        </div> <!--End of form group-->


    <!--End Choose from radio button-->

        <div class=" form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input
                type="submit"
                value="Add categore"
                class="btn btn-primary btn-lg"
                            />
            </div>
        </div>



    </form>






</div><!--End of the container-->


<?php
}//check count

else{
    //if the category not in the db
    $theMsg='<div class="alert alert-danger text-center">The category not exist</div>';
    redirectHome($theMsg);
}


}//check category Id

}//end brace of Edit

else if($do=="Update"){

    if($_SERVER['REQUEST_METHOD']=="POST"){

        /*START collect the data from the form*/
        $catId=$_POST['catid'];
        $name=$_POST['name'];
        $description=$_POST['description'];
        $ordering=$_POST['ordering'];
        $visibility=$_POST['visibility'];
        $allow_commenting=$_POST['commenting'];
        $allow_ads=$_POST['ads'];
        /*END collect the data from the form*/

$count=checkItem('ID','categories',$catId);
if($count >0){
    $stmt=$con->prepare("UPDATE
                                categories
                        SET
                                name=?,
                                description=?,
                                ordering=?,
                                visibility=?,
                                Allow_Comment=?,
                                Allow_Ads=?
                        WHERE
                                ID=?
");
$stmt->execute(array(

       $name,
       $description,
       $ordering,
       $visibility,
       $allow_commenting,
       $allow_ads,
       $catId
));

echo '<div class="container">';
echo '<br>';
$theMsg='<div class="alert alert-success text-center">You have update this category</div>';

redirectHome($theMsg);
echo '</div>';

}else{
$theMsg='<div class="alert alert-danger">This record is not exist</div>';

redictHome($theMsg);
}


}else{
$theMsg='<div class="alert alert-danger text-center">You can not browse this page direct</div>';
echo'<br>';
redirectHome($theMsg);
}


?>




<?php
} //end brace of Update

else if($do=="Delete"){

$catId=isset($_GET['catId']) && is_numeric($_GET['catId'])?intval($_GET['catId']):0;

$count=checkItem('ID','categories',$catId);

if($count>0){

$stmt=$con->prepare("DELETE FROM categories WHERE ID=?");
$stmt->execute(array($catId));


$theMsg='<div class="alert alert-success text-center">The user is deleted</div>';
redirectHome($theMsg);

?>

<?php
}//End of count
else{
$theMsg='<div class="alert alert-danger text-center">The user is not exist</div>';
redirectHome($theMsg);
}
}//End brace of Delete



?>


<?php
include $tpl.'footer.php';
    }//End brace of session exists
else{ //if there is no session
    header('Location:index.php');
    exit();
}
?>
