<?php
// Server information
$server   = "DESKTOP-QFAKDN8\MSSQLSERVER01";
$database = "deneme";
$uid      = "yilmaz";
$pwd      = "159753";

// Connection
try {
    $conn = new PDO("sqlsrv:server=$server;Database=$database", $uid, $pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to SQL Server" . $e->getMessage());
}
if (isset($_POST)) {
    if (isset($_POST['backupAl'])) {
        $sql = "
           DECLARE @date VARCHAR(19)
           SET @date = CONVERT(VARCHAR(19), GETDATE(), 126)
           SET @date = REPLACE(@date, ':', '-')
           SET @date = REPLACE(@date, 'T', '-')
           
           DECLARE @fileName VARCHAR(100)
           SET @fileName = ('C:\\Program Files\\Microsoft SQL Server\\backup\\BackUp_' + @date + '.bak')
           
           BACKUP DATABASE hastane
           TO DISK = @fileName
           WITH 
               FORMAT,
               STATS = 1, 
               MEDIANAME = 'SQLServerBackups',
               NAME = 'Full Backup of dbname';
       ";
    } else if (isset($_POST['restoreYap'])) {

        $backupYolu = realpath($_FILES["backupFile"]["tmp_name"]);
        $sql = "


RESTORE DATABASE [hastane] FROM DISK = '$backupYolu' WITH RECOVERY

        ";
    }
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error executing query. " . $e->getMessage());
    }

    // Clear buffer
    try {
        while ($stmt->nextRowset() != null) {
        };
        echo "Başarılı!";
    } catch (PDOException $e) {
        die("Error executing query. " . $e->getMessage());
    }

    // End
    $stmt = null;
    $conn = null;
}
