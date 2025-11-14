<?php
namespace Pablop76\Plugin\System\Addjs\Extension;

// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;

class Addjs extends CMSPlugin implements SubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onBeforeCompileHead' => 'addMedia',
        ];
    }

    public function addMedia(Event $event)
    {
        if (!$this->getApplication()->isClient('site')) {
            return;
        }
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
        $wa->registerScript('plg_addjs.addjs', 'plg_addjs/user.js', [], ['defer' => 'true'], ["core", "jquery"]);

        $wa->useScript('plg_addjs.addjs');
    }
}