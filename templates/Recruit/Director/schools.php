
<!-- Custom CSS for Colors and Gradients -->
<style>
    .school-card {
            background: #ffffff;
            border-radius: 0px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            padding: 0px;
       

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 20px;
            color: #2c3e50;
        }

        .search-box input {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            width: 220px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        thead {
            background: #2c7be5;
            color: #ffffff;
        }

        th, td {
            padding: 12px 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid #eaeaea;
        }

        tbody tr:hover {
            background: #f1f6ff;
        }

        .status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status.active {
            background: #e6f4ea;
            color: #137333;
        }

        .status.closed {
            background: #fdecea;
            color: #c5221f;
        }

        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            .search-box input {
                width: 160px;
            }
        }
   }
</style>

<div class="school-card">
   

    <table>
        <thead>
            <tr>
                <th>UDISE Code</th>
                <th>School Name</th>   
                <th>Status</th>
                <th colspan="2" style="text-align: center;">Actions</th>
            </tr>
        </thead>


        <tbody>
           
            <?php 
                foreach ($schools as $s){
                  $actions ='';
                  $actions1 ='';
                  if($s->school_close=='NO'){
                    $csscls = 'active';
                    $status = 'Active';

                      $actions ='<a style="text-decoration: none;" href="'.
                                $this->Url->build(['controller' => 'Cluster', 'action' => 'staffs', $s->udise_code])
                                .'"><span class="badge bg-light text-primary action-ud"><i class="fas fa-eye"></i> View Staffs</span>'.
                                '</a>';

                      $actions1 ='<a style="text-decoration: none;" href="'.
                                $this->Url->build(['controller' => 'Cluster', 'action' => 'staffs', $s->udise_code])
                                .'"><span class="badge bg-light text-primary action-ud"><i class="fas fa-arrow-trend-up me-1"></i> NG → G Transfer</span>'.
                                '</a>';
                  }else{
                    $csscls = 'closed';
                    $status = 'Closed';
                  }
                  echo '<tr>
                                <td>'.$s->udise_code.'</td>
                                <td>'.$s->school_name.'</td>                               
                                <td><span class="status '.$csscls.'">'.$status.'</span></td>
                                <td>'.$actions.'</td>
                                <td>'.$actions1.'</td>
                            </tr>';
                }
            ?>

           
        </tbody>
    </table>
</div>
   

 