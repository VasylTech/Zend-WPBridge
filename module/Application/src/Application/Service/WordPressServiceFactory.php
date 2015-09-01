<?php

/**
 * WordPress Service Factory
 *
 * PHP version 5.5
 *
 * LICENSE: This source file is subject to version 3.01 of the Creative Commons
 * Attribution-NonCommercial that is available through the world-wide-web at the
 * following URI: http://creativecommons.org/licenses/by-nc/3.0/.  If you did not
 * receive a copy of the Creative Commons Attribution-NonCommercial and are unable
 * to obtain it through the web, please send a note to vasyl@vasyltech.com so we
 * can mail you a copy immediately.
 *
 * @author     Vasyl Martyniuk <vasyl@vasyltech.com>
 * @copyright  2015 Vasyltech
 * @license    Creative Commons Attribution-NonCommercial 3.0
 * @license    http://creativecommons.org/licenses/by-nc/3.0/
 * @since      Release 0.1
 */

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class WordPressServiceFactory implements FactoryInterface {

    /**
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $this->setServiceLocator($serviceLocator);

        //load WordPress functionality
        $config = $this->getServiceLocator()->get('Config');
        if (!empty($config['wp']['core-path'])) {
            require $config['wp']['core-path'];
        } else {
            Throw new \Exception('WordPress Service is not configured.');
        }

        return $this;
    }

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     *
     * @return type
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    /**
     * 
     * @param type $type
     * @param type $num
     * @param type $offset
     * @return type
     */
    public function getPostList($type = 'post', $num = 10, $offset = 0) {
        return \get_posts(array(
            'post_status' => 'publish',
            'post_type' => $type,
            'offset' => $offset,
            'numberposts' => $num,
        ));
    }

    /**
     * 
     * @param type $post
     * @return type
     */
    public function getPostPermalink($post) {
        return \get_permalink($post);
    }

    /**
     * Get 'post' or 'page' etc by slug ("post_name" in wp db)
     * 
     * @param type $slug
     * @param type $type
     * @return type
     * @throws \Exception
     */
    public function getPostBySlug($slug, $type = 'post') {
        $post = \get_page_by_path($slug, 'OBJECT', $type);

        if ($post instanceof \WP_Post) {
            $this->decoratePost($post);
        } else {
            Throw new \Exception('Blog does not exist');
        }

        return $post;
    }

    /**
     * 
     * @param \WP_Post $post
     * @return \WP_Post
     */
    protected function decoratePost(\WP_Post $post) {
        //add some filters
        $content = \apply_filters('the_content', $post->post_content);
        $post->post_content = str_replace(']]>', ']]&gt;', $content);
    }

}
