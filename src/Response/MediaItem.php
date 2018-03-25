<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 17.03.2018
 * Time: 21:41
 */

namespace Ismailcaakir\InstagramAPI\Response;


class MediaItem
{

    protected $type = null;
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
    protected $video_url = null;

    /**
     * Media constructor.
     */
    public function __construct($item)
    {

        $this->type   = isset($item->__typename) ? $item->__typename : null;
        $this->id           = isset($item->id) ? $item->id : null;
        $this->timestamp    = isset($item->taken_at_timestamp) ? $item->taken_at_timestamp : null;
        $this->display_url  = isset($item->display_url) ? $item->display_url : null;
        $this->dimensionH   = isset($item->dimensions->height) ? $item->dimensions->height : null;
        $this->dimensionW   = isset($item->dimensions->width) ? $item->dimensions->width : null;
        $this->liked_count  = isset($item->edge_liked_by->count) ? $item->edge_liked_by->count : null;
        $this->liked_count  = isset($item->edge_media_preview_like->count) ? $item->edge_media_preview_like->count : null;
        $this->caption      = isset($item->edge_media_to_caption->edges[0]->node->text) ? $item->edge_media_to_caption->edges[0]->node->text : null;
        $this->shortcode    = isset($item->shortcode) ? $item->shortcode : null;
        $this->comment_count     = isset($item->edge_media_to_comment->count) ? $item->edge_media_to_comment->count : null;
        $this->comments_disabled = isset($item->comments_disabled) ? $item->comments_disabled : null;
        if (isset($item->thumbnail_resources))
        {
            // TIMELINE MEDIA TYPE
            $this->thumbnail_small      = isset($item->thumbnail_resources[0]) ? $item->thumbnail_resources[0]->src : null;
            $this->thumbnail_medium     = isset($item->thumbnail_resources[1]) ? $item->thumbnail_resources[1]->src : null;
            $this->thumbnail_normal     = isset($item->thumbnail_resources[2]) ? $item->thumbnail_resources[2]->src : null;
            $this->thumbnail_large      = isset($item->thumbnail_resources[3]) ? $item->thumbnail_resources[3]->src : null;
            $this->thumbnail_xlarge     = isset($item->thumbnail_resources[4]) ? $item->thumbnail_resources[4]->src : null;
        }
        else {
            // MEDIA INFO TYPE
            $this->thumbnail_small      = isset($item->display_resources[0]) ? $item->display_resources[0]->src : null;
            $this->thumbnail_medium     = isset($item->display_resources[1]) ? $item->display_resources[1]->src : null;
            $this->thumbnail_normal     = isset($item->display_resources[2]) ? $item->display_resources[2]->src : null;
            $this->thumbnail_large      = isset($item->display_resources[3]) ? $item->display_resources[3]->src : null;
            $this->thumbnail_xlarge     = isset($item->display_resources[4]) ? $item->display_resources[4]->src : null;
        }

        $this->is_video = isset($item->is_video) ? $item->is_video : null;
        $this->video_view_count = isset($item->video_view_count) ? $item->video_view_count : null;
        $this->video_url = isset($item->video_url) ? $item->video_url : null;
        $this->owner = isset($item->owner) ? new Account($item->owner) : null;

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
    public function getType()
    {
        return $this->type;
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

    /**
     * @return null
     */
    public function getVideoUrl()
    {
        return $this->video_url;
    }

    /**
     * @return Account|null
     */
    public function getOwner(): ?Account
    {
        return $this->owner;
    }
}