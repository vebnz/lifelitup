<?php

class Places {

    function showTrail($place_name) {
        $db = Database::obtain();
        
        $sql = "SELECT " . tbl_country . ".name AS country_name, " . tbl_region . ".name AS region_name, " . tbl_places . ".name AS place_name FROM tbl_places
                JOIN " . tbl_region . " ON tbl_places.region_id = " . tbl_region . ".id
                JOIN " . tbl_country . " ON " . tbl_region . ".country_id = " . tbl_country . ".id
                WHERE " . tbl_places . ".name LIKE '%" . $place_name . "%'
                ";

        return $db->query_first($sql);
    }

}

?>
