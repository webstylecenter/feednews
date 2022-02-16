<?php

namespace App\Services;

use App\Models\Feed;
use App\Models\FeedItem;
use App\Models\UserFeed;
use App\Models\UserFeedItem;
use Symfony\Component\HttpFoundation\Request;
use willvincent\Feeds\Facades\FeedsFacade;

class ImportService
{
    protected FeedsFacade $feedReader;

    public function __construct(FeedsFacade $feedReader)
    {
        $this->feedReader = $feedReader;
    }

    public function addOldItemsToUserFeed(UserFeed $userFeed): void
    {
        FeedItem::where('feed_id', '=', $userFeed->feed->id)
            ->orderBy('created_at', 'DESC')
            ->take(25)
            ->get()
            ->each(function($feedItem) use ($userFeed) {
                UserFeedItem::create([
                    'user_id' => $userFeed->user_id,
                    'user_feed_id' => $userFeed->id,
                    'feed_item_id' => $feedItem->id,
                    'pinned' => $userFeed->auto_pin
                ]);
        });
    }

    public function findRSSFeed($url)
    {
        if (strpos($url, 'youtube.com/user/')) {
            return 'https://www.youtube.com/feeds/videos.xml?user=' . str_replace(['https', 'http', '://', 'www.', 'youtube.com/user/'], '', $url);
        } elseif (strpos($url, 'youtube.com/channel/')) {
            return 'https://www.youtube.com/feeds/videos.xml?channel_id=' . str_replace(['https', 'http', '://', 'www.', 'youtube.com/channel/'], '', $url);
        }

        $html = file_get_contents($url);
        preg_match_all('/<link\s+(.*?)\s*\/?>/si', $html, $matches);
        $links = $matches[1];
        $final_links = array();
        $link_count = count($links);
        for ($n = 0; $n < $link_count; $n++) {
            $attributes = preg_split('/\s+/s', $links[$n]);
            foreach ($attributes as $attribute) {
                $att = preg_split('/\s*=\s*/s', $attribute, 2);
                if (isset($att[1])) {
                    $att[1] = preg_replace('/([\'"]?)(.*)\1/', '$2', $att[1]);
                    $final_link[strtolower($att[0])] = $att[1];
                }
            }
            $final_links[$n] = $final_link;
        }
        #now figure out which one points to the RSS file
        for ($n = 0; $n < $link_count; $n++) {
            if (strtolower($final_links[$n]['rel']) == 'alternate') {
                if (strtolower($final_links[$n]['type']) == 'application/rss+xml') {
                    $href = $final_links[$n]['href'];
                }
                if (!isset($href) and strtolower($final_links[$n]['type']) == 'text/xml') {
                    $href = $final_links[$n]['href'];
                }
                if (isset($href)) {
                    if (strstr($href, "http://") !== false) {
                        $full_url = $href;
                    } elseif (substr($href, 0, 2) == '//') {
                        $full_url = 'http:' . $href;
                    } else {
                        $url_parts = parse_url($url);
                        $full_url = "http://$url_parts[host]";
                        if (isset($url_parts['port'])) {
                            $full_url .= ":$url_parts[port]";
                        }
                        if ($href[0] != '/') {
                            $full_url .= dirname($url_parts['path']);
                            if (substr($full_url, -1) != '/') {
                                $full_url .= '/';
                            }
                        }
                        $full_url .= $href;
                    }
                    return $full_url;
                }
            }
        }

        return '';
    }

    public function validateUrl(Request $request)
    {
        if (strlen($request->get('url'))) {
            $url = $request->get('url');
        } else {
            try {
                $url = $this->findRSSFeed($request->get('website'));
            } catch (\Exception $exception) {
                return 'Error reading website';
            }
        }

        if ($url == '') {
            return 'Error: No RSS Feed found on website';
        }

        return $url;
    }

    public function getFeedName(Feed $feed)
    {
        if (strlen($feed->name) > 0) {
            return $feed->name;
        }

        $feedData = $this->feedReader::make($feed->url);

        if (!$feedData->get_title()) {
            throw new \Exception('Url does not link to a valid xml feed');
        }

        return $feedData->get_title();
    }
}
