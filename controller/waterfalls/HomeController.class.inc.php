<?

Loader::load('collector', array(
    'comment/CommentCollector',
    'image/PhotoCollector',
    'waterfall/LogCollector',
));
Loader::load('controller', 'waterfalls/DefaultPageController');

final class HomeController extends DefaultPageController
{

    private static $TITLE = 'Waterfalls of the Keweenaw | Stories and Tips from Jacob Emerick';
    private static $DESCRIPTION = 'Stories, maps, and details about many of the waterfalls in the Upper Peninsula of Michigan, compiled by Jacob Emerick.';
    private static $KEYWORD_ARRAY = array(
        'waterfalls',
        'keweenaw',
        'upper peninsula',
        'jacob emerick',
    );

    private static $BANNER_IMAGE = 2661;

    protected function set_head_data()
    {
        parent::set_head_data();
        
        $this->set_title(self::$TITLE);
        $this->set_description(self::$DESCRIPTION);
        $this->set_keywords(self::$KEYWORD_ARRAY);
    }

    protected function set_body_data($page_type = 'wide')
    {
        parent::set_body_data($page_type);
        
        $photo = PhotoCollector::getRow(self::$BANNER_IMAGE);
        $photo_obj = (object) array(
            'file'         => "/photo/{$photo->category}/{$photo->name}-size-full.jpg",
            'description'  => $photo->description,
        );
        $this->set_body('photo', $photo_obj);
        
        $recent_log_container;
        $recent_logs = LogCollector::getRecentList(4);
        foreach ($recent_logs as $log) {
            $recent_log_container[] = (object) array(
                'photo'  => (object) array(
                    'file'         => "/photo/{$log->photo_category}/{$log->photo}-size-thumb.jpg",
                    'description'  => $log->photo_description,
                ),
                'title'  => $log->title,
                'link'   => "/journal/{$log->alias}/",
                'date'   => date('F j, Y', strtotime($log->publish_date)),
            );
        }
        $this->set_body('logs', $recent_log_container);
        
        $recent_comments = CommentCollector::getRecentWaterfallComments();
        
        $recent_comment_container = array();
        foreach($recent_comments as $comment) {
            $body = $comment->body;
            $body = strip_tags($body);
            
            $comment_obj = new stdclass();
            $comment_obj->description = Content::instance('SmartTrim', $body)->activate(50);
            $comment_obj->commenter = $comment->name;
            if (!empty($comment->log_path)) {
                $comment_obj->link = Loader::getRootURL() . "{$comment->log_path}/#comment-{$comment->id}";
                $comment_obj->location = $comment->log_title;
            } else {
                $comment_obj->link = Loader::getRootURL() . "{$comment->waterfall_path}/#comment-{$comment->id}";
                $comment_obj->location = $comment->waterfall_title;
            }
            
            $recent_comment_container[] = $comment_obj;
        }
        $this->set_body('comments', $recent_comment_container);
        
        $this->set_body('view', 'Home');
    }

}