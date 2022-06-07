<?php
/**
 *
 */
class extVplanModelUpload
{



    public static function addFile($file = false) {

        if (!$file) {
            return false;
        }
        if (!file_exists($file)) {
            return false;
        }

        $html = file_get_contents($file);

        $dom = new DOMDocument;
        $dom->loadHTML($html);


        $finder = new DomXPath($dom);
        $classname="KBlock Kopf";
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        /*
        echo '<pre>';
        print_r($nodes);
        echo '</pre>';
        */

        $body = $dom->getElementsByTagName('body');
        foreach ( $body as $node) {

            //echo $node->nodeValue, PHP_EOL;


            if($node->hasChildNodes()) {
                foreach ($node->childNodes as $box) {
                    if($box->hasChildNodes()) {
echo 'tag:';
                        foreach ($box->childNodes as $box2) {
                            if($box2->hasChildNodes()) {
                                echo '<pre>';
                                print_r($box2->getAttribute('class'));
                                echo '</pre>';
                            }
                        }

                    }
                }
            }
/*
            //echo $node->nodeValue.'<br>';
            $plan = $node->childNodes;

            foreach ($plan as $box) {
            //for ($i = 0; $i < $plan->length; $i++) {
                echo '<pre>';
                print_r($box);
                echo '</pre>';
                //echo $box->getAttribute('class').'<br>';
            }
            */
            //echo $dom->saveHtml($node), PHP_EOL;
        }

/*
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {

                // UNTIS
                $data = [
                    "date" => trim(utf8_encode($data[1])),
                    "klasse" => trim(utf8_encode($data[14])),
                    "stunde" => trim(utf8_encode($data[2])),
                    "user_alt" => trim(utf8_encode($data[5])),
                    "user_neu" => trim(utf8_encode($data[6])),
                    "fach_neu" => trim(utf8_encode($data[9])),
                    "fach_alt" => trim(utf8_encode($data[7])),
                    "raum" => trim(utf8_encode($data[12])),
                    "info" => trim(utf8_encode($data[16]))
                ];
                $data['date'] = substr($data['date'],0,4).'-'.substr($data['date'],4,2).'-'.substr($data['date'],6,2);

                self::insertData($data);


            }
            fclose($handle);
        }
*/
        return true;

    }


    private static function insertData($data = false) {

        if (!$data) {
            return false;
        }

        $userID = DB::getSession()->getUser()->getUserID();
        if (!$userID) {
            return false;
        }

        if (!DB::getDB()->query("INSERT INTO ext_vplan
            (
                createdTime,
                createdUser,
                date,
                klasse,
                stunde,
                user_alt,
                user_neu,
                fach_neu,
                fach_alt,
                raum,
                info
            ) values(
                '".date('Y-m-d H:i', time())."',
                ".$userID.",
                '" . DB::getDB()->escapeString($data['date']) . "',
                '" . DB::getDB()->escapeString($data['klasse']) . "',
                '" . DB::getDB()->escapeString($data['stunde']) . "',
                '" . DB::getDB()->escapeString($data['user_alt']) . "',
                '" . DB::getDB()->escapeString($data['user_neu']) . "',
                '" . DB::getDB()->escapeString($data['fach_neu']) . "',
                '" . DB::getDB()->escapeString($data['fach_alt']) . "',
                '" . DB::getDB()->escapeString($data['raum']) . "',
                '" . DB::getDB()->escapeString($data['info']) . "'
            )
		    ")) {
            return true;
        }

    }



}