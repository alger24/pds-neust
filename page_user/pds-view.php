<?php
require '../php/conn.php';
require '../php/func.php';
require 'udry.php';
session_start();

$user_id = $_SESSION['user_id'];
check_id(1, $user_id, $conn);

try {
  $sql = "
  SELECT * FROM `user_main_tbl`
  LEFT JOIN `user_psl_tbl`
  ON `user_main_tbl`.user_id = `user_psl_tbl`.user_id
  LEFT JOIN `user_card_tbl`
  ON `user_main_tbl`.user_id = `user_card_tbl`.user_id
  LEFT JOIN `user_addr_tbl`
  ON `user_main_tbl`.user_id = `user_addr_tbl`.user_id
  LEFT JOIN `user_fmly_tbl`
  ON `user_main_tbl`.user_id = `user_fmly_tbl`.user_id
  LEFT JOIN `user_child_tbl`
  ON `user_main_tbl`.user_id = `user_child_tbl`.user_id
  WHERE `user_main_tbl`.user_id=:userid
  ";

  $select = $conn->prepare($sql);
  $select->execute([':userid' => $user_id]);
  $rows = $select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}

$arr1 = array();
foreach ($rows as $data1) {
  $arr1 = $data1;
}

echo "<h1>Personal Data Sheet</h1>
        $user_id<br>";

