<?php
// Connection parameters for the source and archive databases
$sourceHost = 'localhost';
$sourceDb = 'aims_db';  // Source database (aims_db)
$archiveHost = 'localhost';
$archiveDb = 'archive_db';  // Archive database
$username = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connect to the source database (aims_db)
        $sourcePdo = new PDO("mysql:host=$sourceHost;dbname=$sourceDb", $username, $password);
        $sourcePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch all students from the source database and join with the departments table
        $stmt = $sourcePdo->prepare("
            SELECT u.first_name, u.last_name, d.department_name AS studentID, u.username
            FROM users u
            LEFT JOIN departments d ON u.department_id = d.id
        ");

        $stmt->execute();
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($students) {
            // Connect to the archive database (archive_db)
            $archivePdo = new PDO("mysql:host=$archiveHost;dbname=$archiveDb", $username, $password);
            $archivePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insert students into the archive database
            $insertStmt = $archivePdo->prepare("
                INSERT INTO archived_students (first_name, last_name, department_name, studentID, username)
                VALUES (:first_name, :last_name, :department_name, :studentID, :username)
            ");

            // Loop through each student and insert into the archive database
            foreach ($students as $student) {
                $insertStmt->execute([
                    'first_name' => $student['first_name'],
                    'last_name' => $student['last_name'],
                    'department_name' => $student['department_name'],
                    'studentID' => $student['studentID'],
                    'username' => $student['username']
                ]);
            }

            // Delete students from the source database (aims_db) after archiving
            $deleteStmt = $sourcePdo->prepare("DELETE FROM users WHERE id IN (SELECT id FROM users)");
            $deleteStmt->execute();

            // Return a success message
            echo json_encode(['status' => 'success', 'message' => 'Students archived successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No students found to archive.']);
        }
    } catch (PDOException $e) {
        // Handle any database connection errors
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
