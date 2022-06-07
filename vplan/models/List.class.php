<?php
/**
 *
 */
class extVplanModelList
{


    /**
     * @var data []
     */
    private $data = [];


    /**
     * Constructor
     * @param $data
     */
    public function __construct($data = false)
    {
        if (!$data) {
            $data = $this->data;
        }
        $this->setData($data);
    }

    /**
     * @return data
     */
    public function setData($data = [])
    {
        $this->data = $data;
        return $this->getData();
    }

    /**
     * @return data
     */
    public function getData() {
        return $this->data;
    }


    /**
     * Getter
     */
    public function getID() {
        return $this->data['id'];
    }
    public function getDate() {
        return $this->data['date'];
    }
    public function getKlasse() {
        return $this->data['klasse'];
    }
    public function getStunde() {
        return $this->data['stunde'];
    }
    public function getUserAlt() {
        return $this->data['user_alt'];
    }
    public function getUserNeu() {
        return $this->data['user_neu'];
    }
    public function getFachAlt() {
        return $this->data['fach_alt'];
    }
    public function getFachNeu() {
        return $this->data['fach_neu'];
    }
    public function getRaum() {
        return $this->data['raum'];
    }
    public function getInfo() {
        return $this->data['info'];
    }


    public function getCollection() {

        $collection = [
            "id" => $this->getID(),
            "date" => $this->getDate(),
            "klasse" => $this->getKlasse(),
            "stunde" => $this->getStunde(),
            "user_alt" => $this->getUserAlt(),
            "user_neu" => $this->getUserNeu(),
            "fach_alt" => $this->getFachAlt(),
            "fach_neu" => $this->getFachNeu(),
            "raum" => $this->getRaum(),
            "info" => $this->getInfo()
        ];

        return $collection;
    }



    /**
     * @return Array[]
     */
    public static function getByDate($date = false) {

        if (!$date) {
            return false;
        }

        $ret = [];


        $dataSQL = DB::getDB()->query("SELECT * FROM ext_vplan WHERE `date` = '".$date."'");
        while ($data = DB::getDB()->fetch_array($dataSQL, true)) {
            $ret[] = new self($data);
        }
        return $ret;


    }


}