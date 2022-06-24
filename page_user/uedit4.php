<?php
require 'uconfig.php';

$uid = $_SESSION['user_id'];
check_id($conn, $uid, "user");

echo "<h1>Edit Educational Background</h1>
        $uid<br>";
_userheader("Test");
?>
<!-- Style Sheet Link -->
<link rel="stylesheet" href="css/style-user.css">

<br><a href="uindex.php">Go back</a>

<?php 
$getother2 = userSelect($conn, "user_other2_tbl", $uid, null, null); 
$other2 = $getother2->fetch(PDO::FETCH_ASSOC); ?>
<form action="uconfig.php" method="get">
    <fieldset>
    <span>
            34. Are you related by consaguinity or affinity to the appointing or recommending authority, or to chief of bureau or office or to the person who has immediate supervision over you in the Bureau or Department where you will be apppointed,
        </span>
        <br>
        a. within the third degree?
        <input type="radio" name="uother2[other2_34_ayn]" id="other2_34_ayn" <?= $other2['other2_34_ayn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_34_ayn">Yes</label>
        <input type="radio" name="uother2[other2_34_ayn]" id="other2_34_ayn" <?= $other2['other2_34_ayn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_34_ayn">No</label>
        <br>
        b. within the fourth degree (for Local Government Unit - Career Employees)?
        <input type="radio" name="uother2[other2_34_byn]" id="other2_34_byn" <?= $other2['other2_34_byn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_34_byn">Yes</label>
        <input type="radio" name="uother2[other2_34_byn]" id="other2_34_byn" <?= $other2['other2_34_byn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_34_byn">No</label>
        <label for="other2_34_txt">If yes, give details:</label>
        <input type="text" name="uother2[other2_34_txt]" id="other2_34_txt" value="<?= (isset($other2['other2_34_txt'])) ?  $other2['other2_34_txt'] : '' ?>">
        <br><br>
        <span>
            35. a. Have you ever been found guilty of any administrative offense?
        </span>
        <input type="radio" name="uother2[other2_35_ayn]" id="other2_35_ayn" <?= $other2['other2_35_ayn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_35_ayn">Yes</label>
        <input type="radio" name="uother2[other2_35_ayn]" id="other2_35_ayn" <?= $other2['other2_35_ayn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_35_ayn">No</label>
        <label for="other2_35_atxt">If yes, give details:</label>
        <input type="text" name="uother2[other2_35_atxt]" id="other2_35_atxt" value="<?= (isset($other2['other2_35_atxt'])) ?  $other2['other2_35_atxt'] : '' ?>">
        <br>
        b. Have you been criminally charged before any court?
        <input type="radio" name="uother2[other2_35_byn]" id="other2_35_byn" <?= $other2['other2_35_byn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_35_byn">Yes</label>
        <input type="radio" name="uother2[other2_35_byn]" id="other2_35_byn" <?= $other2['other2_35_byn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_35_byn">No</label>
        <span>If yes, give details:</span>
        <label for="other2_35_bdate">Date Filed:</label>
        <input type="date" name="uother2[other2_35_bdate]" id="other2_35_bdate" value="<?= (isset($other2['other2_35_bdate'])) ?  $other2['other2_35_bdate'] : '' ?>">
        <label for="other2_35_btxt">Status of Case/s:</label>
        <input type="text" name="uother2[other2_35_btxt]" id="other2_35_btxt" value="<?= (isset($other2['other2_35_btxt'])) ?  $other2['other2_35_btxt'] : '' ?>">
        <br><br>
        <span>36. Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</span>
        <input type="radio" name="uother2[other2_36_yn]" id="other2_36_yn" <?= $other2['other2_36_yn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_36_yn">Yes</label>
        <input type="radio" name="uother2[other2_36_yn]" id="other2_36_yn" <?= $other2['other2_36_yn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_36_yn">No</label>
        <label for="other2_36_txt">If yes, give details:</label>
        <input type="text" name="uother2[other2_36_txt]" id="other2_36_txt" value="<?= (isset($other2['other2_36_txt'])) ?  $other2['other2_36_txt'] : '' ?>">
        <br><br>
        <span>37. Have you ever been separated from the service in any of the following modes: resignation,retirement, dropped from the rolls, dismissal, termination, end of term, finished contract orphased out (abolition) in the public or private sector?</span>
        <input type="radio" name="uother2[other2_37_yn]" id="other2_37_yn" <?= $other2['other2_37_yn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_37_yn">Yes</label>
        <input type="radio" name="uother2[other2_37_yn]" id="other2_37_yn" <?= $other2['other2_37_yn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_37_yn">No</label>
        <label for="other2_37_txt">If yes, give details:</label>
        <input type="text" name="uother2[other2_37_txt]" id="other2_37_txt" value="<?= (isset($other2['other2_37_txt'])) ?  $other2['other2_37_txt'] : '' ?>">
        <br><br>
        <span>38. a. Have you ever been a candidate in a national or local election held within the last year(except Barangay election)?</span>
        <input type="radio" name="uother2[other2_38_ayn]" id="other2_38_ayn" <?= $other2['other2_38_ayn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_38_ayn">Yes</label>
        <input type="radio" name="uother2[other2_38_ayn]" id="other2_38_ayn" <?= $other2['other2_38_ayn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_38_ayn">No</label>
        <label for="other2_38_atxt">If yes, give details:</label>
        <input type="text" name="uother2[other2_38_atxt]" id="other2_38_atxt" value="<?= (isset($other2['other2_38_atxt'])) ?  $other2['other2_38_atxt'] : '' ?>">
        <br><br>
        <span>b. Have you resigned from the government service during the three (3)-month period beforethe last election to promote/actively campaign for a national or local candidate?</span>
        <input type="radio" name="uother2[other2_38_byn]" id="other2_38_byn" <?= $other2['other2_38_byn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_38_byn">Yes</label>
        <input type="radio" name="uother2[other2_38_byn]" id="other2_38_byn" <?= $other2['other2_38_byn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_38_byn">No</label>
        <label for="other2_38_btxt">If yes, give details:</label>
        <input type="text" name="uother2[other2_38_btxt]" id="other2_38_btxt" value="<?= (isset($other2['other2_38_btxt'])) ?  $other2['other2_38_btxt'] : '' ?>">
        <br><br>
        <span>39. Have you acquired the status of an immigrant or permanent resident of another country?</span>
        <input type="radio" name="uother2[other2_39_ayn]" id="other2_39_ayn" <?= $other2['other2_39_yn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_39_ayn">Yes</label>
        <input type="radio" name="uother2[other2_39_ayn]" id="other2_39_ayn" <?= $other2['other2_39_yn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_39_ayn">No</label>
        <label for="other2_39_txt">If yes, give details:</label>
        <input type="text" name="uother2[other2_39_txt]" id="other2_39_txt" value="<?= (isset($other2['other2_39_txt'])) ?  $other2['other2_39_txt'] : '' ?>">
        <br><br>
        <span>40. 40. Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons(RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:</span>
        <br>
        <span>a. Are you a member of any indigenous group?</span>
        <input type="radio" name="uother2[other2_40_ayn]" id="other2_40_ayn" <?= $other2['other2_40_ayn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_40_ayn">Yes</label>
        <input type="radio" name="uother2[other2_40_ayn]" id="other2_40_ayn" <?= $other2['other2_40_ayn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_40_ayn">No</label>
        <label for="other2_40_atxt">If yes, give details:</label>
        <input type="text" name="uother2[other2_40_atxt]" id="other2_40_atxt" value="<?= (isset($other2['other2_40_atxt'])) ?  $other2['other2_40_atxt'] : '' ?>">
        <br>
        <span>b. Are you a person with disability?</span>
        <input type="radio" name="uother2[other2_40_byn]" id="other2_40_byn" <?= $other2['other2_40_byn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_40_byn">Yes</label>
        <input type="radio" name="uother2[other2_40_byn]" id="other2_40_byn" <?= $other2['other2_40_byn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_40_byn">No</label>
        <label for="other2_40_btxt">If yes, give details:</label>
        <input type="text" name="uother2[other2_40_btxt]" id="other2_40_btxt" value="<?= (isset($other2['other2_40_btxt'])) ?  $other2['other2_40_btxt'] : '' ?>">
        <br>
        <span>c. Are you a solo parent?</span>
        <input type="radio" name="uother2[other2_40_cyn]" id="other2_40_cyn" <?= $other2['other2_40_cyn'] == "yes" ? "checked" : "" ?> value="yes">
        <label for="other2_40_cyn">Yes</label>
        <input type="radio" name="uother2[other2_40_cyn]" id="other2_40_cyn" <?= $other2['other2_40_cyn'] == "no" ? "checked" : "" ?> value="no">
        <label for="other2_40_cyn">No</label>
        <label for="other2_40_ctxt">If yes, give details:</label>
        <input type="text" name="uother2[other2_40_ctxt]" id="other2_40_ctxt" value="<?= (isset($other2['other2_40_ctxt'])) ?  $other2['other2_40_ctxt'] : '' ?>">
        <br><br>

        <button type="submit" name="editother2-btn">Test</button>
    </fieldset>
</form>

<?php _userfooter(2022); ?>