<?php 
include ('incl/header.php');
include ('incl/footer.php');
$markup = '<table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Timestamp</th>
                                    </tr>
                                </thead>';
    $result = getData("data_table","id");
    while($row= $result->fetch_assoc()){
        $markup .='<tbody>
                        <tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['mobile'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['message'].'</td>
                        <td>'.$row['timestamp'].'</td>
                        </tr>
                    </tbody>';
    }   

    $markup .= '<tfooter>
                                    <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Timestamp</th>
                                    </tr>
                                </tfooter>
                                </table>';
    echo $markup;
    
?>