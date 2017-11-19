<?php

/**
* @package   s9e\noto-emoji
* @copyright Copyright (c) 2015 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\notoemoji;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return ['core.text_formatter_s9e_configure_after' => 'onConfigure'];
	}

	public function onConfigure($event)
	{
		if (!isset($event['configurator']->tags['EMOJI']))
		{
			return;
		}

		$tag = $event['configurator']->tags['EMOJI'];
		$dom = $tag->template->asDOM();
		foreach ($dom->getElementsByTagName('img') as $img)
		{
			$img->setAttribute('src', '//cdn.jsdelivr.net/gh/s9e/emoji-assets/assets/noto/svgz/{@seq}.svgz');

			$firstChild = $img->firstChild;
			if ($firstChild && $firstChild->nodeName === 'xsl:attribute' && $firstChild->getAttribute('name') === 'src')
			{
				$img->removeChild($firstChild);
			}
		}
		$dom->saveChanges();
	}
}