<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_BASE') or die;

?>
	<dd class="create">
		<i class="far fa-clock"></i>
		<time datetime="<?php echo JHtml::_('date', $displayData['item']->created, 'c'); ?>" itemprop="dateCreated">
			<?php echo JHtml::_('date', $displayData['item']->created, JText::_('DATE_FORMAT_LC3')); ?>
		</time>
	</dd>