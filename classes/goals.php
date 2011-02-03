<?php

class Goals {

	function showAll($userid) {
		$db = Database::obtain();

		if (empty($userid)) {
			return;
		}

		$sql = "SELECT " . tbl_goals . ".id, name, icon, category_id, descriptive_image
			FROM " . tbl_goals . "
			LEFT OUTER JOIN " . tbl_todo . " ON " . tbl_goals .".id = " . tbl_todo . ".goal_id
			AND " . tbl_todo . ".user_id = " . intval($userid) ."
			LEFT OUTER JOIN " . tbl_achievements . " ON " . tbl_goals . ".id = " . tbl_achievements . ".goal_id
			AND " . tbl_achievements . ".user_id =  " . intval($userid) ."
			WHERE " . tbl_todo . ".goal_id IS NULL
			AND " . tbl_achievements . ".goal_id IS NULL";
		
		return $db->fetch_array($sql);

	}


    function searchGoals($userid, $search_string) {
        $db = Database::obtain();

        if (empty($userid)) {
            return 1;
        }   

		if (empty($search_string)) {
			return 2;
		}

        $sql = "SELECT " . tbl_goals . ".id, name, icon, category_id, descriptive_image
            FROM " . tbl_goals . " 
            LEFT OUTER JOIN " . tbl_todo . " ON " . tbl_goals .".id = " . tbl_todo . ".goal_id
            AND " . tbl_todo . ".user_id = " . intval($userid) ."
            LEFT OUTER JOIN " . tbl_achievements . " ON " . tbl_goals . ".id = " . tbl_achievements . ".goal_id
            AND " . tbl_achievements . ".user_id =  " . intval($userid) ."
            WHERE " . tbl_todo . ".goal_id IS NULL
            AND " . tbl_achievements . ".goal_id IS NULL
			AND " . tbl_goals . ".name LIKE '%" . $search_string . "%'
			OR " . tbl_goals . ".info LIKE '%" . $search_string . "%'";
       
        return $db->fetch_array($sql);

    } 

	function showByPlace($userid, $location) {
    	$db = Database::obtain();

        if (empty($userid)) {
        	return 1;
        }

		if (empty($location)) {
			return 2;
		}

        $sql = "SELECT " . tbl_goals . ".id, name, icon, category_id, descriptive_image
                FROM " . tbl_goals . "
                LEFT OUTER JOIN " . tbl_todo . " ON " . tbl_goals .".id = " . tbl_todo . ".goal_id
                AND " . tbl_todo . ".user_id = " . intval($userid) ."
                LEFT OUTER JOIN " . tbl_achievements . " ON " . tbl_goals . ".id = " . tbl_achievements . ".goal_id
                AND " . tbl_achievements . ".user_id =  " . intval($userid) ."
                WHERE " . tbl_todo . ".goal_id IS NULL
                AND " . tbl_achievements . ".goal_id IS NULL
				AND " . tbl_goals . ".location LIKE '%" . $location . "%'";
		
		return $db->fetch_array($sql);
	}

	function showByCountry($userid, $country) {
		$db = Database::obtain();

		if (empty($userid)) {
			return 1;
		}

		if (empty($country)) {
			return 2;
		}

		$sql = "SELECT " . tbl_goals . ".id, " . tbl_goals .".name, icon, category_id, descriptive_image
				FROM " . tbl_goals . "
				LEFT OUTER JOIN " . tbl_todo . " ON " . tbl_goals .".id = " . tbl_todo . ".goal_id
				AND " . tbl_todo . ".user_id = " . intval($userid) ."
				LEFT OUTER JOIN " . tbl_achievements . " ON " . tbl_goals . ".id = " . tbl_achievements . ".goal_id
				AND " . tbl_achievements . ".user_id =  " . intval($userid) ."
				JOIN " . tbl_places . " ON " . tbl_goals . ".location = " . tbl_places . ".name
				JOIN " . tbl_region . " ON " . tbl_places . ".region_id = " . tbl_region . ".id
				JOIN " . tbl_country . " ON " . tbl_region . ".country_id = " . tbl_country . ".id
				WHERE " . tbl_todo . ".goal_id IS NULL
                AND " . tbl_achievements . ".goal_id IS NULL
				AND " . tbl_country . ".name LIKE '%" . $country . "%'";

		return $db->fetch_array($sql);
	}

    function showByRegion($userid, $region) {
        $db = Database::obtain();

		if (empty($userid)) {
			return 1;
		}

        if (empty($region)) {
            return 2;
        }   

        $sql = "SELECT " . tbl_goals . ".id, " . tbl_goals .".name, icon, category_id, descriptive_image
                FROM " . tbl_goals . " 
                LEFT OUTER JOIN " . tbl_todo . " ON " . tbl_goals .".id = " . tbl_todo . ".goal_id
                AND " . tbl_todo . ".user_id = " . intval($userid) ."
                LEFT OUTER JOIN " . tbl_achievements . " ON " . tbl_goals . ".id = " . tbl_achievements . ".goal_id
                AND " . tbl_achievements . ".user_id =  " . intval($userid) ."
                JOIN " . tbl_places . " ON " . tbl_goals . ".location = " . tbl_places . ".name
                JOIN " . tbl_region . " ON " . tbl_places . ".region_id = " . tbl_region . ".id
                JOIN " . tbl_country . " ON " . tbl_region . ".country_id = " . tbl_country . ".id
                WHERE " . tbl_todo . ".goal_id IS NULL
                AND " . tbl_achievements . ".goal_id IS NULL
                AND " . tbl_region . ".name LIKE '%" . $region . "%'";

        return $db->fetch_array($sql);
    }   

	function showByCategory($category = 1) {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon, descriptive_image 
			FROM " . tbl_goals . "
			WHERE category_id = " . (int)$category;
		return $db->fetch_array($sql);
	}

	function show($id) {
		$db = Database::obtain();

		$sql = "SELECT id, name, icon, info, descriptive_image, location
			FROM " . tbl_goals . "
			WHERE id = " . (int)$id;
		return $db->query_first($sql);
	}

	function showCategories() {
		$db = Database::obtain();

		$sql = "SELECT id, name
				FROM " . tbl_category;
		return $db->fetch_array($sql);
	}
}

?>
