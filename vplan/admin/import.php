<?php

class extVplanAdminImport extends AbstractPage {
	
	public static function getSiteDisplayName() {
		return '<i class="fa fas fa-plug"></i> Vertretungsplan - Import';
	}

	public function __construct($request = [], $extension = []) {
		parent::__construct(array( self::getSiteDisplayName() ), false, false, false, $request, $extension);
		$this->checkLogin();
	}

	public function execute() {

		//$this->getRequest();
		//$this->getAcl();
		 //echo URL_SELF;

		$this->render([
			"tmplHTML" => '<div class="box"><div class="box-body"><div id=app></div></div></div>',
			"scripts" => [
				//PATH_COMPONENTS.'system/adminSettings/dist/main.js'
                PATH_EXTENSION.'tmpl/scripts/list/dist/main.js'
			],
			"data" => [
                "apiURL" => "rest.php/vplan",
				"selfURL" => URL_SELF
				//"settings" => $this->getSettings()
			]

		]);

	}

    public function taskUpload() {



        if ( $_FILES && $_FILES['file'] && $_FILES['file']['error'] == 0 ) {

            $filename = $_FILES['file']['name'];

            if ($filename && ( $_FILES['file']['type'] == 'text/plain' || $_FILES['file']['type'] == 'text/html' ) ) {

                $allowed = array('txt','html');

                $ext = strtolower( pathinfo($filename, PATHINFO_EXTENSION) );
                if (!in_array(strtolower($ext), $allowed)) {
                    echo json_encode( [
                        'error' => true,
                        'msg' => 'Dateityp nicht erlaubt!'
                    ]);
                    exit;
                }
                $uploadfile = PATH_ROOT.'tmp'.DS.basename($filename);

                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {


                    include_once PATH_EXTENSION.'..'.DS.'models'.DS.'Upload.class.php';
                    if( extVplanModelUpload::addFile($uploadfile) ) {
                        echo json_encode([
                            'error' => false,
                            'msg' => 'Datei wurde hochgeladen!'
                        ]);
                        exit;
                    } else {
                        echo json_encode([
                            'error' => true,
                            'msg' => 'Fehler beim hinzufügen!'
                        ]);
                        exit;
                    }





                } else {
                    echo json_encode( [
                        'error' => true,
                        'msg' => 'Upload nicht erfolgreich!'
                    ]);
                    exit;
                }
            } else {
                echo json_encode( [
                    'error' => true,
                    'msg' => 'Uploadtyp nicht erlaubt!'
                ]);
                exit;
            }
        } else {
            echo json_encode( [
                'error' => true,
                'msg' => 'Error!'
            ]);
            exit;
        }


    }



}
