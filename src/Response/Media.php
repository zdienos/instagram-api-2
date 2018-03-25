<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 18.03.2018
 * Time: 02:04
 */

namespace Ismailcaakir\InstagramAPI\Response;


class Media extends Response
{

    protected $media_count = null;

    protected $has_next_page = false;

    protected $next_max_id = null;

    protected $items = array();


    /**
     * Media constructor.
     */
    public function __construct($data)
    {
        if(is_null($data))
        {
            throw new \Exception("Data is null");
        }


        $mediaData = $data->data->user->edge_owner_to_timeline_media;

        $this->media_count = $mediaData->count;

        if (isset($mediaData->page_info->has_next_page))
        {
            $this->has_next_page = $mediaData->page_info->has_next_page;
        }

        if (isset($mediaData->page_info->end_cursor))
        {
            $this->next_max_id = $mediaData->page_info->end_cursor;
        }

        foreach ($mediaData->edges as $index => $item)
        {
            $this->items[$index] = new MediaItem($item->node);
        }

    }


    /**
     * @return null
     */
    public function getMediaCount()
    {
        return $this->media_count;
    }

    /**
     * @return bool
     */
    public function isHasNextPage()
    {
        return $this->has_next_page;
    }

    /**
     * @return null
     */
    public function getNextMaxId()
    {
        return $this->next_max_id;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

}