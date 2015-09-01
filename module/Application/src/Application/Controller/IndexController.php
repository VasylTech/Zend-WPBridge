<?php

/**
 * Index controller
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

namespace Application\Controller;

use Zend\View\Model\ViewModel,
    Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController {

    /**
     * 
     * @return ViewModel
     */
    public function indexAction() {
        return new ViewModel();
    }

    /**
     * 
     * @return ViewModel
     */
    public function blogAction() {
        $wp = $this->getServiceLocator()->get('WordPress');

        $view = new ViewModel(array('wp' => $wp));
        $slug = $this->params()->fromRoute('slug');

        if ($slug) {
            $view->setTemplate('application/index/blog.phtml');
            $view->setVariable('blog', $wp->getPostBySlug($slug));
        } else {
            $view->setTemplate('application/index/blogs.phtml');
        }

        return $view;
    }

}