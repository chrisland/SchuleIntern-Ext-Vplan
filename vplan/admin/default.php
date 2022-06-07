<?php

class extVplanAdminDefault extends AbstractPage {
	
	public static function getSiteDisplayName() {
		return '<i class="fa fas fa-plug"></i> Vertretungsplan - Admin Einstellungen';
	}

	public function __construct($request = [], $extension = []) {
		parent::__construct(array( self::getSiteDisplayName() ), false, false, false, $request, $extension);
		$this->checkLogin();
	}

	public function execute() {

		//$this->getRequest();
		//$this->getAcl();
		
		$this->render([
			"tmplHTML" => '<div class="box"><div class="box-body"><div id=app></div></div></div>',
			"scripts" => [
				PATH_COMPONENTS.'system/adminSettings/dist/main.js'
			],
			"data" => [
				"selfURL" => URL_SELF,
				"settings" => $this->getSettings()
			]

		]);

	}


    public static function getSettingsDescription() {

        $settings = array(
            array(
                'name' => "extVplan-days-show",
                'typ' => "NUMBER",
                'title' => "Wie viele Tage sollen angezeigt werden?",
                'desc' => "Default: 2 (Heute und Morgen)"
            )
        );
        return $settings;

    }

    public function taskSave($postData) {

        $request = $this->getRequest();
        if ($request['page'] && $postData['settings']) {
            foreach($postData['settings'] as $item) {
                DB::getDB()->query("INSERT INTO settings (settingName, settingValue, settingsExtension)
				values ('" .DB::getDB()->escapeString($item['name']) . "',
				'" . DB::getDB()->escapeString(($item['value'])) . "'
				,'" . DB::getDB()->escapeString(($request['page'])) . "')
				ON DUPLICATE KEY UPDATE settingValue='" . DB::getDB()->escapeString($item['value']) . "'");
            }
            echo json_encode(['done' => 'true']);
        } else {
            echo json_encode(['error' => 'Fehler beim Speichern!']);
        }
    }



}
