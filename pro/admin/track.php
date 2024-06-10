<?php
if (!isset($file_access)) die("Direct File Access Denied");

?>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px dotted black; /* Table border */
        }
        th, td {
            border: 1px dotted black; /* Cell borders */
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; /* Header background color */
        }
    </style>
<div class="content">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-header bg-dark">
                            <h3 class="card-title">Track Vehicle</h3>
                        </div>

                        <div class="card-body">
                             <div class="row">
                                <div class="col-md-6">
                                     <form action="admin/map.php" method="post">

                    <table class="table table-bordered">

                        <tr>
                            <th><small>Departure</small><br>Latitude</th>
                            <td><input type="text" class="form-control" name="lat1" required id="lat1"></td>
                        </tr>
                        <tr>
                            <th>longitude</th>
                            <td><input type="text" class="form-control" name="lon1" required id="lon1">
                            </td>
                        </tr>

                        <tr>
                            
                            <th><small>Current Location </small> 
                            <br>Latitude</th>
                            <td><input type="text" class="form-control" name="lat2" required id="lat2"></td>
                        </tr>
                        <tr>
                            <th>longitude</th>
                            <td><input type="text" class="form-control" name="lon2" required id="lon2">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input class="btn" style='background-color:#f8198d; color:white;' type="submit" value="Track Vehicle" name='track'>
                            </td>
                        </tr>
                    </table>
                </form>
                                </div>
                                <div class="col-md-6">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Location</th>
                                                <th>Latitude</th>
                                                <th>longitude </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Benin</td>
                                                <td>6.333333</td>
                                                <td>5.622222 
                                                    &nbsp;&nbsp; <a href="javascript:void(0)" onclick="demo_data('Benin')" class="btn btn-outline-success btn-rounded btn-sm mt-1"><i class="fa fa-map-marker"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kaduna</td>
                                                <td>10.523056</td>
                                                <td>7.440278
                                                    &nbsp;&nbsp; <a href="javascript:void(0)" onclick="demo_data('Kaduna')" class="btn btn-outline-success btn-rounded btn-sm mt-1"><i class="fa fa-map-marker"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Abuja</td>
                                                <td>8.833333</td>
                                                <td>7.166667
                                                &nbsp;&nbsp; <a href="javascript:void(0)" onclick="demo_data('Abuja')" class="btn btn-outline-success btn-rounded btn-sm mt-1"><i class="fa fa-map-marker"></i></a>
                                                
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>Auchi</td>
                                                <td>7.066667</td>
                                                <td> 6.266667
                                                     &nbsp;&nbsp; <a href="javascript:void(0)" onclick="demo_data('Auchi')" class="btn btn-outline-success btn-rounded btn-sm mt-1"><i class="fa fa-map-marker"></i></a>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>Uyo</td>
                                                <td>5</td>
                                                <td>7.833333
                                                     &nbsp;&nbsp; <a href="javascript:void(0)" onclick="demo_data('Uyo')" class="btn btn-outline-success btn-rounded btn-sm mt-1"><i class="fa fa-map-marker"></i></a>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>Calabar</td>
                                                <td>4.976667</td>
                                                <td>8.338333
                                                     &nbsp;&nbsp; <a href="javascript:void(0)" onclick="demo_data('Calabar')" class="btn btn-outline-success btn-rounded btn-sm mt-1"><i class="fa fa-map-marker"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Warri</td>
                                                <td>5.516667</td>
                                                <td>5.75
                                                     &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; <a href="javascript:void(0)" onclick="demo_data('Warri')" class="btn btn-outline-success btn-rounded btn-sm mt-1"><i class="fa fa-map-marker"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</div>
</section>
</div>

 
    <script>
        function demo_data(location) {
            if (location == 'Benin') {
                $('#lat1').val('6.333333');
                $('#lon1').val('5.622222');
            } else if (location == 'Kaduna') {
                $('#lat2').val('10.523056');
                $('#lon2').val('7.440278');
            } else if (location == 'Abuja') {
                $('#lat1').val('8.833333');
                $('#lon1').val('7.166667');
            } else if (location == 'Auchi') {
               $('#lat2').val('7.066667');
                $('#lon2').val('6.266667');
            } else if (location == 'Uyo') {
               $('#lat1').val('5');
                $('#lon1').val('7.833333');
            } else if (location == 'Calabar') {
               $('#lat2').val('4.976667');
                $('#lon2').val('8.338333');
            } else if (location == 'Warri') {
                $('#lat1').val('5.516667');
                $('#lon1').val('5.75');
            }
        }
    </script>

 