<?php

class getList extends AbstractRest {
	
	protected $statusCode = 200;


	public function execute($input, $request) {


        $userID = DB::getSession()->getUser()->getUserID();
        if (!$userID) {
            return [
                'error' => true,
                'msg' => 'Missing User ID'
            ];
        }

        $acl = $this->getAcl();
        if ((int)$acl['rights']['read'] !== 1 && (int)DB::getSession()->getUser()->isAnyAdmin() !== 1 ) {
            return [
                'error' => true,
                'msg' => 'Kein Zugriff'
            ];
        }

        $dayShow = (int)DB::getSettings()->getValue('extVplan-days-show');

        if ($dayShow <= 0) {
            return false;
        }

        $ret = [];

        include_once PATH_EXTENSION . 'models' . DS . 'List.class.php';


        $date = DateFunctions::getTodayAsSQLDate();

//TODO
$date = '2020-09-08';

        // $data = extVplanModelList::getByDate($date);

        for ($i = 1; $i <= $dayShow; $i++) {

            $tmp_data = extVplanModelList::getByDate($date);
            $tmp_item = [];
            foreach ($tmp_data as $item) {
                $tmp_item[] = $item->getCollection();
            }

            $ret[] = [
                "date" => DateFunctions::getNaturalDateFromMySQLDate($date),
                "data" => $tmp_item
            ];

            $date = DateFunctions::addOneDayToMySqlDate($date);
        }





        return $ret;

	}


	/**
	 * Set Allowed Request Method
	 * (GET, POST, ...)
	 * 
	 * @return String
	 */
	public function getAllowedMethod() {
		return 'GET';
	}


    /**
     * Muss der Benutzer eingeloggt sein?
     * Ist Eine Session vorhanden
     * @return Boolean
     */
    public function needsUserAuth() {
        return true;
    }

    /**
     * Ist eine Admin berechtigung nötig?
     * only if : needsUserAuth = true
     * @return Boolean
     */
    public function needsAdminAuth()
    {
        return false;
    }
    /**
     * Ist eine System Authentifizierung nötig? (mit API key)
     * only if : needsUserAuth = false
     * @return Boolean
     */
    public function needsSystemAuth() {
        return false;
    }

}	

?>