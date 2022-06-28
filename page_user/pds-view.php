<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];
check_id($conn, $uid, "user");

echo "<h1>Personal Data Sheet</h1>
        $uid<br>";

_userheader("Test");

?>
<link rel="stylesheet" href="css/style-user.css">
<br><br>
<form action="#" method="get">
    
    <!-- Personal information ok -->
    <div>
        <fieldset disabled="disabled">
            <?php
                $stmt1 = userSelect($conn, "user_psl_tbl", $uid, null, null); // User personal info
                $arr1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                $stmt2 = userSelect($conn, "user_card_tbl", $uid, null, null); // User card info
                $arr2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                // $stmt3 = userSelect($conn, "user_addr_tbl", $uid, null, null); // User personal info
                // $arr3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                // $stmt4 = userSelect($conn, "user_main_tbl", $uid, null, null); // User personal info
                // $arr4 = $stmt4->fetch(PDO::FETCH_ASSOC);
                // $arr_psl = array_unique(array_merge($arr1, $arr2, $arr3, $arr4), SORT_REGULAR);
            ?>
                <div>I. Personal information <a href="pds-edi.php?field_on=1" target="_blank" rel="noopener noreferrer">Manage</a></div>

                <div>
                    2. Surname: <?= (isset($arr1['psl_user_sname'])) ? $arr1['psl_user_sname'] : '<b>n/a</b>' ?>
                </div>

                <div>
                    First Name: <?= (isset($arr1['psl_user_fname'])) ?  $arr1['psl_user_fname'] : '<b>n/a</b>' ?>
                </div>

                <div>
                    Middle Name: <?= (isset($arr1['psl_user_mname'])) ?  $arr1['psl_user_mname'] : '<b>n/a</b>' ?>
                </div>

                <div>
                    3. Date of Birth: <?= (isset($arr1['psl_user_bdate'])) ?  $arr1['psl_user_bdate'] : '<b>n/a</b>' ?>
                </div>

                <div>
                    4. Place of Birth: <?= (isset($arr1['psl_user_bplace'])) ?  $arr1['psl_user_bplace'] : '<b>n/a</b>' ?>
                </div>

                <div>
                    5. Sex
                    <input type="radio" name="user_sex" id="mgender" <?= $arr1['psl_user_sex'] == "male" ? "checked" : "" ?> value="male">
                    <label for="mgender">Male</label>
                    <input type="radio" name="user_sex" id="fgender" <?= $arr1['psl_user_sex'] == "female" ? "checked" : "" ?> value="female">
                    <label for="fgender">Female</label>
                </div>

                <div>
                    6. Civil Status
                    <input type="radio" name="user_civil" id="scivil" <?= $arr1['psl_user_civil'] == "single" ? "checked" : "" ?> value="single">
                    <label for="scivil">Single</label>
                    <input type="radio" name="user_civil" id="mcivil" <?= $arr1['psl_user_civil'] == "married" ? "checked" : "" ?> value="married">
                    <label for="mcivil">Married</label>
                    <input type="radio" name="user_civil" id="wcivil" <?= $arr1['psl_user_civil'] == "widowed" ? "checked" : "" ?> value="widowed">
                    <label for="wcivil">Widowed</label>
                    <input type="radio" name="user_civil" id="sepcivil" <?= $arr1['psl_user_civil'] == "seperated" ? "checked" : "" ?> value="separated">
                    <label for="sepcivil">Separated</label>
                </div>

            <div>
                7. Weight(kg): <?= (isset($arr1['psl_user_weight'])) ?  $arr1['psl_user_weight'] : '<b>n/a</b>' ?>
            </div>

            <div>
                8. Height(m): <?= (isset($arr1['psl_user_height'])) ?  $arr1['psl_user_height'] : '<b>n/a</b>' ?>
            </div>

            <div>
                9. Blood type: <?= (isset($arr1['psl_user_blood'])) ?  $arr1['psl_user_blood'] : '<b>n/a</b>' ?>
            </div>

            <div>
                10. GSIS ID No: <?= (isset($arr2['card_user_gsis'])) ?  $arr2['card_user_gsis'] : '<b>n/a</b>' ?>
            </div>

            <div>
                11. PAG-IBIG ID No: <?= (isset($arr2['card_user_ibig'])) ?  $arr2['card_user_ibig'] : '<b>n/a</b>' ?>
            </div>

            <div>
                12. PHILHEALTH No:  <?= (isset($arr2['card_user_phil'])) ?  $arr2['card_user_phil'] : '<b>n/a</b>' ?>
            </div>

            <div>
                13. SSS No: <?= (isset($arr2['card_user_sss'])) ?  $arr2['card_user_sss'] : '<b>n/a</b>' ?>
            </div>

            <div>
                14. TIN No: <?= (isset($arr2['card_user_tin'])) ?  $arr2['card_user_tin'] : '<b>n/a</b>' ?>
            </div>

            <div>
                15. AGENCY EMPLOYEE No <?= (isset($arr2['card_user_mply'])) ?  $arr2['card_user_mply'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                16. Citizenship<br>(If holder of dual citizenship, please indicate the details.)
                <input type="radio" name="user_ctzn" id="ctzn_filipino" <?= $arr1['psl_user_ctzn'] == "filipino" ? "checked" : "" ?> value="filipino">
                <label for="ctzn_filipino">Filipino</label>
                <span>Dual Citizenship</span>
                <input type="radio" name="user_ctzn" id="ctzn_dual_birth" <?= $arr1['psl_user_ctzn'] == "dualBirth" ? "checked" : "" ?> value="dualBirth">
                <label for="ctzn_dual_birth">by birth</label>
                <input type="radio" name="user_ctzn" id="ctzn_dual_natural" <?= $arr1['psl_user_ctzn'] == "dualNatural" ? "checked" : "" ?> value="dualNatural">
                <label for="ctzn_dual_natural">by naturalization</label>
                <label for="ctzn_other">Pls. indicate country </label>
                <?= (isset($arr1['psl_user_ctzn_other'])) ?  $arr1['psl_user_ctzn_other'] : '<b>n/a</b>' ?>
            </div>
            
            <div>17. Residential Address</div>

            <div>
                House/Block/Lot Number: <?= (isset($arr3['addr_user_hbl'])) ?  $arr3['addr_user_hbl'] : '<b>n/a</b>' ?>
            </div>

            <div>
                Street: <?= (isset($arr3['addr_user_strt'])) ?  $arr3['addr_user_strt'] : '<b>n/a</b>' ?>
            </div>

            <div>
                Subdivision/Village: <?= (isset($arr3['addr_user_subdiv'])) ?  $arr3['addr_user_subdiv'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                Barangay: <?= (isset($arr3['addr_user_brgy'])) ?  $arr3['addr_user_brgy'] : '<b>n/a</b>' ?>
            </div>
           
            <div>
                City/Municipality: <?= (isset($arr3['addr_user_city'])) ?  $arr3['addr_user_city'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                Province: <?= (isset($arr3['addr_user_prov'])) ?  $arr3['addr_user_prov'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                Zip Code: <?= (isset($arr3['addr_user_zip'])) ?  $arr3['addr_user_zip'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                19. Telephone Number: <?= (isset($arr1['psl_user_tel'])) ?  $arr1['psl_user_tel'] : '<b>n/a</b>' ?>
            </div>

            <div>
                20. Mobile Number: <?= (isset($arr1['psl_user_mobile'])) ?  $arr1['psl_user_mobile'] : '<b>n/a</b>' ?>
            </div>
           
            <div>
                21. E-mail address: <?= (isset($arr4['main_user_email'])) ?  $arr4['main_user_email'] : '<b>n/a</b>' ?>
            </div>
        </fieldset>
    </div>

    <!-- Family Background ok -->
    <div>
        <fieldset disabled="disabled">
            <?php
                $stmt5 = userSelect($conn, "user_fmly_tbl", $uid, null, null); // User personal info
                $arr5 = $stmt5->fetch(PDO::FETCH_ASSOC);
                $getchild = userSelect($conn, "user_child_tbl", $uid, null, null);
            ?>
            <div>II. Family background <a href="uedit2.php" target="_blank" rel="noopener noreferrer">Manage</a></div>

            <div>
                22. Spouse's Surname: <?= (isset($arr5['fmly_spous_sname'])) ?  $arr5['fmly_spous_sname'] : '<b>n/a</b>' ?>
            </div>

            <div>
                First Name: <?= (isset($arr5['fmly_spous_fname'])) ?  $arr5['fmly_spous_fname'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                Middle Name: <?= (isset($arr5['fmly_spous_mname'])) ?  $arr5['fmly_spous_mname'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                Occupation: <?= (isset($arr5['fmly_spous_occup'])) ?  $arr5['fmly_spous_occup'] : '<b>n/a</b>' ?>
            </div>

            <div>
                Employer/Business name: <?= (isset($arr5['fmly_spous_emplyr_name'])) ?  $arr5['fmly_spous_emplyr_name'] : '<b>n/a</b>' ?>
            </div>

            <div>
                Business Address: <?= (isset($arr5['fmly_spous_busines_addr'])) ?  $arr5['fmly_spous_busines_addr'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                Telephone Number: <?= (isset($arr5['fmly_spous_telno'])) ?  $arr5['fmly_spous_telno'] : '<b>n/a</b>' ?>
            </div>

            <br>
            
            <div>
                <table>
                    <thead>
                        <th>23. Name of children (Write full name and list all)</th>
                        <th>Date of Birth</th>
                    </thead>
                    <tbody>
                        <?php
                        if ($getchild) {
                            while ($childrows = $getchild->fetch(PDO::FETCH_ASSOC)) {
                                echo "
                                <tr>
                                <td>" . $childrows['child_user_name'] . "</td>
                                <td>" . $childrows['child_user_bdate'] . "</td>
                                </tr>
                                ";
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                    
                    </tfoot>
                </table>
            </div>

            <div>
                24. Father's Surname: <?= (isset($arr5['fmly_user_sname_fthr'])) ?  $arr5['fmly_user_sname_fthr'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                First Name: <?= (isset($arr5['fmly_user_fname_fthr'])) ?  $arr5['fmly_user_fname_fthr'] : '<b>n/a</b>' ?>
            </div>

            <div>
                Middle Name: <?= (isset($arr5['fmly_user_mname_fthr'])) ?  $arr5['fmly_user_mname_fthr'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                25. Mother's Maiden Name: <?= (isset($arr5['fmly_user_maiden_mthr'])) ?  $arr5['fmly_user_maiden_mthr'] : '<b>n/a</b>' ?>
            </div>
            
            <div>
                Surname: <?= (isset($arr5['fmly_user_sname_mthr'])) ?  $arr5['fmly_user_sname_mthr'] : '<b>n/a</b>' ?>
            </div>

            <div>
                First Name: <?= (isset($arr5['fmly_user_fname_mthr'])) ?  $arr5['fmly_user_fname_mthr'] : '<b>n/a</b>' ?>
            </div>

            <div>
                Middle Name: <?= (isset($arr5['fmly_user_mname_mthr'])) ?  $arr5['fmly_user_mname_mthr'] : '<b>n/a</b>' ?>
            </div>  
        </fieldset>
    </div>

    <!-- Educational Background ok -->  
    <div>
        <fieldset disabled="disabled">
            <?php
                $stmt6 = userSelect($conn, "user_elembg_tbl", $uid, null, null);
                $arr6 = $stmt6->fetch(PDO::FETCH_ASSOC);
                $stmt7 = userSelect($conn, "user_secobg_tbl", $uid, null, null);
                $arr7 = $stmt7->fetch(PDO::FETCH_ASSOC);
                $stmt8 = userSelect($conn, "user_vocabg_tbl", $uid, null, null);
                $arr8 = $stmt8->fetch(PDO::FETCH_ASSOC);
                $stmt9 = userSelect($conn, "user_collbg_tbl", $uid, null, null);
                $arr9 = $stmt9->fetch(PDO::FETCH_ASSOC);
                $stmt10 = userSelect($conn, "user_gradbg_tbl", $uid, null, null);
                $arr10 = $stmt10->fetch(PDO::FETCH_ASSOC);
            ?>
            <div>III. Educational Background <a href="uedit3.php" target="_blank" rel="noopener noreferrer">Manage</a></div>
            <div>
                <table class="zui-table" width="100%">
                    <thead>
                        <tr>
                            <th>26. Level</th>
                            <th>Name of School<br>(Write in full)</th>
                            <th>Basic Education/Degree/Course<br>(Write in full)</th>
                            <th colspan="2">Period of Attendance</th>
                            <th>Highest Level/Units Eraned</th>
                            <th>Year Graduated</th>
                            <th>Scholarship/Academic Honors Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Elementary
                            </td>
                            <td><?= (isset($arr6['elembg_user_name'])) ? $arr6['elembg_user_name'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr6['elembg_user_degre'])) ? $arr6['elembg_user_degre'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr6['elembg_user_pfrom'])) ? $arr6['elembg_user_pfrom'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr6['elembg_user_pto'])) ? $arr6['elembg_user_pto'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr6['elembg_user_earn'])) ? $arr6['elembg_user_earn'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr6['elembg_user_grad'])) ? $arr6['elembg_user_grad'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr6['elembg_user_reci'])) ? $arr6['elembg_user_reci'] : '<b>n/a</b>' ?></td>
                        </tr>
                        <tr>
                            <td>
                                Secondary
                            </td>
                            <td><?= (isset($arr7['secobg_user_name'])) ? $arr7['secobg_user_name'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr7['secobg_user_degre'])) ? $arr7['secobg_user_degre'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr7['secobg_user_pfrom'])) ? $arr7['secobg_user_pfrom'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr7['secobg_user_pto'])) ? $arr7['secobg_user_pto'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr7['secobg_user_earn'])) ? $arr7['secobg_user_earn'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr7['secobg_user_grad'])) ? $arr7['secobg_user_grad'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr7['secobg_user_reci'])) ? $arr7['secobg_user_reci'] : '<b>n/a</b>' ?></td>
                        </tr>
                        <tr>
                            <td>
                                Vocational/Trade Course
                            </td>
                            <td><?= (isset($arr8['vocabg_user_name'])) ? $arr8['vocabg_user_name'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr8['vocabg_user_degre'])) ? $arr8['vocabg_user_degre'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr8['vocabg_user_pfrom'])) ? $arr8['vocabg_user_pfrom'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr8['vocabg_user_pto'])) ? $arr8['vocabg_user_pto'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr8['vocabg_user_earn'])) ? $arr8['vocabg_user_earn'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr8['vocabg_user_grad'])) ? $arr8['vocabg_user_grad'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr8['vocabg_user_reci'])) ? $arr8['vocabg_user_reci'] : '<b>n/a</b>' ?></td>
                        </tr>
                        <tr>
                            <td>
                                College
                            </td>
                            <td><?= (isset($arr9['collbg_user_name'])) ? $arr9['collbg_user_name'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr9['collbg_user_degre'])) ? $arr9['collbg_user_degre'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr9['collbg_user_pfrom'])) ? $arr9['collbg_user_pfrom'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr9['collbg_user_pto'])) ? $arr9['collbg_user_pto'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr9['collbg_user_earn'])) ? $arr9['collbg_user_earn'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr9['collbg_user_grad'])) ? $arr9['collbg_user_grad'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr9['collbg_user_reci'])) ? $arr9['collbg_user_reci'] : '<b>n/a</b>' ?></td>
                        </tr>
                        <tr>
                            <td>
                                Graduate Studies
                            </td>
                            <td><?= (isset($arr10['gradbg_user_name'])) ? $arr10['gradbg_user_name'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr10['gradbg_user_degre'])) ? $arr10['gradbg_user_degre'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr10['gradbg_user_pfrom'])) ? $arr10['gradbg_user_pfrom'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr10['gradbg_user_pto'])) ? $arr10['gradbg_user_pto'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr10['gradbg_user_earn'])) ? $arr10['gradbg_user_earn'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr10['gradbg_user_grad'])) ? $arr10['gradbg_user_grad'] : '<b>n/a</b>' ?></td>
                            <td><?= (isset($arr10['gradbg_user_reci'])) ? $arr10['gradbg_user_reci'] : '<b>n/a</b>' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
    
    <!-- Civil Service -->
    <div>
        <fieldset disabled="disabled">
            <?php
                $getcivil = userSelect($conn, "user_civil_tbl", $uid, null, null)
            ?>
            <div>IV. Civil Service Elegibility <a href="civil-view.php" target="_blank" rel="noopener noreferrer">Manage</a></div>
            <div>
                <table class="zui-table" width="100%">
                    <thead>
                        <tr>
                            <th>27. CAREER SERVICE/RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE BARANGAY ELIGIBILITY/DRIVERS LICENSE</th>
                            <th>RATING (if applicable)</th>
                            <th>DATE EXAMINATION/CONFERMENT</th>
                            <th>PLACE OF EXAMINATION/CONFERMENT</th>
                            <th colspan="2">LICENSE (if applicable)<br>
                                NUMBER | VALIDITY</th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($getcivil) {
                            while ($rows = $getcivil->fetch(PDO::FETCH_ASSOC)) {
                                echo "
                                <tr>
                                <td>" . $rows['civil_user_info'] . "</td>
                                <td>" . $rows['civil_user_rate'] . "</td>
                                <td>" . $rows['civil_user_exam'] . "</td>
                                <td>" . $rows['civil_user_addr'] . "</td>
                                <td>" . $rows['civil_user_lcnnum'] . "</td>
                                <td>" . $rows['civil_user_lcndate'] . "</td>
                                </tr>
                                ";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>

    <!-- Work Experience -->
    <div>
        <fieldset disabled="disabled">
            <?php
            $getwork = userSelect($conn, "user_work_tbl", $uid, null, null)
            ?>
            <div>V. WORK EXPERIENCE <a href="work-view.php" target="_blank" rel="noopener noreferrer">Manage</a> <br></div>
            (Include private employment. Start from your recent work)Description of duties should be indicated in the attached Works Experience sheet.
            <div>
            <table class="zui-table" width="100%">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">28. INCLUSSIVE DATES(mm/dd/yyyy)<br>
                            FROM | TO</th>
                        <th scope="col"> POSITION TITLE<br>
                            (Write in full/Do not abbrevriate)</th>
                        <th scope="col">DEPARTMENT/AGENCY/OFFICE/COMPANY<br>
                            (Write in full/Do not abbrevriate)</th>
                        <th scope="col"> MONTHLY SALARY</th>
                        <th scope="col">SALARY/JOB/PAY GRADE
                            (if applicable)&STEP(format"00-0")<br>
                            /INCREMENT</th>
                        <th scope="col">STATUS OF<br>
                            APPOINTMENT</th>
                        <th scope="col">GOV'T SERVICE<br>
                            (Y/N)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($getwork) {
                        while ($rows = $getwork->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                            <tr>
                            <td>" . $rows['work_user_from'] . "</td>
                            <td>" . $rows['work_user_to'] . "</td>
                            <td>" . $rows['work_user_title'] . "</td>
                            <td>" . $rows['work_user_depart'] . "</td>
                            <td>" . $rows['work_user_sal'] . "</td>
                            <td>" . $rows['work_user_salgrad'] . "</td>
                            <td>" . $rows['work_user_status'] . "</td>
                            <td>" . $rows['work_user_gov'] . "</td>
                            </tr>
                            ";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>

    <!-- Voluntary Work -->
    <div>
        <fieldset disabled="disabled">
            <?php
                $getvolu = userSelect($conn, "user_volu_tbl", $uid, null, null)
            ?>
            <div>VI. VOLUNTARY WORK OR INVOLVEMETN IN CIVIC/
                NON-GOVERNMENT/PEOPLE/VOLUNTARY ORGANIZATIONS 
                <a href="volu-view.php" target="_blank" rel="noopener noreferrer">Manage</a> 
            </div>
            <div>
                <table class="zui-table" width="100%">
                    <thead>
                        <tr>
                            <th>29. NAME & ADDRESS OF ORGANIZATION<br>
                                (Write in full)</th>
                            <th colspan="2"> INCLUSIVE DATES<br>
                                (mm/dd/yyyy)<br>
                                FROM | TO</th>
                            <th>NUMBER OF HOURS</th>
                            <th>POSITION/NATURE OF WORK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($getvolu) {
                            while ($rows = $getvolu->fetch(PDO::FETCH_ASSOC)) {
                                echo "
                                <tr>
                                <td>" . $rows['volu_user_name'] . "</td>
                                <td>" . $rows['volu_user_from'] . "</td>
                                <td>" . $rows['volu_user_to'] . "</td>
                                <td>" . $rows['volu_user_hr'] . "</td>
                                <td>" . $rows['volu_user_posi'] . "</td>
                                </tr>
                                ";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>

    <!-- Learning and Development -->
    <div>
        <fieldset disabled="disabled">
            <div> VII. LEARNING AND DEVELOPMENT(L&D)INTERVENTIONS/TRAINING PROGRAMS ATTENDED <a href="lnd-view.php" target="_blank" rel="noopener noreferrer">Manage</a><br>
                (Start from the most L&D/training program and include only the relevant L& D/training takrn for the last five(5)years for Division Chief/Executive/Managerial position) <a href="uedit7.php?user_id=<?= $arr1['user_id'] ?>" target="_blank" rel="noopener noreferrer"></a> </div>
            <?php
                $getlnd = userSelect($conn, "user_lnd_tbl", $uid, null, null)
            ?>
            <div>
            <table class="zui-table" width="100%">
                <thead>
                    <tr>
                        <th>30. TITLE OF LEARNING AND DEVELOPMENT<br>
                            INTERVENTIONS/TRAINING PROGRAMS<br>
                            (Write in full)</th>
                        <th colspan="2">INCLUSIVE DATES OF ATTENDANCE<br>
                            FROM | TO</th>
                        <th>NUMBER OF HOURS</th>
                        <th>Type of I.D<br>
                            (Managerial/Supervisory/Technical/etc.)</th>
                        <th>CONDUCTED/SPONSORED BY<br>
                            (Write in full)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($getlnd) {
                        while ($rows = $getlnd->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                                <tr>
                                <td>" . $rows['lnd_user_name'] . "</td>
                                <td>" . $rows['lnd_user_from'] . "</td>
                                <td>" . $rows['lnd_user_to'] . "</td>
                                <td>" . $rows['lnd_user_hr'] . "</td>
                                <td>" . $rows['lnd_user_type'] . "</td>
                                <td>" . $rows['lnd_user_spon'] . "</td>
                                </tr>
                                ";
                        }
                    }
                    /*
                        lnd_id
                        lnd_user_name VARCHAR(24) NULL,
                        lnd_user_from DATE NULL,
                        lnd_user_to DATE NULL,
                        lnd_user_hr VARCHAR(24) NULL,
                        lnd_user_type VARCHAR(24) NULL,
                        lnd_user_spon VARCHAR(24) NULL,
                        */
                    ?>
                </tbody>
            </table>
            </div>
        </fieldset>
    </div>

    <!-- Other Information -->
    <div>
        <fieldset disabled="disabled">
            <?php
            $getother1 = userSelect($conn, "user_other1_tbl", $uid, null, null)
            ?>
            <div>VIII. OTHER INFORMATION <a href="other1-view.php" target="_blank" rel="noopener noreferrer">Manage</a> </div>
            <div>
                <table class="zui-table" width="100%">
                    <thead>
                        <tr>
                            <th>31. SPECIAL SKILLS and HOBBIES</th>
                            <th>32. NON-ACADEMIC DISTINCTIONS/RECOGNITION<br>
                                (Write in full)</th>
                            <th>33. MEMBERSHIO IN ASSOCIATION/ORGANIZATION<br>
                                (Write in full)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($getother1) {
                            while ($rows = $getother1->fetch(PDO::FETCH_ASSOC)) {
                                echo "
                                    <tr>
                                    <td>" . $rows['other1_user_skills'] . "</td>
                                    <td>" . $rows['other1_user_recog'] . "</td>
                                    <td>" . $rows['other1_user_member'] . "</td>
                                    </tr>
                                    ";
                            }
                        }
                            /*
                            other1_id VARCHAR(11) NULL UNIQUE,
                            other1_user_skills VARCHAR(24) NULL,
                            other1_user_recog VARCHAR(24) NULL,
                            other1_user_member VARCHAR(24) NULL,
                            */
                        ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>

    <!-- Questions -->
    <div>
        <fieldset disabled="disabled">
        <?php
            $getother2 = userSelect($conn, "user_other2_tbl", $uid, null, null);
            $other2 = $getother2->fetch(PDO::FETCH_ASSOC);
        /*
            other2_35_ayn VARCHAR(24) NULL,
            other2_35_atxt VARCHAR(24) NULL,
            other2_35_byn VARCHAR(24) NULL,
            other2_35_bdate VARCHAR(24) NULL,
            other2_35_btxt VARCHAR(24) NULL,
            
            other2_36_yn VARCHAR(24) NULL,
            other2_36_txt VARCHAR(24) NULL,
            
            other2_37_yn VARCHAR(24) NULL,
            other2_37_txt VARCHAR(24) NULL,
            
            other2_38_ayn VARCHAR(24) NULL,
            other2_38_atxt VARCHAR(24) NULL,
            other2_38_byn VARCHAR(24) NULL,
            other2_38_btxt VARCHAR(24) NULL,
            
            other2_39_yn VARCHAR(24) NULL,
            other2_39_txt VARCHAR(24) NULL,
            
            other2_40_ayn VARCHAR(24) NULL,
            other2_40_atxt VARCHAR(24) NULL,
            other2_40_byn VARCHAR(24) NULL,
            other2_40_btxt VARCHAR(24) NULL,
            other2_40_cyn VARCHAR(24) NULL,
            other2_40_ctxt VARCHAR(24) NULL,
            */
        ?>
            <a href="uedit4.php" target="_blank" rel="noopener noreferrer">Manage</a>
            <div>
                34. Are you related by consaguinity or affinity to the appointing or recommending authority, or to chief of bureau or office or to the person who has immediate supervision over you in the Bureau or Department where you will be apppointed,
                <br>
                a. within the third degree?
                <input type="radio" name="other2_34_ayn" id="other2_34_ayn" <?= $other2['other2_34_ayn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_34_ayn">Yes</label>
                <input type="radio" name="other2_34_ayn" id="other2_34_ayn" <?= $other2['other2_34_ayn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_34_ayn">No</label>
                <br>
                b. within the fourth degree (for Local Government Unit - Career Employees)?
                <input type="radio" name="other2_34_byn" id="other2_34_byn" <?= $other2['other2_34_byn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_34_byn">Yes</label>
                <input type="radio" name="other2_34_byn" id="other2_34_byn" <?= $other2['other2_34_byn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_34_byn">No</label>
                <label for="other2_34_txt">If yes, give details:</label>
                <input type="text" name="other2_34_txt" id="other2_34_txt" value="<?= (isset($other2['other2_34_txt'])) ?  $other2['other2_34_txt'] : '<b>n/a</b>' ?>">
                <br>
            </div>

            <div>
                35. a. Have you ever been found guilty of any administrative offense?
                <input type="radio" name="other2_35_ayn" id="other2_35_ayn" <?= $other2['other2_35_ayn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_35_ayn">Yes</label>
                <input type="radio" name="other2_35_ayn" id="other2_35_ayn" <?= $other2['other2_35_ayn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_35_ayn">No</label>
                <label for="other2_35_atxt">If yes, give details:</label>
                <input type="text" name="other2_35_atxt" id="other2_35_atxt" value="<?= (isset($other2['other2_35_atxt'])) ?  $other2['other2_35_atxt'] : '<b>n/a</b>' ?>">
                <br>
                b. Have you been criminally charged before any court?
                <input type="radio" name="other2_35_byn" id="other2_35_byn" <?= $other2['other2_35_byn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_35_byn">Yes</label>
                <input type="radio" name="other2_35_byn" id="other2_35_byn" <?= $other2['other2_35_byn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_35_byn">No</label>
                <div>If yes, give details:</div>
                <label for="other2_35_bdate">Date Filed:</label>
                <input type="date" name="other2_35_bdate" id="other2_35_bdate" value="<?= (isset($other2['other2_35_bdate'])) ?  $other2['other2_35_bdate'] : '<b>n/a</b>' ?>">
                <label for="other2_35_btxt">Status of Case/s:</label>
                <input type="text" name="other2_35_btxt" id="other2_35_btxt" value="<?= (isset($other2['other2_35_btxt'])) ?  $other2['other2_35_btxt'] : '<b>n/a</b>' ?>">
                <br>
            </div>

            <div>
                36. Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?
                <input type="radio" name="other2_36_yn" id="other2_36_yn" <?= $other2['other2_36_yn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_36_yn">Yes</label>
                <input type="radio" name="other2_36_yn" id="other2_36_yn" <?= $other2['other2_36_yn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_36_yn">No</label>
                <label for="other2_36_txt">If yes, give details:</label>
                <input type="text" name="other2_36_txt" id="other2_36_txt" value="<?= (isset($other2['other2_36_txt'])) ?  $other2['other2_36_txt'] : '<b>n/a</b>' ?>">
                <br>
            </div>

            <div>
                37. Have you ever been separated from the service in any of the following modes: resignation,retirement, dropped from the rolls, dismissal, termination, end of term, finished contract orphased out (abolition) in the public or private sector?
                <input type="radio" name="other2_37_yn" id="other2_37_yn" <?= $other2['other2_37_yn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_37_yn">Yes</label>
                <input type="radio" name="other2_37_yn" id="other2_37_yn" <?= $other2['other2_37_yn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_37_yn">No</label>
                <label for="other2_37_txt">If yes, give details:</label>
                <input type="text" name="other2_37_txt" id="other2_37_txt" value="<?= (isset($other2['other2_37_txt'])) ?  $other2['other2_37_txt'] : '<b>n/a</b>' ?>">
                <br>
            </div>

            <div>
                38. a. Have you ever been a candidate in a national or local election held within the last year(except Barangay election)?
            <input type="radio" name="other2_38_ayn" id="other2_38_ayn" <?= $other2['other2_38_ayn'] == "yes" ? "checked" : "" ?> value="yes">
            <label for="other2_38_ayn">Yes</label>
            <input type="radio" name="other2_38_ayn" id="other2_38_ayn" <?= $other2['other2_38_ayn'] == "no" ? "checked" : "" ?> value="no">
            <label for="other2_38_ayn">No</label>
            <label for="other2_38_atxt">If yes, give details:</label>
            <input type="text" name="other2_38_atxt" id="other2_38_atxt" value="<?= (isset($other2['other2_38_atxt'])) ?  $other2['other2_38_atxt'] : '<b>n/a</b>' ?>">
            <br>
            <div>b. Have you resigned from the government service during the three (3)-month period beforethe last election to promote/actively campaign for a national or local candidate?</div>
            <input type="radio" name="other2_38_byn" id="other2_38_byn" <?= $other2['other2_38_byn'] == "yes" ? "checked" : "" ?> value="yes">
            <label for="other2_38_byn">Yes</label>
            <input type="radio" name="other2_38_byn" id="other2_38_byn" <?= $other2['other2_38_byn'] == "no" ? "checked" : "" ?> value="no">
            <label for="other2_38_byn">No</label>
            <label for="other2_38_btxt">If yes, give details:</label>
            <input type="text" name="other2_38_btxt" id="other2_38_btxt" value="<?= (isset($other2['other2_38_btxt'])) ?  $other2['other2_38_btxt'] : '<b>n/a</b>' ?>">
            <br>
            </div>

            <div>
                39. Have you acquired the status of an immigrant or permanent resident of another country?
                <input type="radio" name="other2_39_ayn" id="other2_39_ayn" <?= $other2['other2_39_yn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_39_ayn">Yes</label>
                <input type="radio" name="other2_39_ayn" id="other2_39_ayn" <?= $other2['other2_39_yn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_39_ayn">No</label>
                <label for="other2_39_txt">If yes, give details:</label>
                <input type="text" name="other2_39_txt" id="other2_39_txt" value="<?= (isset($other2['other2_39_txt'])) ?  $other2['other2_39_txt'] : '<b>n/a</b>' ?>">
                <br>
            </div>

            <div>
                40. Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons(RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
                <br>
                <div>a. Are you a member of any indigenous group?</div>
                <input type="radio" name="other2_40_ayn" id="other2_40_ayn" <?= $other2['other2_40_ayn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_40_ayn">Yes</label>
                <input type="radio" name="other2_40_ayn" id="other2_40_ayn" <?= $other2['other2_40_ayn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_40_ayn">No</label>
                <label for="other2_40_atxt">If yes, give details:</label>
                <input type="text" name="other2_40_atxt" id="other2_40_atxt" value="<?= (isset($other2['other2_40_atxt'])) ?  $other2['other2_40_atxt'] : '<b>n/a</b>' ?>">
                <br>
                <div>b. Are you a person with disability?</div>
                <input type="radio" name="other2_40_byn" id="other2_40_byn" <?= $other2['other2_40_byn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_40_byn">Yes</label>
                <input type="radio" name="other2_40_byn" id="other2_40_byn" <?= $other2['other2_40_byn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_40_byn">No</label>
                <label for="other2_40_btxt">If yes, give details:</label>
                <input type="text" name="other2_40_btxt" id="other2_40_btxt" value="<?= (isset($other2['other2_40_btxt'])) ?  $other2['other2_40_btxt'] : '<b>n/a</b>' ?>">
                <br>
                <div>c. Are you a solo parent?</div>
                <input type="radio" name="other2_40_cyn" id="other2_40_cyn" <?= $other2['other2_40_cyn'] == "yes" ? "checked" : "" ?> value="yes">
                <label for="other2_40_cyn">Yes</label>
                <input type="radio" name="other2_40_cyn" id="other2_40_cyn" <?= $other2['other2_40_cyn'] == "no" ? "checked" : "" ?> value="no">
                <label for="other2_40_cyn">No</label>
                <label for="other2_40_ctxt">If yes, give details:</label>
                <input type="text" name="other2_40_ctxt" id="other2_40_ctxt" value="<?= (isset($other2['other2_40_ctxt'])) ?  $other2['other2_40_ctxt'] : '<b>n/a</b>' ?>">
            </div>
        </fieldset>
    </div>

    <!-- Other Information Imgs -->
    <div>
        <fieldset disabled="disabled">
        <?php
            $otherref = userSelect($conn, "user_otherref_tbl", $uid, null, null);
        ?>
            <div>
            41. REFERENCES (Person not related by consanguinity or affinity to applicant /appointee) <a href="" target="_blank" rel="noopener noreferrer">Manage</a>
            </div>
            <div>
                <table class="zui-table" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Tel. Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($otherref) {
                            while ($rows = $otherref->fetch(PDO::FETCH_ASSOC)) {
                                echo "
                                    <tr>
                                    <td>" . $rows['otherref_name'] . "</td>
                                    <td>" . $rows['otherref_address'] . "</td>
                                    <td>" . $rows['otherref_telno'] . "</td>
                                    </tr>
                                    ";
                            }
                        }
                        /*
                            otherref_id VARCHAR(11) UNIQUE NULL,
                            otherref_name VARCHAR(24) NULL,
                            otherref_address VARCHAR(24) NULL,
                            otherref_telno VARCHAR(24) NULL,
                        */
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
                $getother3 = userSelect($conn, "user_otherprf_tbl", $uid, null, null)
            ?>
            <div>
                42. I declare under oath that I have personally accomplished this Personal Data Sheet which is a true, correct and
                complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the
                Philippines. I authorize the agency head/authorized representative to verify/validate the contents stated
                herein. I agree that any misrepresentation made in this document and its attachments shall cause the
                filing of administrative/criminal case/s against me.
            </div>

            <div>
                Government Issued ID (i.e.Passport, GSIS, SSS, PRC, Driver's License, etc.)
                PLEASE INDICATE ID Number and Date of Issuance
            </div>
            <br>
            <div>Government Issued ID: <?= (isset($arr1['prf_govid_num'])) ?  $arr1['prf_govid_num'] : '<b>n/a</b>' ?></div>
            <br>
            <div>ID/License/Passport Number: <?= (isset($arr1['prf_licen_num'])) ?  $arr1['prf_licen_num'] : '<b>n/a</b>' ?></div>
            <br>
            <div>Date/Place Issuance: <?= (isset($arr1['prf_issuance'])) ?  $arr1['prf_issuance'] : '<b>n/a</b>' ?></div>
                        
            <br>

            <div>
                <!-- USER ID -->
                <?php
                    $getimg = userSelect($conn, "user_otherimg_tbl", $uid, null, null);
                    $otherimg = $getimg->fetch(PDO::FETCH_ASSOC);
                    if($otherimg['otherimg_path_1'] != null) {
                        $img1 = $otherimg['otherimg_path_1'];
                        echo "
                            <img src='" . $img1 . "' alt='ID'/>
                        ";
                    } else {
                        echo "
                            <div>ID picture takeb within the last 6 months 3.5 cm X 4.5 cm (passport size)<br>With full and handwritten name tag and signature over printed name<br>Computer generated or photocopied picture is not acceptable
                            <a href='img.php' target='_blank' rel='noopener noreferrer'>Upload Image</a> 
                        ";
                    }
                ?>
            </div>

            <br>

            <div>
                <!-- USER SIGNITURE -->
                <?php
                    $getimg = userSelect($conn, "user_otherimg_tbl", $uid, null, null);
                    $otherimg = $getimg->fetch(PDO::FETCH_ASSOC);
                    if($otherimg['otherimg_path_2'] != null) {
                        $img2 = $otherimg['otherimg_path_2'];
                        echo "
                            <img src='" . $img2 . "' alt='ID'/>
                        ";
                    } else {
                        echo "
                            <a href='img.php' target='_blank' rel='noopener noreferrer'>Upload Signiture</a>
                            <div>Signiture (Sign on the Box)</div>
                        ";
                    }
                ?>
                <?= (isset($arr1['prf_signiture_date'])) ?  $arr1['prf_signiture_date'] : '<b>n/a</b>' ?>
                <div>Date accomplished</div>
            </div>
            
            <br>

            <div>
                <!-- USER THUMBMARK -->
                <?php
                    $getimg = userSelect($conn, "user_otherimg_tbl", $uid, null, null);
                    $otherimg = $getimg->fetch(PDO::FETCH_ASSOC);
                    if($otherimg['otherimg_path_3'] != null) {
                        $img3 = $otherimg['otherimg_path_3'];
                        echo "
                            <img src='" . $img3 . "' alt='ID'/>
                        ";
                    } else {
                        echo "
                            <a href='img.php' target='_blank' rel='noopener noreferrer'>Upload Thumbmark</a>
                            <div>Signiture (Sign on the Box)</div>
                        ";
                    }
                ?>
                <div>Right Thumbmark</div>
            </div>

            <br>

            <div>
                <div>
                    SUBSCRIBED AND SWORN to before me this 
                    <input type="text" name="prf_affiant_name" id="prf_affiant_name" value="<?= (isset($arr1['prf_affiant_name'])) ?  $arr1['prf_affiant_name'] : '<b>n/a</b>' ?>"> , affiant exhibiting his/her validly issued government ID as indicated above.
                </div>
                    <?php
                        $getimg = userSelect($conn, "user_otherimg_tbl", $uid, null, null);
                        $otherimg = $getimg->fetch(PDO::FETCH_ASSOC);
                        if($otherimg['otherimg_path_4'] != null) {
                            $img4 = $otherimg['otherimg_path_4'];
                            echo "
                                <img src='" . $img4 . "' alt='ID'/>
                            ";
                        } else {
                            echo "
                                <a href='img.php' target='_blank' rel='noopener noreferrer'>Upload Oath Signiture</a>
                                <div>Signiture (Sign on the Box)</div>
                            ";
                        }
                    ?>
                <div>
                    Person Administrating Oath
                </div>
            </div>
        </fieldset>
    </div>
</form>





<br><br>
<?php _userfooter(2022); ?>