<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CInstagram extends CBitrixComponent
{
    public function getPosts($username, $id = 0, $endcursor = '')
    {
        if (function_exists('curl_init')) {
            if ($id != 0) {
                $url = "https://www.instagram.com/graphql/query/?query_id=17888483320059182&id=" . $id . "&first=12&after=" . $endcursor;
            } else {
                $url = "https://www.instagram.com/" . $username . "/?__a=1" . $endcursor;
            }

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);

            $objResponse = json_decode($response);

            if ($id != 0) {
                return array(
                    'end_cursor' => $objResponse->data->user->edge_owner_to_timeline_media->page_info->end_cursor, 
                    'posts'      => $objResponse->data->user->edge_owner_to_timeline_media->edges
                );
            } else {
                return array(
                    'id'         => $objResponse->graphql->user->id, 
                    'end_cursor' => $objResponse->graphql->user->edge_owner_to_timeline_media->page_info->end_cursor, 
                    'posts'      => $objResponse->graphql->user->edge_owner_to_timeline_media->edges
                );
            }
        } else {
            return false;
        }
    }
}?>