_userheader("Test");
?>
<link rel="stylesheet" href="css/style-user.css">
<br><br>
<form action="#" method="get">
  <fieldset disabled="disabled">
      <span>I. Personal information <a href="uedit1.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a></span>
      <br><br>
      <label for="user_name">2. Surname</label>
      <input type="text" name="user_name" id="user_name" value="<?= (isset($arr1['psl_user_sname'])) ? $arr1['psl_user_sname'] : '' ?>">
      <label for="user_fname">First Name</label>
      <input type="text" name="user_fname" id="user_fname" value="<?= (isset($arr1['psl_user_fname'])) ?  $arr1['psl_user_fname'] : '' ?>">
      <label for="midName">Middle Name</label>
      <input type="text" name="user_mname" id="midName" value="<?= (isset($arr1['psl_user_mname'])) ?  $arr1['psl_user_mname'] : '' ?>">
      <label for="user_bdate">3. Date of Birth</label>
      <input type="date" name="user_bdate" id="user_bdate" value="<?= (isset($arr1['psl_user_bdate'])) ?  $arr1['psl_user_bdate'] : '' ?>">
      <label for="plcBirt">4. Place of Birth</label>
      <input type="text" name="user_bplace" id="user_bplace" value="<?= (isset($arr1['psl_user_bplace'])) ?  $arr1['psl_user_bplace'] : '' ?>">
      <br><br>
      <span>5. Sex</span>
      <input type="radio" name="user_sex" id="mgender" <?= $arr1['psl_user_sex'] == "male" ? "checked" : "" ?> value="male">
      <label for="mgender">Male</label>
      <input type="radio" name="user_sex" id="fgender" <?= $arr1['psl_user_sex'] == "female" ? "checked" : "" ?> value="female">
      <label for="fgender">Female</label>
      <br><br>
      <span>6. Civil Status </span>
      <input type="radio" name="user_civil" id="scivil" <?= $arr1['psl_user_civil'] == "single" ? "checked" : "" ?> value="single">
      <label for="scivil">Single</label>
      <input type="radio" name="user_civil" id="mcivil" <?= $arr1['psl_user_civil'] == "married" ? "checked" : "" ?> value="married">
      <label for="mcivil">Married</label>
      <input type="radio" name="user_civil" id="wcivil" <?= $arr1['psl_user_civil'] == "widowed" ? "checked" : "" ?> value="widowed">
      <label for="wcivil">Widowed</label>
      <input type="radio" name="user_civil" id="sepcivil" <?= $arr1['psl_user_civil'] == "seperated" ? "checked" : "" ?> value="separated">
      <label for="sepcivil">Separated</label>
      <br><br>
      <label for="weight">7. Weight(kg) </label>
      <input type="number" name="user_weight" id="weight" value="<?= (isset($arr1['psl_user_weight'])) ?  $arr1['psl_user_weight'] : '' ?>">
      <label for="height">8. Height(m) </label>
      <input type="number" name="user_height" id="height" value="<?= (isset($arr1['psl_user_height'])) ?  $arr1['psl_user_height'] : '' ?>">
      <label for="blood">9. Blood Type </label>
      <input type="text" name="user_blood" id="blood" value="<?= (isset($arr1['psl_user_blood'])) ?  $arr1['psl_user_blood'] : '' ?>">
      <br><br>
      <label for="gsis">10. GSIS ID No </label>
      <input type="text" name="user_gsis" id="gsis" value="<?= (isset($arr1['card_user_gsis'])) ?  $arr1['card_user_gsis'] : '' ?>">
      <label for="ibig">11. PAG-IBIG ID No </label>
      <input type="text" name="user_ibig" id="ibig" value="<?= (isset($arr1['card_user_ibig'])) ?  $arr1['card_user_ibig'] : '' ?>">
      <label for="phil">12. PHILHEALTH No</label>
      <input type="text" name="user_phil" id="phil" value="<?= (isset($arr1['card_user_phil'])) ?  $arr1['card_user_phil'] : '' ?>">
      <label for="sss">13. SSS No </label>
      <input type="text" name="user_sss" id="sss" value="<?= (isset($arr1['card_user_sss'])) ?  $arr1['card_user_sss'] : '' ?>">
      <label for="tin">14. TIN No </label>
      <input type="text" name="user_tin" id="tin" value="<?= (isset($arr1['card_user_tin'])) ?  $arr1['card_user_tin'] : '' ?>">
      <label for="mply">15. AGENCY EMPLOYEE No</label>
      <input type="text" name="user_mply" id="mply" value="<?= (isset($arr1['card_user_mply'])) ?  $arr1['card_user_mply'] : '' ?>">
      <br><br>
      <span>16. Citizenship<br>(If holder of dual citizenship, please indicate the details.)</span>
      <input type="radio" name="user_ctzn" id="ctzn_filipino" <?= $arr1['psl_user_ctzn'] == "filipino" ? "checked" : "" ?> value="filipino">
      <label for="ctzn_filipino">Filipino</label>
      <span>Dual Citizenship</span>
      <input type="radio" name="user_ctzn" id="ctzn_dual_birth" <?= $arr1['psl_user_ctzn'] == "dualBirth" ? "checked" : "" ?> value="dualBirth">
      <label for="ctzn_dual_birth">by birth</label>
      <input type="radio" name="user_ctzn" id="ctzn_dual_natural" <?= $arr1['psl_user_ctzn'] == "dualNatural" ? "checked" : "" ?> value="dualNatural">
      <label for="ctzn_dual_natural">by naturalization</label>
      <label for="ctzn_other">Pls. indicate country </label>
      <input type="text" name="user_ctzn_other" id="ctzn_other" value="<?= (isset($arr1['psl_user_ctzn_other'])) ?  $arr1['psl_user_ctzn_other'] : '' ?>">
      <br><br>
      <span>17. Residential Address</br></span>
      <label for="user_hbl">House/Block/Lot No. </label>
      <input type="text" name="user_hbl" id="user_hbl" value="<?= (isset($arr1['addr_user_hbl'])) ?  $arr1['addr_user_hbl'] : '' ?>">
      <label for="user_strt">Street </label>
      <input type="text" name="user_strt" id="user_strt" value="<?= (isset($arr1['addr_user_strt'])) ?  $arr1['addr_user_strt'] : '' ?>">
      <label for="user_subdiv">Subdivision/Village </label>
      <input type="text" name="user_subdiv" id="user_subdiv" value="<?= (isset($arr1['addr_user_subdiv'])) ?  $arr1['addr_user_subdiv'] : '' ?>">
      <label for="user_brgy">Barangay </label>
      <input type="text" name="user_brgy" id="user_brgy" value="<?= (isset($arr1['addr_user_brgy'])) ?  $arr1['addr_user_brgy'] : '' ?>">
      <label for="user_city">City/Municipality </label>
      <input type="text" name="user_city" id="user_city" value="<?= (isset($arr1['addr_user_city'])) ?  $arr1['addr_user_city'] : '' ?>">
      <label for="user_prov">Province </label>
      <input type="text" name="user_prov" id="user_prov" value="<?= (isset($arr1['addr_user_prov'])) ?  $arr1['addr_user_prov'] : '' ?>">
      <label for="user_zip">Zip Code </label>
      <input type="text" name=user_zip id="user_zip" value="<?= (isset($arr1['addr_user_zip'])) ?  $arr1['addr_user_zip'] : '' ?>">
      <br><br>
      <label for="user_tel">19. Telephone no. </label>
      <input type="text" name="user_tel" id="user_tel" value="<?= (isset($arr1['psl_user_tel'])) ?  $arr1['psl_user_tel'] : '' ?>">
      <label for="user_mobile">20. Mobile no. </label>
      <input type="text" name="user_mobile" id="user_mobile" value="<?= (isset($arr1['psl_user_mobile'])) ?  $arr1['psl_user_mobile'] : '' ?>">
      <label for="email">21. E-mail address (if any) </label>
      <input type="text" name="user_email" id="email" value="<?= (isset($arr1['main_user_email'])) ?  $arr1['main_user_email'] : '' ?>">
      <button type="submit">Test</button>
  </fieldset>
  <fieldset disabled="disabled">
      <span>II. Family background <a href="uedit2.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a></span>
      <br><br>
      <label for="spous_surname">22. Spouse's Surname </label>
      <input type="text" name="spous_surname" id="spous_surname" value="<?= (isset($arr1['fmly_spous_sname'])) ?  $arr1['fmly_spous_sname'] : '' ?>">
      <label for="spous_firName">First Name </label>
      <input type="text" name="spous_fname" id="spous_fname" value="<?= (isset($arr1['fmly_spous_fname'])) ?  $arr1['fmly_spous_fname'] : '' ?>">
      <label for="spous_midName">Middle Name </label>
      <input type="text" name="spous_mname" id="spous_name" value="<?= (isset($arr1['fmly_spous_mname'])) ?  $arr1['fmly_spous_mname'] : '' ?>">
      <label for="spous_occup">Occupation </label>
      <input type="text" name="spous_occup" id="spous_occup" value="<?= (isset($arr1['fmly_spous_occup'])) ?  $arr1['fmly_spous_occup'] : '' ?>">
      <label for="spous_empl">Employer/Business name </label>
      <input type="text" name="spous_empl" id="spous_empl" value="<?= (isset($arr1['fmly_spous_emplyr_name'])) ?  $arr1['fmly_spous_emplyr_name'] : '' ?>">
      <label for="spous_busines_addr">Business Address</label>
      <input type="text" name="spous_busines_addr" id="spous_busines_addr" value="<?= (isset($arr1['fmly_spous_busines_addr'])) ?  $arr1['fmly_spous_busines_addr'] : '' ?>">
      <label for="spous_telno">Telephone No.</label>
      <input type="text" name="spous_telno" id="spous_telno" value="<?= (isset($arr1['fmly_spous_telno'])) ?  $arr1['fmly_spous_telno'] : '' ?>">
      <br><br>
      <label for="child_name">23. Name of Children </label>
      <input type="text" name="child_name" id="child_name" value="<?= (isset($arr1['fmly_'])) ?  $arr1['fmly_'] : '' ?>">
      <label for="child_bday">Date of birth</label>
      <input type="date" name="child_bday" id="child_bday" value="<?= (isset($arr1['fmly_'])) ?  $arr1['fmly_'] : '' ?>">
      <br><br>
      <label for="sname_fthr">24. Father's Surname </label>
      <input type="text" name="sname_fthr" id="sname_fthr" value="<?= (isset($arr1['fmly_user_sname_fthr'])) ?  $arr1['fmly_user_sname_fthr'] : '' ?>">
      <label for="fname_fthr">First Name </label>
      <input type="text" name="fname_fthr" id="fname_fthr" value="<?= (isset($arr1['fmly_user_fname_fthr'])) ?  $arr1['fmly_user_fname_fthr'] : '' ?>">
      <label for="mname_fthr">Middle Name </label>
      <input type="text" name="mname_fthr" id="mname_fthr" value="<?= (isset($arr1['fmly_user_mname_fthr'])) ?  $arr1['fmly_user_mname_fthr'] : '' ?>">
      <label for="maiden_mthr">25. Mother's Maiden Name </label>
      <input type="text" name="maiden_mthr" id="maiden_mthr" value="<?= (isset($arr1['fmly_user_maiden_mthr'])) ?  $arr1['fmly_user_maiden_mthr'] : '' ?>">
      <label for="sname_mthr">Surname </label>
      <input type="text" name="sname_mthr" id="sname_mthr" value="<?= (isset($arr1['fmly_user_sname_mthr'])) ?  $arr1['fmly_user_sname_mthr'] : '' ?>">
      <label for="mname_mthr">First Name </label>
      <input type="text" name="mname_mthr" id="mname_mthr" value="<?= (isset($arr1['fmly_user_fname_mthr'])) ?  $arr1['fmly_user_fname_mthr'] : '' ?>">
      <label for="mname_mthr">Middle Name </label>
      <input type="text" name="mname_mthr" id="mname_mthr" value="<?= (isset($arr1['fmly_user_mname_mthr'])) ?  $arr1['fmly_user_mname_mthr'] : '' ?>">
  </fieldset>
  <fieldset disabled="disabled">
      <span>III. Educational Background <a href="uedit3.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a></span>
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
              </tr>
              <tr>
                  <td>
                      Secondary
                  </td>
              </tr>
              <tr>
                  <td>
                      Vocational/Trade Course
                  </td>
              </tr>
              <tr>
                  <td>
                      College
                  </td>
              </tr>
              <tr>
                  <td>
                      Graduate Studies
                  </td>
              </tr>
          </tbody>
      </table>
  </fieldset>
  <fieldset disabled="disabled">
      <span>IV. Civil Service Elegibility <a href="uedit4.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a></span>
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
              <tr>

              </tr>
          </tbody>
      </table>
  </fieldset>
  <fieldset disabled="disabled">
      <span>V. WORK EXPERIENCE <a href="uedit5.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a> <br></span>
      (Include private employment. Start from your recent work)Description of duties should be indicated in the attached Works Experience sheet.
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
              <tr>

              </tr>
          </tbody>
      </table>
  </fieldset>

  <fieldset disabled="disabled">
      <span>VI. VOLUNTARY WORK OR INVOLVEMETN IN CIVIC/
          NON-GOVERNMENT/PEOPLE/VOLUNTARY ORGANIZATIONS <a href="uedit6.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a> </span>
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
              <tr>

              </tr>
          </tbody>
      </table>
  </fieldset>

  <fieldset disabled="disabled">
      <span> VII. LEARNING AND DEVELOPMENT(L&D)INTERVENTIONS/TRAINING PROGRAMS ATTENDED<br>
          (Start from the most L&D/training program and include only the relevant L& D/training takrn for the last five(5)years for Division Chief/Executive/Managerial position) <a href="uedit7.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer"></a> </span>
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
              <tr>

              </tr>
          </tbody>
      </table>
  </fieldset>

  <fieldset disabled="disabled">
      <span>VIII. OTHER INFORMATION <a href="uedit8.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a> </span>
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
              <tr>

              </tr>
          </tbody>
      </table>
  </fieldset>

  <fieldset disabled="disabled">
      <a href="uedit9.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a>
      <span>
          34. Are you related by consaguinity or affinity to the appointing or recommending authority, or to chief of bureau or office or to the person who has immediate supervision over you in the Bureau or Department where you will be apppointed,
          <br>
          a. within the third degree?
          <br>
          b. within the fourth degree (for Local Government Unit - Career Employees)?
          <br>
      </span>
      <input type="radio" name="other_3rd_deg" id="other_3rd_deg_y" value="yes">
      <label for="other_3rd_deg_y">Yes</label>
      <input type="radio" name="other_3rd_deg" id="other_3rd_deg_n" value="no">
      <label for="other_3rd_deg_n">No</label>
      <br>
      <input type="radio" name="other_4th_deg" id="other_4th_deg_y" value="yes">
      <label for="other_4th_deg_y">Yes</label>
      <input type="radio" name="other_4th_deg" id="other_4th_deg_n" value="no">
      <label for="other_4th_deg_n">No</label>
      <br>
      <label for="other_degre_txt">If yes, give details:</label>
      <input type="text" name="other_degre_txt" id="other_degre_txt" value="<?= (isset($arr1['other_degre_txt'])) ?  $arr1['other_degre_txt'] : '' ?>">
      <br><br>
      <span>
          35. a. Have you ever been found guilty of any administrative offense?
      </span>
      <input type="radio" name="other_guilty" id="other_guilty_y" value="yes">
      <label for="other_guilty_y">Yes</label>
      <input type="radio" name="other_guilty" id="other_guilty_n" value="no">
      <label for="other_guilty_n">No</label>
      <label for="other_guilty_text">If yes, give details:</label>
      <input type="text" name="other_guilty_text" id="other_guilty_text" value="<?= (isset($arr1['other_guilty_txt'])) ?  $arr1['other_guilty_txt'] : '' ?>">
      <br>
      b. Have you been criminally charged before any court?
      <input type="radio" name="other_charged" id="other_charged_y" value="yes">
      <label for="other_charged_y">Yes</label>
      <input type="radio" name="other_charged" id="other_charged_n" value="no">
      <label for="other_charged_n">No</label>
      <span>If yes, give details:</span>
      <label for="other_charged_date">Date Filed:</label>
      <input type="date" name="other_charged_date" id="other_charged_date" value="<?= (isset($arr1['other_charged_date'])) ?  $arr1['other_charged_date'] : '' ?>">
      <label for="other_charged_stts">Status of Case/s:</label>
      <input type="text" name="other_charged_stts" id="other_charged_stts" value="<?= (isset($arr1['other_charged_stts'])) ?  $arr1['other_charged_stts'] : '' ?>">
      <br><br>
      <span>36. Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</span>
      <span>37. Have you ever been separated from the service in any of the following modes: resignation,retirement, dropped from the rolls, dismissal, termination, end of term, finished contract orphased out (abolition) in the public or private sector?</span>
      <span>38. a. Have you ever been a candidate in a national or local election held within the last year(except Barangay election)?</span>
      <span>b. Have you resigned from the government service during the three (3)-month period beforethe last election to promote/actively campaign for a national or local candidate?</span>
      <span>39. Have you acquired the status of an immigrant or permanent resident of another country?</span>
      <span>40. 40. Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons(RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:</span>
      <span>a. Are you a member of any indigenous group?</span>
      <span>b. Are you a person with disability?</span>
      <span>c. Are you a solo parent?</span>
      <br><br>

  </fieldset>

  <fieldset disabled="disabled">
      <a href="uedit10.php?user_id=<?=$arr1['user_id']?>" target="_blank" rel="noopener noreferrer">Edit</a>
      41. REFERENCES (Person not related by consanguinity or affinity to applicant /appointee)
      <table class="zui-table" width="100%">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Tel. No.</th>
              </tr>
          </thead>
          <tbody>
              <tr>

              </tr>
          </tbody>
      </table>

      <span>
          42. I declare under oath that I have personally accomplished this Personal Data Sheet which is a true, correct and
          complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the
          Philippines. I authorize the agency head/authorized representative to verify/validate the contents stated
          herein. I agree that any misrepresentation made in this document and its attachments shall cause the
          filing of administrative/criminal case/s against me.
      </span>

      <br>
          <img src="" alt="prf_user_img/passport">
      <br>

      <span>
          Government Issued ID (i.e.Passport, GSIS, SSS, PRC, Driver's License, etc.)
          PLEASE INDICATE ID Number and Date of Issuance
      </span>
      <br>
      <label for="prf_govid_num">Government Issued ID:</label>
      <input type="text" name="prf_govid_num" id="prf_govid_num" value="<?= (isset($arr1['prf_govid_num'])) ?  $arr1['prf_govid_num'] : '' ?>">
      <br>
      <label for="prf_licen_num">ID/License/Passport No.:</label>
      <input type="text" name="prf_licen_num" id="prf_licen_num" value="<?= (isset($arr1['prf_licen_num'])) ?  $arr1['prf_licen_num'] : '' ?>">
      <br>
      <label for="prf_issuance">Date/Place Issuance</label>
      <input type="text" name="prf_issuance" id="prf_issuance" value="<?= (isset($arr1['prf_issuance'])) ?  $arr1['prf_issuance'] : '' ?>">
      
      <br>
      <img src="" alt="prf_signiture_img/digital" name>
      <span>Signiture(Sign on the Box)</span>
      <br>
      <input type="date" name="prf_signiture_date" id="prf_signiture_date" value="<?= (isset($arr1['prf_signiture_date'])) ?  $arr1['prf_signiture_date'] : '' ?>">
      <span>Date accomplished</span>
      <br>

      <img src="" alt="prf_thumbmark_img">
      <span>Right Thumbmark</span>
      <br>
      SUBSCRIBED AND SWORN to before me this <input type="text" name="prf_affiant_name" id="prf_affiant_name" value="<?= (isset($arr1['prf_affiant_name'])) ?  $arr1['prf_affiant_name'] : '' ?>"> , affiant exhibiting his/her validly issued government ID as indicated above.
      <br>
      <img src="" alt="prf_signiture_img_affi">
      <span>Person Administrating Oath</span>
  </fieldset>
</form>





<br><br>
<?php _userfooter(2022); ?>