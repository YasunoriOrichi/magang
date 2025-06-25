<?php

class Omset {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getOmsetByDay($whereClause = '') {
        $query = "SELECT 
                    DATE(i.DATE_INVOICE) AS DATE,
                    SUM(d.TOTAL_PRICE) AS OMSET
                  FROM invoice i
                  JOIN invoice_detail d ON i.ID = d.ID_DETAIL";
    
        if (!empty($whereClause)) {
            $query .= " WHERE $whereClause";
        }
    
        $query .= " GROUP BY DATE(i.DATE_INVOICE) ORDER BY DATE(i.DATE_INVOICE)";
    
        $result = mysqli_query($this->conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
        
    public function getOmsetByWeek($whereClause = '') {
        $query = "SELECT 
                    YEAR(i.DATE_INVOICE) AS tahun,
                    MONTH(i.DATE_INVOICE) AS bulan,
                    WEEK(i.DATE_INVOICE, 1) AS minggu,
                    MIN(DATE(i.DATE_INVOICE)) AS start_date,
                    DATE_ADD(MIN(DATE(i.DATE_INVOICE)), INTERVAL 6 DAY) AS end_date,
                    SUM(d.TOTAL_PRICE) AS OMSET
                  FROM invoice i
                  JOIN invoice_detail d ON i.ID = d.ID_DETAIL";
    
        if (!empty($whereClause)) {
            $query .= " WHERE $whereClause";
        }
    
        $query .= " GROUP BY tahun, minggu ORDER BY tahun, minggu";
    
        $result = mysqli_query($this->conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
                
    public function getOmsetByMonth($whereClause = '') {
        $query = "SELECT 
                    YEAR(i.DATE_INVOICE) AS tahun,
                    MONTH(i.DATE_INVOICE) AS bulan,
                    SUM(d.TOTAL_PRICE) AS OMSET
                  FROM invoice i
                  JOIN invoice_detail d ON i.ID = d.ID_DETAIL";
    
        if (!empty($whereClause)) {
            $query .= " WHERE $whereClause";
        }
    
        $query .= " GROUP BY tahun, bulan ORDER BY tahun, bulan";
    
        $result = mysqli_query($this->conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
                                
    public function getOmsetByCustomer($customerId, $startDate, $endDate) {
        $query = "SELECT SUM(TOTAL_PRICE) AS TOTAL_OMSET FROM invoice_detail WHERE CUSTOMER_ID = '$customerId' AND DATE_INVOICE BETWEEN '$startDate' AND '$endDate'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function bulanIndo($bulan) {
        $bulanIndo = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
    
        return $bulanIndo[$bulan];
    }    
}

?>