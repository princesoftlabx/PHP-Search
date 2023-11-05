<?php
include('config.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $message = $conn-> real_escape_string($_POST['message']);
    $sql = "INSERT INTO `data_table`(`name`, `mobile`, `email`, `message`) VALUES ('".$name."', '".$mobile."', '".$email."', '".$message."');";
    $res = $conn->query($sql);
    if($res == true){
      $alert = '<script> alert("Your data has been submitted");';
      echo $alert;
    }
}

function getData($tableName,$sort){
    global $conn;
    $sql = "SELECT * FROM `".$tableName."` Order BY `".$sort."` DESC";
    $res = $conn->query($sql);
    return $res;
}
class Search{
  public $tableName;
  public $data;
    function searchData($tableName,$data){
     global $conn;
    $dataAll = explode(' ', $data);
    // $sql = "SELECT * FROM `".$tableName."` WHERE `name` LIKE '%".$data."%' OR `id` LIKE '%".$data."%' OR `mobile` LIKE '%".$data."%' OR `message` LIKE '%".$data."%' OR `email` LIKE '%".$data."%' OR `timestamp` LIKE '%".$data."%';";
      $sql = "SELECT * FROM `".$tableName."` WHERE CONCAT(`name`, `id`, `mobile`, `message`, `email`, `timestamp`) LIKE '%". implode("%' AND CONCAT(`name`, `id`, `mobile`, `message`, `email`, `timestamp`) LIKE '%", $dataAll) . "%';";
    // echo $sql;
    // die();
      $res = $conn->query($sql);
     return $res;
}
}
// Class multiSearch extends Search{
//   function searchData($tableName, $data){
//     global $conn;
//     $sql = "SELECT * FROM `".$tableName."` WHERE CONCAT(`name`, `id`, `mobile`, `message`, `email`, `timestamp`) LIKE '%' (SELECT * FROM `data_table` WHERE CONCAT(`name`, `id`, `mobile`, `message`, `email`, `timestamp`) LIKE '%".$data."%')'%';";
//      $res = $conn->query($sql);
//      return $res;
//   }
// }

function delete($tableName, $id){
    global $conn;
    $sql = "DELETE FROM `".$tableName."`WHERE `id` = ".$id."; ";
    $res = $conn->query($sql);
    return $res;
}

function getSearchData($string){
  global $conn;
  $arr = explode("_", $string);
  $sql ="SELECT * FROM `data_table` WHERE";
  for($i=0; $i < count($arr); $i++){
      if($i == count($arr)-1){
          $sql .=" `id`='".$arr[$i]."';";
      }else{
          $sql .=" `id`='".$arr[$i]."' OR ";
      }
  }
  $res = $conn->query($sql);
  $markup = '<div class="row">';
  while($row = $res->fetch_assoc()){
  $markup .= '<div class="card col-md-3" style="width: 22rem;">
              <div class="card-body">
              <h5 class="card-title">Serial Number: '.$row['id'].'</h5>
              <h5 class="card-title">Name: '.$row['name'].'</h5>
              <h5 class="card-title">Mobile Number: '.$row['mobile'].'</h5>
              <h5 class="card-title">Email: '.$row['email'].'</h5>
              <h5 class="card-title">Message: '.$row['message'].'</h5>
              <h5 class="card-title">Time Stamp: '.$row['timestamp'].'</h5>

              </div>
          </div>';
  }
  $markup .= '</div>';
  return $markup;

}

// function deleteData(){


// }


?>
<!-- <script>
function easyHTTP() {
  // Initialising new XMLHttpRequest method.
  this.http = new XMLHttpRequest();
}
  
// Make an HTTP Delete Request
easyHTTP.prototype.delete
  = function (url, callback) {
    
  // Open an request (GET/POST/PUT/DELETE,
  // PATH, ASYNC - TRUE/FALSE)
  this.http.open("DELETE", url, true);
  
  // Assigning this to self to have
  // scope of this into the function
  let self = this;
  
  // When the response is ready
  this.http.onload = function () {
    
    // Checking status
    if (self.http.status === 200) {
      
      // Callback function (Error, response text)
      callback(null, "Post Deleted");
    } else {
      
      // Callback function (Error message)
      callback("Error: " + self.http.status);
    }
  };
  
  // Send the request
  this.http.send();
};


// Instantiate easyHTTP
const http = new easyHTTP();
  
// Use the delete prototype
// method with (URL, callback(error, response text))
http.delete("http://localhost/datatable/mobile.php?id=$id",
 function (
  err,
  response
) {
  if (err) {
    console.log(err);
  } else {
    console.log(response);
  }
});
</script> -->