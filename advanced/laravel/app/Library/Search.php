<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 18:51
 */
namespace App\Library;

/**
 * Class Search
 * @package App\Library
 */
class Search
{
    /**
     * @param array $params
     * @param array $itemsToSearch
     * @return array
     */
    public function search(array $params, array $itemsToSearch): array {
        $items = [];
        foreach ($params as $key => $value) {
            $items[] = array_filter($itemsToSearch, function($item) use ($key, $value) {
                $item = (array) $item;
                $regex = "/".$value."*/";
                if(preg_match($regex, $item[$key], $match)) {
                    return true;
                }
                return ($item[$key] == $value);
            });
        }
        return $items;
    }
}