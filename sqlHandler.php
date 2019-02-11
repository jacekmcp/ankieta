<?php

class sqlHandler{

    private $servername = "localhost";
    private $username = "root";
    private $password = "99dazCtw";
    private $dbName = "ankieta_kasi";

    private $conn;
    private $algType;

    /**
     * sqlHandler constructor.
     * @param $conn
     */
    public function __construct(){

        $this->conn = mysqli_connect($this->servername, $this->username, $this->password);


        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }


        $this->algType = $this->getAlgTypeFromDB();
    }


    public function executeInsertQuery($query){
        if ($this->conn->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function executeUpdateQuery($q){
        print_r($q);
        if ($this->conn->query($q) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->conn->error;
        }
    }



    public function getSetByAlgType($algType){

        $q = "SELECT * FROM photos WHERE `type` = ".$algType;

        $result = $this->conn->query($q);

        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                echo "dupa";
            }
        }else echo 'xDDD';


        $this->getPrimarySet();

        return 'dupa';
    }

    private function getPrimarySet(){
        $q = "SELECT * FROM photos WHERE `type` = 'groundtruth'";

        $result = $this->conn->query($q);

        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                echo "dupaGT";
            }
        }else echo 'xDDDGT';


        return 'dupaGT';
    }

    public function updateResults($truth, $recolorized, $algType){

        $q = "UPDATE ankieta_kasi.results SET truth = truth + ".$truth.", recolorized = recolorized +".$recolorized." WHERE algType = '".$algType."'";

        print_r($q);

        if ($this->conn->query($q) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->conn->error;
        }

    }

    /**
     * @return mixed
     */
    public function getAlgType()
    {
        return $this->algType;
    }


    public function getAlgTypeFromDB(){

        $q = "SELECT * FROM ankieta_kasi.results";


        $result = $this->conn->query($q);



        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $truth = $row['truth'];
                $recolorized = $row['recolorized'];

                $count = $truth + $recolorized;

                if($count < 480) return $row['algType'];
            }

        die('ankieta juz sie zakonczyla, czekamy na wyniki a Jacek to super mega software developer :)');
        } else {
            echo "0 results";
        }
    }


}


