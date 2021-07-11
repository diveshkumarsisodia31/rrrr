<?php
include('db.php');

$sql = "select id , name from country";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr_country = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
        
    </head>
    <body>
    <h4>Dropdown List</h4>
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <div class="col-md-4">
                 <input type="week" name="date"/>
                 <select class="form-control" id="country">
                   <option value="-1">Select Country</option>
                   <?php foreach($arr_country as $country){?>
                   <option value="<?php echo $country['id']?>"><?php echo $country['name']?></option>
                   <?php }?>
                 </select>
               </div>
               <div class="col-md-4">
               <select class="form-control" id="state">
                   <option>Select State</option>
                 </select>
               </div>
               <div class="col-md-4">
               <select class="form-control" id="city">
                   <option>Select City</option>
                 </select>
               </div>
             </div>
            </div>
         </div>
       <script type="text/javascript">
         $('#country').on('change',function(){
          var country_id =$(this).val();
            if(country_id=='-1'){
                $('#state').html('<option value="-1">Select State</option>');
            }else{
                $('#state').html('<option value="-1">Select State</option>');
            $.ajax({
             url:'get_data.php',
             type:'post',
             data:'id='+country_id,
             success:function(result){
              $('#state').append(result);
             }
            });
            }
         });
         $('#state').on('change',function(){
          var state_id =$(this).val();
            if(state_id=='-1'){
                $('#city').html('<option value="-1">Select City</option>');
            }else{
                $('#city').html('<option value="-1">Select City</option>');
            $.ajax({
             url:'get_data_city.php',
             type:'post',
             data:'id='+state_id,
             success:function(result){
              $('#city').append(result);
             }
            });
            }
         });
       </script>
    </body>
</html>