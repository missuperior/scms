
                                 <?php $test .='<table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Course Name</th>
                                                <th>Course Code</th>
                                            </tr>
                                        </thead>

                                        <tbody>';
                                ?>
                                <?php
                                    $i = 0;
                                    foreach( $StudyCourses as $k => $pp){ 
                                
                                          $test.='<tr>
                                                <td><label  class="checkbox" style="width: 100%;"><input style="opacity: 1;" type="checkbox" name="allcourses[]"  value="'.$pp["course_id"].'"></label></td><td>'.$pp["course_name"].'</td><td>'.$pp["course_code"].'</td></tr>';
                                    $i++; } 
                                        $test.='</tbody></table>';
                                        echo $test;