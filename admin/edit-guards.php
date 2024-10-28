
    <?php
    //import database
    include("../connection.php");

    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webuser");
        $name=$_POST['guname'];
        $oldemail=$_POST["oldemail"];
        $email=$_POST['guemail'];
        $phone=$_POST['guphone'];
        $password=$_POST['gupassword'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select guards.guid from guards inner join webuser on guards.guemail=webuser.email where webuser.email='$email';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["guid"];
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';
                    
            }else{

                
                $sql1="update guards set guemail='$email',guname='$name',gupassword='$password',guphone=$phone where guid=$id ;";
                $database->query($sql1);
                
                $sql1="update webuser set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
                //echo $sql1;
                //echo $sql2;
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        $error='3';
    }
    

    header("location: guards.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>