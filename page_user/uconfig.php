<?php
require '../php/func.php';
require '../php/conn.php';
require 'udry.php';
session_start();

$uid = $_SESSION['user_id'];
check_id($conn, $uid, "user");


/* NOTESS
ADD SANITIZE
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

instead of filter empty array, replace each empty input with null

*/



/*    USER FUNCTIONS!!!!    */
function userInsert($conn, $tblname, $uid, $arr1 = [], $idname, $idfor)
{
  if (empty($arr1)) {
    return;
  }

  // Add Child
  if (!empty($idname) && !empty($idfor)) {
    // Generate ID
    $id2 = $idfor . bin2hex(random_bytes(7));

    foreach ($arr1 as $key => $value) {
      $fields[] = $key;
      $values[] = ":{$key}";
    }

    $sql = "INSERT INTO $tblname (user_id, $idname, ";
    $sql .= implode(", ", $fields) . ") VALUES (:user_id, :$idname, ";
    $sql .= implode(", ", $values) . ")";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":user_id", $uid);
    $stmt->bindValue(":".$idname, $id2);
    foreach ($arr1 as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt->execute();
    return;
  }


}

function userSelect($conn, $tblname, $uid, $id2, $idname)
{
  if (empty($tblname)) {
    return;
  }
 
  // Select w/ 2 Id's
  if (!empty($id2) && !empty($idname)) {
    try {
      $sql = "SELECT * FROM $tblname ";
      $sql .= "WHERE user_id=:user_id AND $idname=:$idname";
      $stmt = $conn->prepare($sql);
      $stmt->execute([":user_id" => $uid, ":".$idname => $id2]);
      return $stmt;
    } catch (PDOException $e) {
      echo "<br>" . $e->getMessage();
    }
  }

  // Default
  try {
    $sql = "SELECT * FROM $tblname ";
    $sql .= "WHERE user_id=:user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":user_id" => $uid]);
    return $stmt;
  } catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
  } 
}

function userUpdate($conn, $tblname, $uid, $arr1 = [], $id2, $idname)
{
  if (empty($arr1)) {
    return;
  }

  // Update w/ two ID's
  if (!empty($id2) && !empty($idname)) {
    try {
      foreach ($arr1 as $key => $value) {
        $pairs[] = "{$key} = :{$key}";
      }
      $sql = "UPDATE $tblname SET ";
      $sql .= implode(", ", $pairs) . " WHERE user_id=:user_id AND $idname=:$idname";
      // // Uncomment if need checking
      // echo $sql;
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':user_id', $uid);
      $stmt->bindValue(':' . $idname, $id2);
      foreach ($arr1 as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
      }
      $stmt->execute();
    } catch (PDOException $e) {
      echo "<br>" . $e->getMessage();
    }
    return;
  }

  try {
    foreach ($arr1 as $key => $value) {
      $pairs[] = "{$key} = :{$key}";
    }
    $sql = "UPDATE $tblname SET ";
    $sql .= implode(", ", $pairs) . " WHERE user_id=:userid";
    // Uncomment if need checking
    echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':userid', $uid);
    foreach ($arr1 as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt->execute();
  } catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
  }
}

function userDelete($conn, $tblname, $uid, $id2, $idname)
{
  if (empty($uid)) {
    return;
  }

  // Deleting w/ 2 Id's
  if (!empty($id2) && !empty($idname)) {
    try {
      $sql = "DELETE FROM $tblname WHERE user_id=:user_id AND $idname=:$idname";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(":user_id", $uid);
      $stmt->bindvalue(":" . $idname, $id2);
      $stmt->execute();
      return;
    } catch (PDOException $e) {
      echo "<br>" . $e->getMessage();
    }
  }
}

function insertActivity($conn, $str = "", $uid)
{
  if (empty($str) || empty($uid)) {
    return;
  }

  try {
    $sql = "SELECT psl_user_fname, psl_user_sname FROM user_psl_tbl ";
    $sql .= "WHERE user_id=:userid";
    $qry = $conn->prepare($sql);
    $qry->bindValue(":userid", $uid);
    $qry->execute();
    $rows = $qry->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
  }

  $str1 = ucfirst($rows['psl_user_fname']) . " " . ucfirst($rows['psl_user_sname']);
  $str2 = "User named: $str1, " . $str;
  $sql = $qry = null;

  try {
    $sql = "INSERT INTO activity_log (act_time, act_text) VALUES ";
    $sql .= "(NOW(), :act_text)";
    $qry = $conn->prepare($sql);
    $qry->bindValue(':act_text', $str2);
    $qry->execute();
  } catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
  }
}


