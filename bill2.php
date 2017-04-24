<?php require_once('Connections/MyConnecting.php'); ?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_MyConnecting, $MyConnecting);
$query_ShowData = "SELECT * FROM billcustomers";
$ShowData = mysql_query($query_ShowData, $MyConnecting) or die(mysql_error());
$row_ShowData = mysql_fetch_assoc($ShowData);
$totalRows_ShowData = mysql_num_rows($ShowData);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<form action="search.php" method="post" enctype="multipart/form-data" name="Bill" id="Bill">
  <p><strong>ค้นหาข้อมูล รหัสสินค้ามประเภทสินค้าเเละวันที่</strong></p>
  Search :
  <input type="text" name="word" id="word" />
  
  <input type="submit" name="btnSearch" id="btnSearch" value="ค้นหาข้อมูล" />
  <table border="1">
    <tr>
      <td align="center">รหัสสินค้า</td>
      <td align="center">ประเภทสินค้า</td>
      <td align="center">ชื่อลูกค้า</td>
      <td align="center">นามสกุลลูกค้า</td>
      <td align="center">ชื่อสินค้า</td>
      <td align="center">จำนวนสินค้า</td>
      <td align="center">ราคาสินค้า</td>
      <td align="center">วันที่เพิ่มข้อมูล</td>
      <td colspan="2">เครื่องมือ</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_ShowData['Code_Item']; ?></td>
        <td><?php echo $row_ShowData['Type_Item']; ?></td>
        <td><?php echo $row_ShowData['Customer_Name']; ?></td>
        <td><?php echo $row_ShowData['Customer_Lname']; ?></td>
        <td><?php echo $row_ShowData['Name_Item']; ?></td>
        <td><?php echo $row_ShowData['Count_Item']; ?></td>
        <td><?php echo $row_ShowData['Pice_Item']; ?></td>
         <td colspan="2"><?php echo $row_ShowData['Date_Item']; ?>           <p></p></td>
        <td><a href="delete.php?Code_Item=<?php echo $row_ShowData['Code_Item']; ?>">Delete</a></td>
        <td><a href="update.php?Code_Item=<?php echo $row_ShowData['Code_Item']; ?>">Edit</a></td>
        <td><img src="<?php echo $row_ShowData['picture']; ?>" /></td>
      </tr>
      <?php } while ($row_ShowData = mysql_fetch_assoc($ShowData)); ?>
  </table>
<p>&nbsp; </p>
<p></p>
<p>&nbsp;</p>
<p></p>
 <p><a href="insert.php?Code_Item=<?php echo $row_ShowData['Code_Item']; ?>">เพิ่มข้อมูลใหม่</a></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
<?php
mysql_free_result($ShowData);
?>
