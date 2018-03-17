<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 16.03.2018
 * Time: 00:00
 */

namespace Ismailcaakir\Inspublic\Response;

use Ismailcaakir\Inspublic\Response\Media as MediaResponse;

/**
 * Class Account
 * @package Ismailcaakir\Inspublic\Response
 */
class Account extends Response
{

    protected $biography = null;
    protected $blocked_by_viewer = null;
    protected $country_block = null;
    protected $external_url = null;
    protected $external_url_linkshimmed = null;
    protected $follower_count = null;
    protected $following_count = null;
    protected $followed_by_viewer = null;
    protected $follows_viewer = null;
    protected $full_name = null;
    protected $has_blocked_viewer = null;
    protected $has_requested_viewer = null;
    protected $id = null;
    protected $bio = null;
    protected $is_private = null;
    protected $is_verified = null;
    protected $mutual_followers = null;
    protected $profile_pic_url = null;
    protected $profile_pic_url_hd = null;
    protected $username = null;
    protected $media_count = null;
    protected $timeline_media = array();


    /**
     * Account constructor.
     */
    public function __construct($responseData)
    {
        if (!is_object($responseData))
        {
            $this->setStatusCode(404);
        }
        else {

            /** Instagram Public API Callback to $account */
            $account = $responseData->graphql->user;

            $this->setStatusCode(200);
            $this->biography = $account->biography;
            $this->blocked_by_viewer = $account->blocked_by_viewer;
            $this->country_block = $account->country_block;
            $this->external_url = $account->external_url;
            $this->external_url_linkshimmed = $account->external_url_linkshimmed;
            $this->follower_count = $account->edge_followed_by->count;
            $this->following_count = $account->edge_follow->count;
            $this->followed_by_viewer = $account->followed_by_viewer;
            $this->follows_viewer = $account->follows_viewer;
            $this->full_name = $account->full_name;
            $this->has_blocked_viewer = $account->has_blocked_viewer;
            $this->has_requested_viewer = $account->has_requested_viewer;
            $this->id = $account->id;
            $this->is_private = $account->is_private;
            $this->is_verified = $account->is_verified;
            $this->mutual_followers = $account->mutual_followers;
            $this->profile_pic_url = $account->profile_pic_url;
            $this->profile_pic_url_hd = $account->profile_pic_url_hd;
            $this->username = $account->username;
            $this->media_count = $account->edge_owner_to_timeline_media->count;

            if ($this->getMediaCount() > 0 && !$this->getIsPrivate()){

                $mediaData = $account->edge_owner_to_timeline_media->edges;

                foreach ($mediaData as $index => $media)
                {
                    /** @var Media $this->timeline_media[$index] */
                    $this->timeline_media[$index] = new MediaResponse($media->node);
                }


            }

        }

    }

    /**
     * @return mixed
     */
    public function getBlockedByViewer()
    {
        return $this->blocked_by_viewer;
    }

    /**
     * @return mixed
     */
    public function getCountryBlock()
    {
        return $this->country_block;
    }

    /**
     * @return mixed
     */
    public function getExternalUrl()
    {
        return $this->external_url;
    }

    /**
     * @return mixed
     */
    public function getExternalUrlLinkshimmed()
    {
        return $this->external_url_linkshimmed;
    }

    /**
     * @return mixed
     */
    public function getFollowedByViewer()
    {
        return $this->followed_by_viewer;
    }

    /**
     * @return mixed
     */
    public function getFollowerCount()
    {
        return $this->follower_count;
    }

    /**
     * @return mixed
     */
    public function getFollowingCount()
    {
        return $this->following_count;
    }

    /**
     * @return mixed
     */
    public function getFollowsViewer()
    {
        return $this->follows_viewer;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @return mixed
     */
    public function getHasBlockedViewer()
    {
        return $this->has_blocked_viewer;
    }

    /**
     * @return mixed
     */
    public function getHasRequestedViewer()
    {
        return $this->has_requested_viewer;
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
    public function getIsPrivate()
    {
        return $this->is_private;
    }

    /**
     * @return mixed
     */
    public function getIsVerified()
    {
        return $this->is_verified;
    }

    /**
     * @return mixed
     */
    public function getMutualFollowers()
    {
        return $this->mutual_followers;
    }

    /**
     * @return mixed
     */
    public function getProfilePicUrl()
    {
        return $this->profile_pic_url;
    }

    /**
     * @return mixed
     */
    public function getProfilePicUrlHd()
    {
        return $this->profile_pic_url_hd;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @return null
     */
    public function getMediaCount()
    {
        return $this->media_count;
    }

    /**
     * @return null
     */
    public function getTimelineMedia()
    {
        return $this->timeline_media;
    }




    public function numberFormated()
    {

    }

}