// UPDATE PERSONAL INFORMATION 
if (isset($_GET['uedit1-btn'])) {
  $psl = array_filter($_GET['psl']);
  $card = array_filter($_GET['card']);
  $addr = array_filter($_GET['addr']);
  $main_user_email = $_GET['main_user_email'];

  // Updates user personal information table
  userUpdate($conn, 'user_psl_tbl', $uid, $psl, null, null);
  // Updates user card table
  userUpdate($conn, 'user_card_tbl', $uid, $card, null, null);
  // Updates user address table
  userUpdate($conn, 'user_addr_tbl', $uid, $addr, null, null);

  // Updates user email
  try {
    $sql = "UPDATE `user_main_tbl` SET main_user_email=:main_user_email ";
    $sql .= "WHERE user_id=:userid";
    $qry = $conn->prepare($sql);
    $qry->bindValue(':main_user_email', $main_user_email);
    $qry->bindValue(':userid', $uid);
    $qry->execute();
  } catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
  }

  // Creates a string for activity logging
  insertActivity($conn, "updated their personal information.", $uid);

  echo "Run successful";
}

// UPDATE FAMILY INFORMATION
if (isset($_GET['uedit2-btn'])) {
  $fmly = array_filter($_GET['fmly']);

  userUpdate($conn, 'user_fmly_tbl', $uid, $fmly, null, null);

  // Creates a string for activity logging
  insertActivity($conn, "updated their family information.", $uid);

  echo "Run successful";
}

// UPDATE EDUC INFORMATION
if (isset($_GET['uedit3-btn'])) {
  $elembg = array_filter($_GET['elembg']);
  $secobg = array_filter($_GET['secobg']);
  $vocabg = array_filter($_GET['vocabg']);
  $collbg = array_filter($_GET['collbg']);
  $gradbg = array_filter($_GET['gradbg']);

  // Updates user's elementary background
  userUpdate($conn, 'user_elembg_tbl', $uid, $elembg, null, null);
  userUpdate($conn, 'user_secobg_tbl', $uid, $secobg, null, null);
  userUpdate($conn, 'user_vocabg_tbl', $uid, $vocabg, null, null);
  userUpdate($conn, 'user_collbg_tbl', $uid, $collbg, null, null);
  userUpdate($conn, 'user_gradbg_tbl', $uid, $gradbg, null, null);

  // Creates a string for activity logging
  insertActivity($conn, "updated their educational background.", $uid);

  echo "<br>Run successful";
}


// CHILD SECTION
if (isset($_GET['addChild-btn'])) {
  $child = array_filter($_GET['uchild']);
  userInsert($conn, "user_child_tbl", $uid, $child, "child_id", "child");

  // Creates a string for activity logging
  insertActivity($conn, "added their child information.", $uid);

  echo "Run successful";
}

if (isset($_GET['editChild-btn'])) {
  $id2 = $_SESSION['child_id'];
  $child = array_filter($_GET['uchild']);
  userUpdate($conn, "user_child_tbl", $uid, $child, $id2, "child_id");

  // Creates a string for activity logging
  insertActivity($conn, "updated their child information.", $uid);

  echo "Run successful";
}

if (isset($_GET['deleteChild-btn'])) {
  $id2 = $_SESSION['child_id'];

  userDelete($conn, "user_child_tbl", $uid, $id2, "child_id");
  unset($_SESSION['child_id']);

  // Creates a string for activity logging
  insertActivity($conn, "deleted their child information.", $uid);

  echo "Run successful";
}


// CIVIL
if (isset($_GET['addCivil-btn'])) {
  $civil = array_filter($_GET['ucivil']);
  userInsert($conn, "user_civil_tbl", $uid, $civil, "civil_id", "civil");

  // Creates a string for activity logging
  insertActivity($conn, "added their civil service information.", $uid);

  echo "Run successful";
}

if (isset($_GET['editCivil-btn'])) {
  $id2 = $_SESSION['civil_id'];
  $civil = array_filter($_GET['ucivil']);
  userUpdate($conn, "user_civil_tbl", $uid, $civil, $id2, "civil_id");

  // Creates a string for activity logging
  insertActivity($conn, "updated their civil service information.", $uid);

  echo "Run successful";
}

if (isset($_GET['deleteCivil-btn'])) {
  $id2 = $_SESSION['civil_id'];

  userDelete($conn, "user_civil_tbl", $uid, $id2, "civil_id");
  unset($_SESSION['civil_id']);

  // Creates a string for activity logging
  insertActivity($conn, "deleted their civil service information.", $uid);

  echo "Run successful";
}


// WORK
if (isset($_GET['addWork-btn'])) {
  $work = array_filter($_GET['uwork']);
  userInsert($conn, "user_work_tbl", $uid, $work, "work_id", "work");

  // Creates a string for activity logging
  insertActivity($conn, "added their work experience.", $uid);

  echo "Run successful";
}

