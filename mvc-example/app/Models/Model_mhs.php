<?php

    /**
     * Model mahasiswa berfungsi untuk menjalankan query
     * Sebelum menggunakan query, load dulu library database
     */

    namespace Models;
    use Libraries\Database;
    use PDO;

    class Model_mhs
    {
        public function __construct()
        {
            $db = new Database();
            $this->dbh = $db->getInstance();
        }

        public function deleteMahasiswa($id) {
            $query = "UPDATE mahasiswa SET deleted_at = NOW() WHERE id = :id";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            
            if (!$stmt->execute()) {
                print_r($stmt->errorInfo()); // Mencetak error SQL
                exit;
            }
        
            return true;
        }

        function simpanData($nim,$nama)
        {
            $rs = $this->dbh->prepare("INSERT INTO mahasiswa (nim,nama) VALUES (?,?)");
            $rs->execute([$nim,$nama]);
        }

        function lihatData()
        {

            $rs = $this->dbh->query("SELECT * FROM mahasiswa");
            return $rs;
        }

        function lihatDataDetail($id)
        {

            $rs = $this->dbh->prepare("SELECT * FROM mahasiswa WHERE id=?");
            $rs->execute([$id]);
            return $rs->fetch();// kalau hasil query hanya satu, gunakan method fetch() bawaan PDO
        }
    }