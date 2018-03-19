<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 17.03.2018
 * Time: 21:41
 */

namespace Ismailcaakir\Inspublic\Response;


class MediaItem
{

    protected $__typename = null;
    protected $id = null;
    protected $caption = null;
    protected $shortcode = null;
    protected $comment_count = null;
    protected $comments_disabled = null;
    protected $timestamp = null;
    protected $display_url = null;
    protected $liked_count = null;
    protected $thumbnail_small = null;
    protected $thumbnail_medium = null;
    protected $thumbnail_normal = null;
    protected $thumbnail_large = null;
    protected $thumbnail_xlarge = null;
    protected $is_video = null;
    protected $video_view_count = null;

    /**
     * Media constructor.
     */
    public function __construct($item)
    {

        $this->__typename = $item->__typename;
        $this->id = $item->id;
        $this->shortcode = $item->shortcode;
        $this->comment_count = $item->edge_media_to_comment->count;
        $this->comments_disabled = $item->comments_disabled;
        $this->timestamp = $item->taken_at_timestamp;
        $this->display_url = $item->display_url;
        $this->dimensionH = $item->dimensions->height;
        $this->dimensionW = $item->dimensions->width;


        if (isset($item->edge_liked_by->count))
        {
            $this->liked_count = $item->edge_liked_by->count;
        }

        if (isset($item->edge_media_preview_like->count))
        {
            $this->liked_count = $item->edge_media_preview_like->count;
        }

        if (isset($item->edge_media_to_caption->edges[0]))
        {
            $this->caption = $item->edge_media_to_caption->edges[0]->node->text;
        }

        if (isset($item->thumbnail_resources[0]))
        {
            $this->thumbnail_small  = $item->thumbnail_resources[0]->src;
        }

        if (isset($item->thumbnail_resources[1]))
        {
            $this->thumbnail_medium = $item->thumbnail_resources[1]->src;
        }

        if (isset($item->thumbnail_resources[2]))
        {
            $this->thumbnail_normal = $item->thumbnail_resources[2]->src;
        }

        if (isset($item->thumbnail_resources[3]))
        {
            $this->thumbnail_large = $item->thumbnail_resources[3]->src;
        }

        if (isset($item->thumbnail_resources[5]))
        {
            $this->thumbnail_xlarge  = $item->thumbnail_resources[5]->src;
        }

        $this->is_video = $item->is_video;

        if ($this->getIsVideo())
        {
            $this->video_view_count = $item->video_view_count;
        }

    }

    /**
     * @return mixed
     */
    public function getDimensionH()
    {
        return $this->dimensionH;
    }

    /**
     * @return mixed
     */
    public function getDimensionW()
    {
        return $this->dimensionW;
    }

    /**
     * @return null
     */
    public function getThumbnailXlarge()
    {
        return $this->thumbnail_xlarge;
    }

    /**
     * @return mixed
     */
    public function getTypename()
    {
        return $this->__typename;
    }

    /**
     * @return mixed
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @return mixed
     */
    public function getCommentCount()
    {
        return $this->comment_count;
    }

    /**
     * @return mixed
     */
    public function getCommentsDisabled()
    {
        return $this->comments_disabled;
    }

    /**
     * @return mixed
     */
    public function getDisplayUrl()
    {
        return $this->display_url;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsVideo()
    {
        return $this->is_video;
    }

    /**
     * @return mixed
     */
    public function getLikedCount()
    {
        return $this->liked_count;
    }

    /**
     * @return mixed
     */
    public function getShortcode()
    {
        return $this->shortcode;
    }

    /**
     * @return mixed
     */
    public function getThumbnailLarge()
    {
        return $this->thumbnail_large;
    }

    /**
     * @return mixed
     */
    public function getThumbnailMedium()
    {
        return $this->thumbnail_medium;
    }

    /**
     * @return mixed
     */
    public function getThumbnailNormal()
    {
        return $this->thumbnail_normal;
    }

    /**
     * @return mixed
     */
    public function getThumbnailSmall()
    {
        return $this->thumbnail_small;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getVideoViewCount()
    {
        return $this->video_view_count;
    }
}