if (isset($_GET['editWork-btn'])) {
  $id2 = $_SESSION['work_id'];
  $work = array_filter($_GET['uwork']);
  userUpdate($conn, "user_work_tbl", $uid, $work, $id2, "work_id");

  // Creates a string for activity logging
  insertActivity($conn, "updated their work experience", $uid);

  echo "Run successful";
}

if (isset($_GET['deleteWork-btn'])) {
  $id2 = $_SESSION['work_id'];

  userDelete($conn, "user_work_tbl", $uid, $id2, "work_id");
  unset($_SESSION['work_id']);

  // Creates a string for activity logging
  insertActivity($conn, "deleted their work information.", $uid);

  echo "Run successful";
}

// VOLUNTARY WORK
if (isset($_GET['addvolu-btn'])) {
  $volu = array_filter($_GET['uvolu']);
  userInsert($conn, "user_volu_tbl", $uid, $volu, "volu_id", "volu");

  // Creates a string for activity logging
  insertActivity($conn, "added their voluntary work information.", $uid);

  echo "Run successful";
}

if (isset($_GET['editvolu-btn'])) {
  $id2 = $_SESSION['volu_id'];
  $volu = array_filter($_GET['uvolu']);
  userUpdate($conn, "user_volu_tbl", $uid, $volu, $id2, "volu_id");

  // Creates a string for activity logging
  insertActivity($conn, "updated their voluntary work information.", $uid);

  echo "Run successful";
}

if (isset($_GET['deletevolu-btn'])) {
  $id2 = $_SESSION['volu_id'];

  userDelete($conn, "user_volu_tbl", $uid, $id2, "volu_id");
  unset($_SESSION['volu_id']);

  // Creates a string for activity logging
  insertActivity($conn, "deleted their voluntary work information.", $uid);

  echo "Run successful";
}

// LND
if (isset($_GET['addlnd-btn'])) {
  $lnd = array_filter($_GET['ulnd']);
  userInsert($conn, "user_lnd_tbl", $uid, $lnd, "lnd_id", "lnd");

  // Creates a string for activity logging
  insertActivity($conn, "added their learning and development information.", $uid);

  echo "Run successful";
}

if (isset($_GET['editlnd-btn'])) {
  $id2 = $_SESSION['lnd_id'];
  $lnd = array_filter($_GET['ulnd']);
  userUpdate($conn, "user_lnd_tbl", $uid, $lnd, $id2, "lnd_id");

  // Creates a string for activity logging
  insertActivity($conn, "updated their learning and development information.", $uid);

  echo "Run successful";
}

if (isset($_GET['deletelnd-btn'])) {
  $id2 = $_SESSION['lnd_id'];

  userDelete($conn, "user_lnd_tbl", $uid, $id2, "lnd_id");
  unset($_SESSION['lnd_id']);

  // Creates a string for activity logging
  insertActivity($conn, "deleted their learning and development information.", $uid);

  echo "Run successful";
}

// OTHER1
if (isset($_GET['addother1-btn'])) {
  $other1 = array_filter($_GET['uother1']);
  userInsert($conn, "user_other1_tbl", $uid, $other1, "other1_id", "other1");

  // Creates a string for activity logging
  insertActivity($conn, "added their learning and development information.", $uid);

  echo "Run successful";
}

if (isset($_GET['editother1-btn'])) {
  $id2 = $_SESSION['other1_id'];
  $other1 = array_filter($_GET['uother1']);
  userUpdate($conn, "user_other1_tbl", $uid, $other1, $id2, "other1_id");

  // Creates a string for activity logging
  insertActivity($conn, "updated their learning and development information.", $uid);

  echo "Run successful";
}

if (isset($_GET['deleteother1-btn'])) {
  $id2 = $_SESSION['other1_id'];

  userDelete($conn, "user_other1_tbl", $uid, $id2, "other1_id");
  unset($_SESSION['other1_id']);

  // Creates a string for activity logging
  insertActivity($conn, "deleted their learning and development information.", $uid);

  echo "Run successful";
}

// OTHER2
if (isset($_GET['editother2-btn'])) {
  $other2 = $_GET['uother2'];
  userUpdate($conn, "user_other2_tbl", $uid, $other2, null, null);

  // Creates a string for activity logging
  insertActivity($conn, "updated their other questionaire answer's.", $uid);

  echo "Run successful";
}

if (isset($_GET['editother3-btn'])) {
  $other3 = $_GET['uother3'];
  userUpdate($conn, "user_other3_tbl", $uid, $other3, null, null);

  // Creates a string for activity logging
  insertActivity($conn, "updated their other card information.", $uid);

  echo "Run successful";
}