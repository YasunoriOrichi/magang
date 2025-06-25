<?php

class BestSeller {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getBestSeller() {
        $query = "SELECT 
                    it.ID,
                    it.NAME,
                    SUM(d.QTY) AS total_qty
                  FROM invoice i
                  JOIN invoice_detail d ON i.ID = d.ID_DETAIL
                  JOIN item it ON d.ITEM = it.ID
                  GROUP BY it.ID, it.NAME
                  ORDER BY total_qty DESC
                  LIMIT 10";    
    
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Query error: " . mysqli_error($this->conn));
        }
    
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

?>